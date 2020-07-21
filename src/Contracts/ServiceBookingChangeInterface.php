<?php
declare(strict_types=1);

namespace StayForLong\HotelBeds\Contracts;

use StayForLong\HotelBeds\Exceptions\ServiceBookingChangeException;
use StayForLong\HotelBeds\ServiceBookingChangeCommand;

interface ServiceBookingChangeInterface
{
    /**
     * @param ServiceBookingChangeCommand $command
     * @return array
     * @throws ServiceBookingChangeException
     */
    public function handle(ServiceBookingChangeCommand $command): array;
}
