<?php
declare(strict_types=1);

namespace mvc_eins\Views\Darlehensberechnung;

use mvc_eins\Interfaces\IView;

/**
 * Class ViewDarlehensberechnung
 * @package mvc_eins\Views\Darlehensberechnung
 */
class ViewDarlehensberechnung implements IView
{
	public static function getContent() : void
	{
		require_once __DIR__ . '/darlehensberechnung.php';
	}
}