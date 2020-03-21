<?php
declare(strict_types=1);

namespace mvc_eins\Controllers\Speichern;
use mvc_eins\AbstractClasses\AbstractController;
use mvc_eins\Models\Handlers\DirectoryHandler;
use mvc_eins\Models\Handlers\FileHandler;
use mvc_eins\Views\Speichern\ViewSpeichern;

/**
 * Class Controller
 * @package mvc_eins\Controllers\Speichern
 */
class Controller extends AbstractController
{
	private const IMGLIBRARY = ROOT_PATH . 'public' . DS . 'imglibrary' . DS;

	public function indexAction() : void
	{
		$this->getView();
	}

	public function createAction() : void
	{
		if (!empty($_POST['InputDirname']) && !preg_match('/[\W]+/', $_POST['InputDirname'])) {
			$directory = new DirectoryHandler(self::IMGLIBRARY);
			$directory->createDir(htmlspecialchars(trim($_POST['InputDirname'])));
			$this->getView($directory->getInfo());
		}
		$this->getView('Input was empty or had illegal characters! Only A-Z, a-z, 0-9 and _ are allowed.');
	}

	public function directoryAction() : void
	{
		if (!empty($_POST['Directory'])) {
			$directory = new FileHandler(self::IMGLIBRARY . $_POST['Directory']);
			ViewSpeichern::getViewDirectory($_POST['Directory'], $directory->getFileList());
		} else {
			$this->getView('Please select a directory!');
		}
	}

	public function imguploadAction() : void
	{
		// This check prevents a fatal error if the session timed out while in the directory view.
		if ($_SESSION['Directory']) {
			$directory = new FileHandler(self::IMGLIBRARY . $_SESSION['Directory']);
			// Checks if a file was selected, the file is of the type image and if its size is valid.
			if (!empty($_FILES['fileToUpload']['type']) &&
				($_FILES['fileToUpload']['size'] !== 0 || $_FILES['fileToUpload']['size'] <= MAX_IMG_SIZE) &&
				strncmp($_FILES['fileToUpload']['type'], 'image', 5) === 0) {
				$directory->uploadFile();
				ViewSpeichern::getViewDirectory($_SESSION['Directory'], $directory->getFileList(), $directory->getInfo());
			} else {
				ViewSpeichern::getViewDirectory($_SESSION['Directory'], $directory->getFileList(), 'Error: The file is not an image or to large!');
			}
		} else {
			$this->getView();
		}
	}

	/**
	 * @param string|null $info
	 */
	private function getView(string $info = null) : void
	{
		ViewSpeichern::getContent(DirectoryHandler::getDirectoryList(self::IMGLIBRARY), $info);
	}
}