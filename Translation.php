<?php
namespace Pandora3\Libs\Time;

/**
 * Trait Translation
 * @package Pandora3\Libs\Time
 */
trait Translation {

	protected static $translations = [
		'ru' => [
			'month' => [
				'January' =>	'Январь',
				'February' =>	'Февраль',
				'March' =>		'Март',
				'April' =>		'Апрель',
				'May' =>		'Май',
				'June' =>		'Июнь',
				'July' =>		'Июль',
				'August' =>		'Август',
				'September' =>	'Сентябрь',
				'October' =>	'Октябрь',
				'November' =>	'Ноябрь',
				'December' =>	'Декабрь',
			],
			'monthShort' => [
				'Jan' => 'Янв',
				'Feb' => 'Фев',
				'Mar' => 'Мар',
				'Apr' => 'Апр',
				'May' => 'Май',
				'Jun' => 'Июн',
				'Jul' => 'Июл',
				'Aug' => 'Авг',
				'Sep' => 'Сен',
				'Oct' => 'Окт',
				'Nov' => 'Ноя',
				'Dec' => 'Дек',
			],
			'weekDay' => [
				'Monday' =>		'Понедельник',
				'Tuesday' =>	'Вторник',
				'Wednesday' =>	'Среда',
				'Thursday' =>	'Четверг',
				'Friday' =>		'Пятница',
				'Saturday' =>	'Суббота',
				'Sunday' =>		'Воскресенье',
			],
			'weekDayShort' => [
				'Mon' => 'Пн',
				'Tue' => 'Вт',
				'Wed' => 'Ср',
				'Thu' => 'Чт',
				'Fri' => 'Пт',
				'Sat' => 'Сб',
				'Sun' => 'Вс',
			],
		]
	];

	protected static $translationKeys = [
		'F' => 'month',
		'M' => 'monthShort',
		'l' => 'weekDay',
		'D' => 'weekDayShort',
	];

	/**
	 * @param string $format
	 * @param string $locale
	 * @return string
	 */
	public function translate(string $format, string $locale): string {
		$translation = self::$translations[$locale] ?? null;
		if (is_null($translation)) {
			return $format;
		}
		return preg_replace_callback('/[FMlD]/', function($matches) use ($translation) {
			$segment = $matches[0];
			$formatted = parent::format($segment);
			$key = self::$translationKeys[$segment];
			return $translation[$key][$formatted] ?? $formatted;
		}, $format);
	}

}