<?php
namespace pandora3\libs\Time;


class Time {

	/**
	 * @var int $time
	 */
	protected $time;

	public function __construct($time = null) {
		$this->time = $time ?? time();
	}

}