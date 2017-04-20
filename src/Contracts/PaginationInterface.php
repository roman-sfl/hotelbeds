<?php


namespace StayForLong\HotelBeds\Contracts;


interface PaginationInterface
{
	public function getPage() : int;

	public function getPerPage() : int;
}