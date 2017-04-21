<?php

namespace StayForLong\HotelBeds;

use StayForLong\HotelBeds\Contracts\FilterTypeInterface;

class FilterTypeCreation implements FilterTypeInterface
{
	/**
	 * @return string
	 */
	public function get()
	{
		return 'CREATION';
	}
}