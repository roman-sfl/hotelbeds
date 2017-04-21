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

	/**
	 * @return DateInterface
	 */
	public function getStartDate()
	{
		return $this->startDate;
	}

	/**
	 * @return DateInterface
	 */
	public function getEndDate()
	{
		return $this->endDate;

	}
}