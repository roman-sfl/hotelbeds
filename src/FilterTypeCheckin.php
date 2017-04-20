<?php

namespace StayForLong\HotelBeds;

use StayForLong\HotelBeds\Contracts\FilterTypeInterface;

class FilterTypeCheckin implements FilterTypeInterface
{
	public function get(): string
	{
		return 'CHECKIN';
	}
}