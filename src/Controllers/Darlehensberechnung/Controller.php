<?php
declare(strict_types=1);

namespace mvc_eins\Controllers\Darlehensberechnung;
use mvc_eins\AbstractClasses\AbstractController;
use mvc_eins\Views\Darlehensberechnung\ViewDarlehensberechnung;

/**
 * Class Controller
 * @package mvc_eins\Controllers\Darlehensberechnung
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
		ViewDarlehensberechnung::getContent();
	}
}