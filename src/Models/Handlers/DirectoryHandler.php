<?php
declare(strict_types=1);

namespace mvc_eins\Models\Handlers;

/**
 * Class DirectoryHandler
 * @package mvc_eins\Models\DirectoryHandler
 */
class DirectoryHandler
{
	private ?string $dirpath;
	private ?string $info;

	/**
	 * DirectoryHandler constructor.
	 * @param string|null $dirpath <p>
	 * Directory basepath
	 * </p>
	 */
	public function __construct(string $dirpath = null)
	{
		$this->dirpath = $dirpath;
	}

	/**
	 * @param string $dirname
	 */
	public function createDir(string $dirname) : void
	{
			if(DataAccessHandler::checkIfExists($this->dirpath . $dirname)) {
				$this->info = 'Error: The directory already exists!';
			} else {
				mkdir($this->dirpath . $dirname) ? $this->info = 'Directory created' : $this->info = 'Directory was not created!';
			}
	}

	/**
	 * @return string <p>
	 * Returns information about the handled process.
	 * </p>
	 */
	public function getInfo() : string
	{
		return $this->info;
	}

	/**
	 * @param string $dirpath <p>
	 * Directory basepath
	 * </p>
	 * @return array <p>
	 * Returns a list of directories in the basepath
	 * </p>
	 */
	public static function getDirectoryList(string $dirpath) : array
	{
		$directory = [];
		$dirHandle = dir($dirpath);
		while (($f = $dirHandle->read())!==false)
		{
			if($f !== '.' && $f !== '..' && is_dir($dirpath . $f)) {
				$directory[] = $f;
			}
		}
		return $directory;
	}
}