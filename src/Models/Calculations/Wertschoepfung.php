<?php
declare(strict_types=1);

namespace mvc_eins\Models\Calculations;

/**
 * Class Wertschoepfung
 * @package mvc_eins\Models\Wertschoepfung
 */
class Wertschoepfung
{
	private array $_jahresstatistiken;
	private array $_berechnungsArray = [];
	private array $_ergebnisArray = [];
	private array $_jahre = [];

	/**
	 * Wertschoepfung constructor.
	 * @param string $dateipfad
	 */
	public function __construct(string $dateipfad)
	{
		$this->_jahresstatistiken = json_decode(file_get_contents($dateipfad), true, 512, JSON_THROW_ON_ERROR);
		$this->erstelleErgebnisVorlage();
		$this->erstelleBerechnungsArray();
		$this->erstelleErgebnisArray();
	}

	private function erstelleBerechnungsArray() : void
	{
		$this->_berechnungsArray = $this->_ergebnisArray;
		foreach ($this->_jahresstatistiken as $jahr => $wirtschaftsbereiche) {
			foreach ($wirtschaftsbereiche as $bereich => $wert) {
				$this->_berechnungsArray[$bereich][] = $wert;
			}
		}
		foreach (array_keys($this->_jahresstatistiken) as $value) {
			$this->_berechnungsArray['Bruttowertschöpfung'][] = array_sum($this->_jahresstatistiken[$value]);
		}
	}

	private function erstelleErgebnisArray() : void
	{
		foreach ($this->_berechnungsArray as $key => $wirtschaftsbereich) {
			$zaehler = 0;
			foreach ($wirtschaftsbereich as $wert) {
				$this->_ergebnisArray[$key][] = number_format($wert, 1, ',', '.');
				$this->_ergebnisArray[$key][] = $this->berechneAnteil($zaehler, $wert);
				$this->_ergebnisArray[$key][] = $this->berechneDynamik($wirtschaftsbereich, $wert);
				$zaehler++;
			}
		}
	}

	private function erstelleErgebnisVorlage() : void
	{
		$this->_jahre = array_keys($this->_jahresstatistiken);
		$erstesArray = $this->_jahresstatistiken[array_key_first($this->_jahresstatistiken)];
		$schluessel = array_keys($erstesArray);
		$schluessel[] = 'Bruttowertschöpfung';
		$this->_ergebnisArray = array_fill_keys($schluessel, []);
	}

	/**
	 * @param int   $zaehler
	 * @param float $wert
	 * @return string <p>
	 * Returns convertet string of number.
	 * </p>
	 */
	private function berechneAnteil(int $zaehler, float $wert) : string
	{
		return number_format($wert / $this->_berechnungsArray['Bruttowertschöpfung'][$zaehler] * 100, 1, ',', '.') . ' %';
	}

	/**
	 * @param array $wirtschaftsbereich
	 * @param float $wert
	 * @return string <p>
	 * Returns convertet string of number.
	 * </p>
	 */
	private function berechneDynamik(array $wirtschaftsbereich, float $wert) : string
	{
		return number_format($wert / $wirtschaftsbereich[0] * 100, 0, ',', '.');
	}

	/**
	 * @return array
	 */
	public function getErgebnis() : array
	{
		return $this->_ergebnisArray;
	}

	/**
	 * @return array
	 */
	public function getJahre() : array
	{
		return $this->_jahre;
	}
}