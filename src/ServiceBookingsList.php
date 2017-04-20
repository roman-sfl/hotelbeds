<?php

namespace StayForLong\HotelBeds;

use StayForLong\HotelBeds\Contracts\DateRangeInterface;
use StayForLong\HotelBeds\Contracts\FilterTypeInterface;
use StayForLong\HotelBeds\Contracts\PaginationInterface;

final class ServiceBookingsList
{
	private $response;
	private $request_data;

	/**
	 * GET https://api.test.hotelbeds.com/hotel-api/1.0/bookings?start=2015-09-10&end=2015-09-15&filterType=CREATION&status=CONFIRMED&from=1&to=25
	 *
	 * @param ServiceRequest $request
	 * @param DateRangeInterface $dateRange
	 * @param PaginationInterface $pagination
	 * @param FilterTypeInterface $filterType
	 * @throws ServiceBookingsListException
	 */
	public function __construct(
		ServiceRequest $request,
		DateRangeInterface $dateRange,
		PaginationInterface $pagination,
		FilterTypeInterface $filterType = null
	) {
		try {
			$this->request_data = [
				'start'      => $dateRange->getStartDate()->getDate(),
				'end'        => $dateRange->getEndDate()->getDate(),
				'from'       => $this->getPaginationFrom($pagination),
				'to'         => $this->getPaginationTo($pagination),
				'filterType' => $this->getFilterType($filterType)->get(),
			];

			$this->response = $request->setQueryStringParams($this->request_data)->send();
		} catch
		(\Exception $e) {
			throw new ServiceBookingsListException($e->getMessage() . " - " . $request->getRequestUrl());
		}
	}

	public function __invoke()
	{
		try {
			$raw_response = $this->response->getBody()->getContents();
			$raw_response = mb_convert_encoding($raw_response, 'HTML-ENTITIES', 'UTF-8');

			$response                          = json_decode($raw_response, true);
			$response_bookings                 = $response['bookings'];
			$response_bookings['raw_response'] = $raw_response;

			return $response_bookings;
		} catch (ServiceRequestException $e) {
			throw new ServiceBookingsListException($e->getMessage() . "- {$this->request_data}");
		}

	}

	private function getFilterType($filterType) : FilterTypeInterface
	{
		if (null === $filterType) {
			return new FilterTypeCreation();
		}
		return $filterType;
	}

	private function getPaginationFrom(PaginationInterface $pagination)
	{
		// Hotelbeds API defines the first result with index 1, not 0
		return $pagination->getPage() * $pagination->getPerPage() + 1;
	}

	private function getPaginationTo(PaginationInterface $pagination)
	{
		return $pagination->getPage() * $pagination->getPerPage() + $pagination->getPerPage();
	}
}


final class ServiceBookingsListException extends \ErrorException
{
}