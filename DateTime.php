<?php
namespace Pandora3\Libs\Time;

use DateInterval;
use DateTimeZone;

/**
 * @property-read int $year
 * @property-read int $month
 * @property-read int $day
 * @property-read int $dayOfWeek
 * @property-read int $hour
 * @property-read int $minute
 * @property-read int $second
 */
class DateTime extends \DateTimeImmutable {

	public const FormatMysql = 'Y-m-d H:i:s';

	/**
	 * @param string|\DateTimeInterface $time
	 * @param string|DateTimeZone|null $timezone
	 */
	public function __construct($time = 'now', $timezone = null) {
	    if (is_string($timezone)) {
			$timezone = new DateTimeZone($timezone);
        }

		if (!is_object($time) || !($time instanceof \DateTimeInterface)) {
			$time = new \DateTime($time);
		}
		parent::__construct($time->format(self::FormatMysql), $timezone);
	}

	/**
	 * @param string|int $year
	 * @param string|int $month
	 * @param string|int $day
	 * @param string|int $hour
	 * @param string|int $minute
	 * @param string|int $second
	 * @return static
	 */
	public static function create($year, $month, $day, $hour = 0, $minute = 0, $second = 0): self {
		return (new static())
			->setDate((int) $year, (int) $month, (int) $day)
			->setTime((int) $hour, (int) $minute, (int) $second);
	}

	/**
	 * @param string $format
	 * @param string|null $time
	 * @param DateTimeZone|null $timezone
	 * @return static|null
	 */
	public static function createFromFormat($format, $time, DateTimeZone $timezone = null) {
		$date = $time ? parent::createFromFormat($format, $time) : null;
		return $date ? new static($date, $timezone) : null;
	}

	/**
	 * @param string $property
	 * @return mixed
	 */
	public function __get(string $property) {
		$methodName = 'get'.ucfirst($property);
		if (method_exists($this, $methodName)) {
			return $this->{$methodName}();
		}
		return null;
	}

	/**
	 * @return static
	 */
	public static function now(): self {
		return new static('now');
	}

	/**
	 * @return string
	 */
	public function toMysql(): string {
		return $this->format(self::FormatMysql);
	}

	/**
	 * @return int
	 */
	public function getYear(): int {
		return (int) $this->format('Y');
	}

	/**
	 * @return int
	 */
	public function getMonth(): int {
		return (int) $this->format('m');
	}

	/**
	 * @return int
	 */
	public function getDay(): int {
		return (int) $this->format('d');
	}

	/**
	 * Gets day of week 1 (for Monday) through 7 (for Saturday)
	 * @return int
	 */
	public function getDayOfWeek(): int {
		return (int) $this->format('N');
	}

	/**
	 * @return int
	 */
	public function getHour(): int {
		return (int) $this->format('H');
	}

	/**
	 * @return int
	 */
	public function getMinute(): int {
		return (int) $this->format('i');
	}

	/**
	 * @return int
	 */
	public function getSecond(): int {
		return (int) $this->format('s');
	}

	/**
	 * @param string $interval
	 * @return static
	 */
	public function addInterval(string $interval) {
		return $this->add(DateInterval::createFromDateString($interval));
	}

	/**
	 * @param string $interval
	 * @return bool|static
	 */
	public function subInterval(string $interval) {
		return $this->sub(DateInterval::createFromDateString($interval));
	}

	/**
	 * @return Date
	 */
	public function getDate(): Date {
		return new Date($this);
	}

    // todo: implement
	/* public function getTime(): Time {
		return new Time();
	} */

	/**
	 * @param string|static $date
	 * @param string $format
	 * @return string
	 */
	public static function convert($date, string $format): string {
		if (!($date instanceof \DateTimeInterface)) {
			$date = self::createFromFormat(self::FormatMysql, $date);
		}
		return $date ? $date->format($format) : '';
	}

}