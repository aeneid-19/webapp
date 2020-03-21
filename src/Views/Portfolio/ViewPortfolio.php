<?php
declare(strict_types=1);

namespace mvc_eins\Views\Portfolio;

use mvc_eins\Interfaces\IView;

/**
 * Class ViewPortfolio
 * @package mvc_eins\Views\Portfolio
 */
class ViewPortfolio implements IView
{
	/**
	 * @param array       $dataset [optional] <p>Data to be processed in the view</p>
	 * @param array       $indexNameArray
	 * @param string|null $status  [optional] <p>Status return of attempt to add a new entry</p>
	 */
	public static function getContent(array $dataset = [], array $indexNameArray = [], string $status = null) : void
	{
		//require_once __DIR__ . '/portfolio.php';
		require_once __DIR__ . '/new_entry.php';
	}

	public static function getNewEntry() : void
	{
		require_once __DIR__ . '/new_entry.php';
	}

	/**
	 * @param array $indexNameArray
	 */
	public static function getValidateEntry(array $indexNameArray = []) : void
	{
		//$indexNameArray = $_POST;
		// pnd($indexNameArray);
		require_once __DIR__ . '/validate_entry.php';
	}

	/**
	 * @param string $meldung
	 */
	public static function getMeldung(string $meldung) : void
	{
		require_once __DIR__ . '/meldung.php';
	}

	public static function getAuslesen(array $datensatz = [], array $indexNameArray = []) : void
	{
		require_once __DIR__ . '/portfolio.php';
	}
}