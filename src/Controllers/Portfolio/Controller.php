<?php
declare(strict_types=1);

namespace mvc_eins\Controllers\Portfolio;
use mvc_eins\Interfaces\IController;
use mvc_eins\Models\FileOperations\DatensatzAuslesen;
use mvc_eins\Models\FileOperations\SpeichernDatensaetze;
use mvc_eins\Views\Portfolio\ViewPortfolio;

/**
 * Class Controller
 * @package mvc_eins\Controllers\Portfolio
 */
class Controller implements IController
{
	private DatensatzAuslesen $datensatz;

	public function indexAction() : void
	{
		$this->getView();
	}

	private function daten() : void
	{
		$this->datensatz = new DatensatzAuslesen(PORTFOLIO);
	}

	public function auslesenAction() : void
	{
		$_SESSION['index'] = 0;
		$this->daten();
		if (!empty($this->datensatz->getDatensatz())) {
			ViewPortfolio::getAuslesen($this->datensatz->getDatensatz(), PORTFOLIO_INI);
		} else {
			$this->getView();
		}
	}

	public function nextAction() : void
	{
		$this->daten();
		$this->datensatz->setNextDatensatz();
		ViewPortfolio::getAuslesen($this->datensatz->getDatensatz(), PORTFOLIO_INI);
	}

	public function backAction() : void
	{
		$this->daten();
		$this->datensatz->setBackDatensatz();
		ViewPortfolio::getAuslesen($this->datensatz->getDatensatz(), PORTFOLIO_INI);
	}

	public function deleteAction() : void
	{
		$this->daten();
		$this->datensatz->setDelDatensatz();
		ViewPortfolio::getMeldung($this->datensatz->getMeldung());
	}

	public function validateAction() : void
	{
		$instanzSessionPost = new SessionPost($_POST, PORTFOLIO_INI);
		$_SESSION['datensatz'] = $instanzSessionPost->getDatensatz();
		$_SESSION['ueberpruefung'] = $_SESSION['datensatz'];
		ViewPortfolio::getValidateEntry(PORTFOLIO_INI);
	}

	public function saveAction() : void
	{
		$_SESSION['datensatzspeichern'] = new SpeichernDatensaetze(PORTFOLIO, $_SESSION['datensatz']);
		ViewPortfolio::getMeldung($_SESSION['datensatzspeichern']->getMeldung());
	}

	private function getView() : void
	{
		ViewPortfolio::getContent();
	}
}