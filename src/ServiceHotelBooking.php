<?php namespace StayForLong\HotelBeds;

use StayForLong\HotelBeds\Contracts\ClientReferenceInterface;
use StayForLong\HotelBeds\Contracts\HolderInterface;
use StayForLong\HotelBeds\Contracts\PaymentDataInterface;
use StayForLong\HotelBeds\Contracts\RoomsInterface;

final class ServiceHotelBooking
{
	private $request_data;
	private $response;

	/**
	 * @param ServiceRequest $request
	 * @param HolderInterface $holder
	 * @param RoomsInterface $rooms
	 * @param ClientReferenceInterface $client_reference
	 * @param PaymentDataInterface $payment_data
	 * @param string $language
	 * @throws ServiceHotelBookingException
	 */
	public function __construct(
		ServiceRequest $request,
		HolderInterface $holder,
		RoomsInterface $rooms,
		ClientReferenceInterface $client_reference,
		PaymentDataInterface $payment_data,
		$language = "ENG"
	) {
		try {
			$this->request_data = [
				"holder"          => $holder->getHolderData(),
				"rooms"           => $rooms->getRooms(),
				"clientReference" => $client_reference->getReference(),
				"language"        => $language, // UTF-8 BOM problems when getting data in latin language that have accents.
			];

			$payment_data = $payment_data->getPaymentData();
			if (!empty($payment_data)) {
				$this->request_data['paymentData'] = $payment_data;
			}

			$this->response = $request
				->setHeaders(['json' => $this->request_data])
				->setOptions("bookings")
				->send("POST");
		} catch (\Exception $e) {
			$request = json_encode($this->request_data, true);
			throw new ServiceHotelBookingException($e->getMessage() ." - ". $request);
		}
	}

	public function __invoke()
	{
		try {
			$raw_response                  = $this->response->getBody()->getContents();
			$raw_response = mb_convert_encoding($raw_response, 'HTML-ENTITIES', 'UTF-8');

			$response                      = json_decode($raw_response, true);
			$response_book                 = $response['booking'];
			$response_book['raw_response'] = $raw_response;

			return $response_book;
		} catch (ServiceRequestException $e) {
			throw new ServiceHotelBookingException($e->getMessage() . "- {$this->request_data}");
		}
	}
}

final class ServiceHotelBookingException extends \ErrorException
{
}