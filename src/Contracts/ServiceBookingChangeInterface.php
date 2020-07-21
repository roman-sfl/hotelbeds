<?php
declare(strict_types=1);

namespace StayForLong\HotelBeds\Contracts;

use StayForLong\HotelBeds\ServiceBookingChangeCommand;

interface ServiceBookingChangeInterface
{
    public function handle(ServiceBookingChangeCommand $command): array;
}
