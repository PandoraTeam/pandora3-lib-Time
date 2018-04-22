<?php
namespace pandora3\libs\Time;


class Date {

	/**
	 * @var int $time
	 */
	protected $time;

	/**
	 * @var int $day
	 */
	protected $day;

	/**
	 * @var int $month
	 */
	protected $month;

	/**
	 * @var int $year
	 */
	protected $year;

	public function __construct($time) {
		$this->time = $time;
	}

}