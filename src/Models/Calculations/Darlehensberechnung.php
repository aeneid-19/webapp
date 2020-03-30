<?php
declare(strict_types=1);

namespace mvc_eins\Models\Calculations;

/**
 * Class Darlehensberechnung
 * @package mvc_eins\Models\Darlehensberechnung
 */
class Darlehensberechnung
{
	private float $_jahreszinsen, $_jahrestilgung, $_annuitaet, $_monatsrate;
	private float $_gesamtzinsen = 0.0, $_gesamttilgung = 0.0, $_rueckzahlung = 0.0;
	private int $_zaehler = 0;
	private string $_letzteRate;
	private float $_kreditsumme;
	private float $_zinssatz;
	private int $_laufzeit;
	private array $_ergebnis;

	/**
	 * darlehen constructor.
	 * @param array $daten
	 */
	public function __construct(array $daten)
	{
		$this->_kreditsumme = $daten['Kreditsumme'];
		$this->_zinssatz = $daten['Zinssatz'] / 100;
		$this->_laufzeit = $daten['Laufzeit'];
		$this->erstelleErgebnisVorlage();
		switch ($daten['Darlehensart']) {
			case 'Ratenkredit':
				$this->berechneRatenkredit();
				break;
			case 'Annuitaetsdarlehen':
				$this->berechneAnnuitaetsdarlehen();
				break;
			case 'Festdarlehen':
				$this->berechneFestdarlehen();
				break;
		}
	}

	private function berechneRatenkredit() : void
	{
		$this->_jahrestilgung = round($this->_kreditsumme / $this->_laufzeit, 2);
		while ($this->_zaehler < $this->_laufzeit) {
			$this->_jahreszinsen = round($this->_kreditsumme * $this->_zinssatz, 2);
			$this->_annuitaet = $this->_jahrestilgung + $this->_jahreszinsen;
			$this->_monatsrate = round($this->_annuitaet / 12, 2);
			$this->_rueckzahlung += $this->_monatsrate * 12;
			$this->schreibeWerteInErgebnis();
		}
	}

	private function berechneAnnuitaetsdarlehen() : void
	{
		$this->_annuitaet = $this->_kreditsumme * (((((1 + $this->_zinssatz) ** $this->_laufzeit) * $this->_zinssatz)) /
				((((1 + $this->_zinssatz) ** $this->_laufzeit) - 1)));
		$this->_monatsrate = round($this->_annuitaet / 12, 2);
		$this->_annuitaet = $this->_monatsrate * 12;
		while ($this->_zaehler < $this->_laufzeit) {
			$this->_jahreszinsen = round($this->_kreditsumme * $this->_zinssatz, 2);
			$this->_jahrestilgung = $this->_annuitaet - $this->_jahreszinsen;
			$this->_rueckzahlung += $this->_monatsrate * 12;
			$this->schreibeWerteInErgebnis();
		}
	}

	private function berechneFestdarlehen() : void
	{
		$this->_jahrestilgung = 0.0;
		$this->_jahreszinsen = round($this->_kreditsumme * $this->_zinssatz, 2);
		$this->_monatsrate = round($this->_jahreszinsen / 12, 2);
		$this->_annuitaet = $this->_jahreszinsen;
		$this->_rueckzahlung = $this->_monatsrate * 12 * $this->_laufzeit;
		while ($this->_zaehler < $this->_laufzeit) {
			if ($this->_zaehler + 1 === $this->_laufzeit) {
				$this->_jahrestilgung = $this->_kreditsumme;
				$this->_annuitaet = $this->_jahrestilgung + $this->_jahreszinsen;
			}
			$this->schreibeWerteInErgebnis();
		}
	}

	private function schreibeWerteInErgebnis() : void
	{
		$this->_ergebnis[$this->_zaehler]['Restschuld'] = number_format($this->_kreditsumme, 2, ',', '.') . ' €';
		$this->_ergebnis[$this->_zaehler]['Zinsen'] = number_format($this->_jahreszinsen, 2, ',', '.') . ' €';
		$this->_ergebnis[$this->_zaehler]['Tilgung'] = number_format($this->_jahrestilgung, 2, ',', '.') . ' €';
		$this->_ergebnis[$this->_zaehler]['Annuität'] = number_format($this->_annuitaet, 2, ',', '.') . ' €';
		$this->_ergebnis[$this->_zaehler]['Monatsrate'] = number_format($this->_monatsrate, 2, ',', '.') . ' €';
		$this->_kreditsumme -= $this->_jahrestilgung;
		$this->_gesamtzinsen += $this->_jahreszinsen;
		$this->_gesamttilgung += $this->_jahrestilgung;
		if (++$this->_zaehler === $this->_laufzeit) {
			$gesamtvolumen = $this->_gesamtzinsen + $this->_gesamttilgung + $this->_kreditsumme;
			$this->_monatsrate += $gesamtvolumen - $this->_rueckzahlung;
			$this->_letzteRate = number_format($this->_monatsrate, 2, ',', '.') . ' €';
			$this->_ergebnis[$this->_zaehler]['Restschuld'] = '';
			$this->_ergebnis[$this->_zaehler]['Zinsen'] = number_format($this->_gesamtzinsen, 2, ',', '.') . ' €';
			$this->_ergebnis[$this->_zaehler]['Tilgung'] = number_format($this->_gesamttilgung + $this->_kreditsumme, 2, ',', '.') . ' €';
			$this->_ergebnis[$this->_zaehler]['Annuität'] = number_format($gesamtvolumen, 2, ',', '.') . ' €';
			$this->_ergebnis[$this->_zaehler]['Monatsrate'] = '';
		}
	}

	private function erstelleErgebnisVorlage() : void
	{
		$vorlage = ['Restschuld' => 0.0, 'Zinsen' => 0.0, 'Tilgung' => 0.0, 'Annuität' => 0.0, 'Monatsrate' => 0.0];
		for ($i = 0; $i <= $this->_laufzeit; $i++) {
			$this->_ergebnis[] = $vorlage;
		}
	}

	/**
	 * @return array
	 */
	public function getErgebnis() : array
	{
		return $this->_ergebnis;
	}

	/**
	 * @return string
	 */
	public function getLetzteRate() : string
	{
		return $this->_letzteRate;
	}
}