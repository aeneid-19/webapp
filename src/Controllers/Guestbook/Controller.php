<?php
declare(strict_types=1);
namespace mvc_eins\Controllers\Guestbook;
use mvc_eins\AbstractClasses\AbstractController;
use mvc_eins\Models\Guestbook\Guestbook;
use mvc_eins\Views\Guestbook\ViewGuestbook;

/**
 * Class Controller
 * @package mvc_eins\Controllers\Guestbook
 */
class Controller extends AbstractController
{
	public function indexAction() : void
	{
		$this->getViewGuestbook();
	}


	public function newAction()
	{

	}

	public function addAction() : void
	{
		if(!$this->checkInput()) {
			$this->getViewNewEntry('You must fill out all fields for a new Entry.');
		}
		$entry = new Guestbook(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['message']));
		if ($entry->addGuestbookEntry())
		{
			$this->getViewGuestbook();
		} else {
			$this->getViewNewEntry('There was an error while trying to save your entry.');
		}
	}

	/**
	 * Check if the required fields are filled.
	 * @return bool
	 */
	private function checkInput() : bool
	{
		return !(empty($_POST['name']) || empty($_POST['message']));
	}

	/**
	 * @param array       $dataset [optional] <p>Data to be processed in the view</p>
	 * @param string|null $status [optional] <p>Status return of manage operations</p>
	 */
	private function getViewGuestbook(array $dataset = [], string $status = null) : void
    {
	    ViewGuestbook::getContent($dataset, $status);
    }

	/**
	 * @param string|null $status [optional] <p>Status return of attempt to add a new entry</p>
	 */
	private function getViewNewEntry(string $status = null) : void
	{
    	ViewGuestbook::getNewEntry($status);
    }
}