<?php
declare(strict_types=1);

namespace StayForLong\HotelBeds\Exceptions;

use Exception;

final class ServiceBookingChangeException extends Exception
{
    public function __construct(string $originalMessage, string $bookingVoucher)
    {
        parent::__construct('Error updating booking ' . $bookingVoucher . ': ' . $originalMessage);
    }
}
