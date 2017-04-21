<?php


namespace StayForLong\HotelBeds\Contracts;


interface PaginationInterface
{
	/** @return int */
	public function getPage();

	/** @return int */
	public function getPerPage();
}