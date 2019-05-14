<?php
namespace Pandora3\Libs\Time\Enum;

/**
 * Class Month
 * @package Pandora3\Libs\Time\Enum
 */
class Month {

	const None = 0;

	const January = 1;
	const February = 2;
	const March = 3;
	const April = 4;
	const May = 5;
	const June = 6;
	const July = 7;
	const August = 8;
	const September = 9;
	const October = 10;
	const November = 11;
	const December = 12;

	/**
	 * @param int $month
	 * @param int|null $year
	 * @return int
	 */
	public static function numberOfDays(int $month, $year = null): int {
		if (is_null($year)) {
			$year = (int) date('Y');
		}
		return cal_days_in_month(CAL_GREGORIAN, $month, $year);
	}

}