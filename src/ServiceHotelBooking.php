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
	 * @param PaymentDataInterface $payment
	 * @param string $language
	 * @throws ServiceHotelBookingException
	 */
	public function __construct(
		ServiceRequest $request,
		HolderInterface $holder,
		RoomsInterface $rooms,
		ClientReferenceInterface $client_reference,
		PaymentDataInterface $payment,
		$language = "ENG"
	) {
		try {
			$this->request_data = [
				"holder"          => $holder->getHolderData(),
				"rooms"           => $rooms->getRooms(),
				"clientReference" => $client_reference->getReference(),
				"language"        => $language,
			];

			$payment_data = $payment->getPaymentData();
			if (!empty($payment_data)) {
				$this->request_data['paymentData'] = $payment_data;
			}

			$this->response = $request
				->setHeaders(['json' => $this->request_data])
				->setOptions("bookings")
				->send("POST");
		} catch (\Exception $e) {
			throw new ServiceHotelBookingException($e->getMessage());
		}
	}

	public function __invoke()
	{
		try {
			$response                      = $this->response->getBody()->getContents();
			$response                      = json_decode($response, true);
			$response_book                 = $response['booking'];
			$response_book['raw_response'] = $response;

			return $response_book;
		} catch (ServiceRequestException $e) {
			throw new ServiceHotelBookingException($e->getMessage() . "- {$this->request_data}");
		}
	}
}

final class ServiceHotelBookingException extends \ErrorException
{
}