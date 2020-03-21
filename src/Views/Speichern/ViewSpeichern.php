<?php
declare(strict_types=1);

namespace mvc_eins\Views\Speichern;
use mvc_eins\Interfaces\IView;

/**
 * Class ViewSpeichern
 * @package mvc_eins\Views\Speichern
 */
class ViewSpeichern implements IView
{
	/**
	 * @param array       $directories
	 * @param string|null $info [optional]
	 */
	public static function getContent(array $directories = [], string $info = null) : void
	{
		require_once __DIR__ . '/speichern.php';
	}

	/**
	 * @param string      $directory
	 * @param array       $fileList
	 * @param string|null $info [optional]
	 */
	public static function getViewDirectory(string $directory, array $fileList, string $info = null) : void
	{
		$_SESSION['Directory'] = $directory;
		require_once __DIR__ . '/directory.php';
	}
}