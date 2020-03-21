<?php
declare(strict_types=1);
namespace mvc_eins\Views\Guestbook;
use mvc_eins\Interfaces\IView;

/**
 * Class ViewGuestbook
 * @package mvc_eins\Views\Guestbook
 */
class ViewGuestbook implements IView
{
	/**
	 * @param array       $dataset [optional] <p>Data to be processed in the view</p>
	 * @param string|null $status [optional] <p>Status return of attempt to add a new entry</p>
	 */
	public static function getContent(array $dataset = [], string $status = null) : void
	{
		require_once __DIR__ . '/guestbook.php';
	}

	/**
	 * @param string $status [optional] <p>Status return of attempt to add a new entry</p>
	 */
	public static function getNewEntry(string $status = null) : void
	{
		require_once __DIR__ . '/new_entry.php';
	}

}