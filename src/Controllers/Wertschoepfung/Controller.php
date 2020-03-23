<?php
declare(strict_types=1);

namespace mvc_eins\Controllers\Wertschoepfung;
use mvc_eins\AbstractClasses\AbstractController;
use mvc_eins\Views\Wertschoepfung\ViewWertschoepfung;

/**
 * Class Controller
 * @package mvc_eins\Controllers\Wertschoepfung
 */
class Controller extends AbstractController
{

	/**
	 * @inheritDoc
	 */
	public function indexAction()
	{
		// TODO: Implement indexAction() method.
	}

	private function getView() : void
	{
		ViewWertschoepfung::getContent();
	}
}