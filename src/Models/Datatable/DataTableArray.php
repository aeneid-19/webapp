<?php
declare(strict_types=1);

namespace mvc_eins\Models\Datatable;

/**
 * Class DataTableArray
 * @package mvc_eins\Models\Datatable
 */
class DataTableArray
{
	/**
	 * @return array
	 */
	public function getDatasetArray() : array
	{
		$datensatz[] = ['Nachname', 'Vorname', 'Adresse'];
		$datensatz[] = ['Müller', 'Gerd', 'München'];
		$datensatz[] = ['Beckenbauer', 'Franz', 'München'];
		$datensatz[] = ['Hoeneß', 'Uli', 'München'];
		$datensatz[] = ['Maier', 'Sepp', 'München'];
		return $datensatz;
	}

	/**
	 * @return array
	 */
	public function getDatasetJson():array
	{
		//JavaScript Object Notation JSON
		return json_decode(file_get_contents(ROOT_PATH . '/src/Models/Datatable/datensatz.json'), true, 512, JSON_THROW_ON_ERROR);
	}
}