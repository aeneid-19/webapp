<?php
declare(strict_types=1);

namespace mvc_eins\Views\Wertschoepfung;
use mvc_eins\Interfaces\IView;

/**
 * Class ViewWertschoepfung
 * @package mvc_eins\Views\Wertschoepfung
 */
class ViewWertschoepfung implements IView
{
	/**
	 * @param array $jahre
	 * @param array $datensatz
	 */
	public static function getContent(array $jahre = [], array $datensatz = []) : void
	{
		require_once __DIR__ . '/wertschoepfung.php';
	}
}