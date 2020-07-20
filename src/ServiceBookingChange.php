<?php
declare(strict_types=1);

namespace StayForLong\HotelBeds;

use Exception;
use StayForLong\HotelBeds\Exceptions\ServiceBookingChangeException;

final class ServiceBookingChange
{
    /**
     * @param ServiceBookingChangeCommand $command
     * @return array
     * @throws ServiceBookingChangeException
     */
    public function handle(ServiceBookingChangeCommand $command): array
    {
        try {
            $response = $this->sendUpdateRequest($command);

            return $response['booking'];
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
