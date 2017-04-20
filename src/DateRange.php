<?php

namespace StayForLong\HotelBeds;

use StayForLong\HotelBeds\Contracts\DateInterface;
use StayForLong\HotelBeds\Contracts\DateRangeInterface;

class DateRange implements DateRangeInterface
{
	/** @var DateInterface */
	private $startDate;
	/** @var DateInterface */
	private $endDate;

	/**
	 * DateRange constructor.
	 * @param DateInterface $startDate
	 * @param DateInterface $endDate
	 */
	public function __construct(DateInterface $startDate, DateInterface $endDate)
	{
		$this->startDate = $startDate;
		$this->endDate   = $endDate;
	}


	public function getStartDate() : DateInterface
	{
		return $this->startDate;
	}

	public function getEndDate() : DateInterface
	{
		return $this->endDate;

	}
}