<?php

namespace mvc_eins\Models\Guestbook;

use DateTime;
use DateTimeZone;
use Exception;

/**
 * Class Guestbook
 * @package mvc_eins\Models\Guestbook
 */
class Guestbook
{
	/**
	 * @var array
	 */
	private array $entry = [];
	private $handle;

	/**
	 * Guestbook constructor.
	 * @param string $author
	 * @param string $message
	 */
	public function __construct(string $author, string $message)
	{
		try {
			$date = new DateTime('now', DateTimeZone::EUROPE + 1); // + 1 may throw error
		} catch (Exception $e) {
			echo $e;
			die;
		}
		$this->entry[] = [$author, $date, $message];
	}

	/**
	 * @return array
	 */
	public function getGuestbookContent() : array
	{
		// check if the file exists and is readable.
		// if true, return it's contents.
		if (file_exists(GBENTRIES) && is_readable(GBENTRIES)) {
			// open new handle on the file
			$this->handle = fopen(GBENTRIES, 'rb');
			// read content of the file
			$content[] = json_decode(GBENTRIES, true, 512, JSON_THROW_ON_ERROR);
			// close the handle
			fclose($this->handle);
			// return contents
			return $content;
		}
	}

	/**
	 * @return bool
	 */
	public function addGuestbookEntry() : bool
	{
		// check if the file exists or, if not, can be created.
		// if true, open it, else return false.
		if (file_exists(GBENTRIES) && is_writable(GBENTRIES)) {
			$this->handle = fopen(GBENTRIES, 'rb+');
		} elseif (fopen(GBENTRIES, 'wb+')) {
			$this->handle = fopen(GBENTRIES, 'wb+');
		} else {
			// send failure signal
			return false;
		}

		// move pointer to the end of the file
		fseek($this->handle, 0, SEEK_END);

		// check if the file has content
		// if true, append the new entry at the end
		if (ftell($this->handle) > 0) {
			// move back a byte
			fseek($this->handle, -1, SEEK_END);

			// add the trailing comma
			fwrite($this->handle, ',', 1);

			// add the new json string
			fwrite($this->handle, json_encode($this->entry, JSON_THROW_ON_ERROR) . ']');
		} else {
			// write the first event inside an array
			fwrite($this->handle, json_encode([$this->entry], JSON_THROW_ON_ERROR));
		}

		// close the handle on the file
		fclose($this->handle);
		// send success signal
		return true;
	}
}