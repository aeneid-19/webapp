<?php
declare(strict_types=1);

namespace mvc_eins\Models\FileOperations;
use mvc_eins\Models\Handlers\DataAccessHandler;

/**
 * Class UploadImage
 * @package mvc_eins\Models\UploadImage
 */
class UploadImage
{
	private const UPLOAD_FUNCTIONS = [
		'checkIfImage',
		'checkFileFormat',
		'doUpload'
	];
	private array $allowedFiletypes = ALLOWED_IMG_TYPES;
	private string $uploaddir;
	private string $file;
	private string $info;
	private bool $uploadOK;

	/**
	 * UploadImage constructor.
	 * @param string $uploaddir
	 */
	public function __construct(string $uploaddir)
	{
		// TODO: Extend to support multi file uploads!
		$this->uploaddir = $uploaddir . DS;
		$this->file = $_FILES['fileToUpload']['name'];
		if ($this->checkDirAccess()) {
			foreach (self::UPLOAD_FUNCTIONS as $item) {
				$this->$item();
				if ($this->uploadOK === false) {
					break;
				}
			}
		} else {
			$this->info = 'Error: The file already exists or the directory is not writable';
		}
	}

	/**
	 * @return bool <p>
	 * Returns false if any of the required tests fail.
	 * </p>
	 */
	private function checkDirAccess() : bool
	{
		return DataAccessHandler::checkIfReadable($this->uploaddir) &&
			DataAccessHandler::checkIfWritable($this->uploaddir) &&
			!DataAccessHandler::checkIfExists($this->uploaddir . $this->file);
	}

	/**
	 * @return string
	 */
	public function getInfo() : string
	{
		return $this->info ?? 'Upload info not set yet!';
	}

	/**
	 * Checks if image file is an actual image or fake image.
	 */
	private function checkIfImage() : void
	{
		$check = getimagesize($_FILES['fileToUpload']['tmp_name']);
		if ($check === false) {
			$this->info = 'File is not an image.';
			$this->uploadOK = false;
		}
	}

	/**
	 * Checks if the type of the file is allowed.
	 * @var $this->allowedFiletypes <p>
	 * Update the array in the "config.php" to manage allowed types.
	 * </p>
	 */
	private function checkFileFormat() : void
	{
		$imageFileType = strtolower($this->file);
		$imageFileType = substr($imageFileType, strrpos($imageFileType, '.') + 1);
		if (!\in_array($imageFileType, $this->allowedFiletypes, true)) {
			$this->info = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
			$this->uploadOK = false;
		}
	}

	/**
	 * <p>Tries to upload the file to the target directory.</p>
	 */
	private function doUpload() : void
	{
		if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $this->uploaddir . $this->file)) {
			$this->info = 'The file ' . $_FILES['fileToUpload']['name'] . ' has been uploaded.';
		} else {
			$this->info = 'Sorry, there was an error uploading your file.';
			$this->uploadOK = false;
		}
	}
}