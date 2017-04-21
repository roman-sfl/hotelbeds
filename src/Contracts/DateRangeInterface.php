<?php


namespace StayForLong\HotelBeds\Contracts;


interface DateRangeInterface
{
	/** @return DateInterface */
	public function getStartDate();

	/** @return DateInterface */
	public function getEndDate();
}