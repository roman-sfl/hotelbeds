<?php


namespace StayForLong\HotelBeds;



use StayForLong\Context\Booking\Domain\ValueObject\BookingReference;

class ServiceBookingDetails
{
	public function __construct(
		ServiceRequest $request
	) {
		try {
			$this->response = $request->send();
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
			$response_detail                 = $response['booking'];
			$response_bookings['raw_response'] = $raw_response;

			return $response_detail;
		} catch (ServiceRequestException $e) {
			throw new ServiceBookingDetailsException($e->getMessage() . "- {$this->request_data}");
		}

	}
}
final class ServiceBookingDetailsException extends \ErrorException
{
}