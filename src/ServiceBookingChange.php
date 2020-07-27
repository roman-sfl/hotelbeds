<?php
declare(strict_types=1);

namespace StayForLong\HotelBeds;

use Exception;
use StayForLong\HotelBeds\Contracts\ServiceBookingChangeInterface;
use StayForLong\HotelBeds\Exceptions\ServiceBookingChangeException;

final class ServiceBookingChange implements ServiceBookingChangeInterface
{
    /**
     * @param ServiceBookingChangeCommand $command
     * @return array
     * @throws ServiceBookingChangeException
     */
    public function handle(ServiceBookingChangeCommand $command): array
    {
        try {
            $raw_response = $this->sendUpdateRequest($command);
            $raw_response = mb_convert_encoding($raw_response, 'HTML-ENTITIES', 'UTF-8');

            $response                         = json_decode($raw_response, true);
            $response_booking                 = $response['booking'];
            $response_booking['raw_response'] = $raw_response;

            return $response_booking;
        } catch (Exception $e) {
            throw new ServiceBookingChangeException($e->getMessage(), $command->bookingVoucher());
        }
    }

    /**
     * @param ServiceBookingChangeCommand $command
     * @return mixed
     * @throws ServiceRequestException
     */
    private function sendUpdateRequest(ServiceBookingChangeCommand $command)
    {
        $apiAuth      = new ApiAuth($command->apiKey(), $command->apiSecret());
        $resource_url = $command->apiBaseUrl() . '/bookings/' . $command->bookingVoucher();
        $content      = [
            'mode'    => 'UPDATE',
            'booking' => $command->bookingData()
        ];

        $request = new ServiceRequest(
            $apiAuth,
            $resource_url,
            [],
            $command->timeout(),
            $content
        );

        return $request->send('PUT');
    }
}
