<?php
declare(strict_types=1);

namespace mvc_eins\Models\FileOperations;
use function count;

/**
 * Class DatensatzAuslesen
 * @package mvc_eins\Models\Portfolio
 */
class DatensatzAuslesen
{
	private string $textfile;
	private array $datensaetze;
	private string $info;

	/**
	 * DatensatzAuslesen constructor.
	 * @param string $textfile
	 */
	public function __construct(string $textfile)
	{
		$this->textfile = $textfile;
		$this->datensaetze = json_decode(file_get_contents($this->textfile), true, 512, JSON_THROW_ON_ERROR);
	}

	public function setNextDatensatz() : void
	{
		($_SESSION['index'] < count($this->datensaetze) - 1) ? $this->datensaetze[$_SESSION['index']++] : $_SESSION['index'] = 0;
	}

	public function setBackDatensatz() : void
	{
		($_SESSION['index']) > 0 ? $this->datensaetze[$_SESSION['index']--] : $_SESSION['index'] = count($this->datensaetze) - 1;
	}

	public function setDelDatensatz() : void
	{
		// TODO: implement going back to read datasets.
		array_splice($this->datensaetze, $_SESSION['index'], 1);
		if (file_put_contents($this->textfile, json_encode($this->datensaetze, JSON_THROW_ON_ERROR, 512))) {
			$this->info = 'Ihr Datensatz wurde gelöscht';
		} else {
			$this->info = 'Ihr Datensatz wurde nicht gelöscht';
		}
		//session_destroy();
	}

	/**
	 * @return array
	 */
	public function getDatensatz() : array
	{
		return $this->datensaetze[$_SESSION['index']] ?? [];
	}

	/**
	 * @return string
	 */
	public function getMeldung() : string
	{
		return $this->info;
	}
}