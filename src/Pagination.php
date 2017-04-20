<?php


namespace StayForLong\HotelBeds;


use StayForLong\HotelBeds\Contracts\PaginationInterface;

class Pagination implements PaginationInterface
{
	/** @var int */
	private $page;
	/** @var int */
	private $perPage;

	/**
	 * Pagination constructor.
	 * @param int $page
	 * @param int $perPage
	 */
	public function __construct($page, $perPage)
	{
		$this->page    = $page;
		$this->perPage = $perPage;
	}

	public function getPage() : int
	{
		return $this->page;
	}

	public function getPerPage() : int
	{
		return $this->perPage;
	}
}