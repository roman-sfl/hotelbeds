<?php

namespace StayForLong\HotelBeds;

use StayForLong\HotelBeds\Contracts\FilterTypeInterface;

class FilterTypeCreation implements FilterTypeInterface
{
	public function get(): string
	{
		return 'CREATION';
	}
}