<?php
declare(strict_types=1);

namespace StayForLong\HotelBeds;

final class ServiceBookingChangeCommand
{
    private string $api_key;
    private string $api_secret;
    private string $api_base_url;
    private string $booking_voucher;
    private array $booking_data;
    private int $timeout;

    public function __construct(
        string $api_key,
        string $api_secret,
        string $api_base_url,
        string $booking_voucher,
        array $booking_data,
        int $timeout
    ) {
        $this->api_key         = $api_key;
        $this->api_secret      = $api_secret;
        $this->api_base_url    = $api_base_url;
        $this->booking_voucher = $booking_voucher;
        $this->booking_data    = $booking_data;
        $this->timeout         = $timeout;
    }

    public function apiKey(): string
    {
        return $this->api_key;
    }

    public function apiSecret(): string
    {
        return $this->api_secret;
    }

    public function apiBaseUrl(): string
    {
        return $this->api_base_url;
    }

    public function bookingVoucher(): string
    {
        return $this->booking_voucher;
    }

    public function bookingData(): array
    {
        return $this->booking_data;
    }

    public function timeout(): int
    {
        return $this->timeout;
    }
}
