<?php
declare(strict_types=1);

namespace mvc_eins\Models\Handlers;

use DirectoryIterator;
use mvc_eins\Models\FileOperations\UploadImage;

/**
 * Class FileHandler
 * @package mvc_eins\Models\FileHandler
 */
class FileHandler
{
	private ?string $dirpath;
	private ?string $info;

	/**
	 * FileHandler constructor.
	 * @param string $dirpath
	 */
	public function __construct(string $dirpath)
	{
		$this->dirpath = $dirpath;
	}

	/**
	 * <p>Instantiates an UploadImage object, which runs all
	 * neccessary steps to validate and upload the file.</p>
	 */
    public function uploadFile() : void
    {
	    $upload = new UploadImage($this->dirpath);
	    $this->info = $upload->getInfo();
    }

	/**
	 * @return string <p>
	 * Returns information about the handled process.</p>
	 */
	public function getInfo() : string
	{
		return $this->info;
	}

	/**
	 * @return array <p>
	 * Returns a list of files in the selected directory
	 * </p>
	 */
	public function getFileList() : array
	{
		$fileList = [];
		foreach (new DirectoryIterator($this->dirpath) as $fileInfo) {
			if ($fileInfo->isDot()) {
				continue;
			}
			$fileList[] = $fileInfo->getFilename();
		}
		return $fileList;
	}
}