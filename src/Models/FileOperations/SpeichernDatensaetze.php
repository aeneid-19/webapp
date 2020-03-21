<?php
declare(strict_types=1);

namespace mvc_eins\Models\FileOperations;

/**
 * Class SpeichernDatensaetze
 * @package mvc_eins\Models\Portfolio
 */
class SpeichernDatensaetze
{
	private ?string $textfile;
	private ?array $datensatz;
	private array $getDatensatz = [];
	private string $info;

	/**
	 * SpeichernDatensaetze constructor.
	 * @param string     $textfile
	 * @param array|null $datensatz
	 */
	public function __construct(string $textfile, array $datensatz = null)
	{
		$this->textfile = $textfile;
		$this->datensatz = $datensatz;

		#Wenn TEXTFILE existiert und der Datensatz nicht leer ist
		if (!empty($this->datensatz) && file_exists($this->textfile)) {
			#Wenn Größe des TEXTFILEs nicht 0 ist
			if (filesize($textfile) !== 0) {
				$this->neuerDatensatzHinzufuegen();
				$this->datensatzSpeichern();
			} else {
				#Fügt dem leeren Array getDatensatz einen neuen Datensatz hinzu
				$this->getDatensatz[] = $this->datensatz;
				$this->datensatzSpeichern();
			}
		}
		#Wenn Datensatz leer
		elseif (empty($this->datensatz))
		{
			$this->info = 'kein neuer Datensatz vorhanden!!';
		}
		else
		{
			#Fügt dem leeren Array getDatensatz einen neuen Datensatz hinzu
			$this->getDatensatz[] = $this->datensatz;
			$this->datensatzSpeichern();
		}
	}

	private function neuerDatensatzHinzufuegen() : void
	{
		$this->getDatensatz = json_decode(file_get_contents($this->textfile), true, 512, JSON_THROW_ON_ERROR);
		$this->getDatensatz[] = $this->datensatz;
	}

	private function datensatzSpeichern() : void
	{
		$speichern = file_put_contents(PORTFOLIO, json_encode($this->getDatensatz, JSON_THROW_ON_ERROR, 512)); // file_put_contents($this->textfile, serialize($this->getDatensatz), LOCK_EX);
		if ($speichern) {
			$this->info = 'Datensatz erfolgreich gespeichert!!';
		} else {
			$this->info = 'Datensatz nicht erfolgreich gespeichert!!';
		}
	}

	/**
	 * @return string
	 */
	public function getMeldung(): string
	{
		return $this->info;
	}

	public function getDatensaetzeAuslesen() : void
	{

	}

	/**
	 * @return array
	 */
	public function getLetzterDatensatz(): array
	{
		return end($this->getDatensatz);
	}
}