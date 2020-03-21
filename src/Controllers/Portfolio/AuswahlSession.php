<?php
declare(strict_types=1);

namespace mvc_eins\Controllers\Portfolio;

/**
 * Class AuswahlSession
 * @package mvc_eins\Controllers\Portfolio
 */
class AuswahlSession
{
	/**
	 * @param string $item
	 * @param string $value
	 */
	public static function selectedAuswahl(string $item, string $value) : void
	{
		if (!empty($_SESSION[$item]) && $_SESSION[$item] === $value) {
			echo 'selected';
		}
	}

	/**
	 * @param string $item
	 */
	public static function checkedAuswahl(string $item) : void
	{
		echo !empty($_SESSION[ $item ]) ? 'checked' : '';
	}

	/**
	 * @param string $item
	 * @param string $value
	 */
	public static function checkedRadioAuswahl(string $item, string $value) : void
	{
		if (!empty($_SESSION[$item]) && $_SESSION[$item] === $value) {
			echo 'checked';
		}
	}

	/**
	 * @param string $item
	 */
	public static function sessionAuswahl(string $item) : void
	{
		echo $_SESSION[ $item ] ?? '';
	}

	/**
	 * @param string $item
	 * @param string $value
	 */
	public static function checkedArrayAuswahl(string $item, string $value) : void
	{
		if (!empty($_SESSION[ $item ])) {
			foreach ($_SESSION[ $item ] as $inhalt) {
				if ($inhalt === $value) {
					echo 'checked';
				}
			}
		}
	}
}