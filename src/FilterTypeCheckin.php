<?php

namespace StayForLong\HotelBeds;

use StayForLong\HotelBeds\Contracts\FilterTypeInterface;

class FilterTypeCheckin implements FilterTypeInterface
{
	/**
	 * @return string
	 */
	public function get()
	{
		return 'CHECKIN';
	}
}