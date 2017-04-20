<?php

namespace StayForLong\HotelBeds;


use DateTime;
use StayForLong\HotelBeds\Contracts\DateInterface;

class Date implements DateInterface
{
	const DATE_FORMAT = 'Y-m-d';

	/** @var string */
	private $date;

	public function __construct($date)
	{
		if (!$this->validateDate($date, static::DATE_FORMAT)) {
			throw new \InvalidArgumentException(
				sprintf("Date '%s' does not match required format", static::DATE_FORMAT)
			);
		}

		$this->date = $date;
	}

	public function getDate() : string
	{
		return $this->date;
	}

	private function validateDate($date, $format = self::DATE_FORMAT)
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
}