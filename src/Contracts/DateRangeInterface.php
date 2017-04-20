<?php


namespace StayForLong\HotelBeds\Contracts;


interface DateRangeInterface
{
	public function getStartDate() : DateInterface;

	public function getEndDate() : DateInterface;
}