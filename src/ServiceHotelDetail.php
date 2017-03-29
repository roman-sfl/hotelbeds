<?php namespace StayForLong\HotelBeds;

final class ServiceHotelDetail
{
	private $response;

	/**
	 * @param ServiceRequest $request
	 * @param string $hotel_code
	 * @param string $language
	 */
	public function __construct(ServiceRequest $request, $hotel_code, $language = "ENG")
	{
		$this->response = $request
			->setOptions("hotels")
			->setOptions($hotel_code)
			->setQueryStringParams(["language" => $language])
			->send();
	}

	public function __invoke()
	{
		try {
			$response = $this->response->getBody();
			return json_decode($response, true);
		} catch (ServiceRequestException $e) {
			throw new ServiceHotelDetailException($e->getMessage());
		}
	}
}

final class ServiceHotelDetailException extends \ErrorException
{
}