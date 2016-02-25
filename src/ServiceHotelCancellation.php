<?php namespace StayForLong\HotelBeds;

final class ServiceHotelCancellation
{
	private $request_data;
	private $response;

	/**
	 * @param ServiceRequest $request
	 * @param string $reference
	 * @param string $language
	 * @throws ServiceHotelBookingException
	 */
	public function __construct(
		ServiceRequest $request,
		$reference,
		$language = "ENG"
	) {
		try {
			$this->request_data = [
				"cancellationFlag" => "CANCELLATION",
			];

			$this->response = $request
				->setOptions("bookings")
				->setOptions($reference)
				->setQueryStringParams($this->request_data)
				->send("DELETE");

		} catch (\Exception $e) {
			$request_data = json_encode($this->request_data, true);
			throw new ServiceHotelCancellationException($request->getRequestUrl(). " - ". $e->getMessage() ." - ". $request_data);
		}
	}

	public function __invoke()
	{
		try {
			$raw_response                  = $this->response->getBody()->getContents();
			$response                      = json_decode($raw_response, true);
			$response_book                 = $response['booking'];
			$response_book['raw_response'] = $raw_response;

			return $response_book;
		} catch (ServiceRequestException $e) {
			throw new ServiceHotelCancellationException($e->getMessage() . "- {$this->request_data}");
		}
	}
}

final class ServiceHotelCancellationException extends \ErrorException
{
}