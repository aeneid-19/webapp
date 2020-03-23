<?php
declare(strict_types=1);

namespace mvc_eins\Navi;
/**
 * Class NaviIndex
 * @package mvc_eins\Template\Navi
 */
class NaviIndex
{
	/**
	 * @param string $activeItem
	 */
	public static function getNavi(string $activeItem = null) : void
	{
		require_once __DIR__ . '/navbar.php';
	}
}