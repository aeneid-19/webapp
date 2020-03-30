<?php
declare(strict_types=1);

namespace mvc_eins\Controllers\Wertschoepfung;
use mvc_eins\AbstractClasses\AbstractController;
use mvc_eins\Models\Calculations\Wertschoepfung;
use mvc_eins\Views\Wertschoepfung\ViewWertschoepfung;

/**
 * Class Controller
 * @package mvc_eins\Controllers\Wertschoepfung
 */
class Controller extends AbstractController
{
	private string $dateipfad = ROOT_PATH . 'Textfiles' . DS . 'Wertschoepfung.json';
	private Wertschoepfung $datensatz;

	/**
	 * @inheritDoc
	 */
	public function indexAction()
	{
		$this->datensatz = new Wertschoepfung($this->dateipfad);
		$this->getView();
	}

	private function getView() : void
	{
		ViewWertschoepfung::getContent($this->datensatz->getJahre(), $this->datensatz->getErgebnis());
	}
}