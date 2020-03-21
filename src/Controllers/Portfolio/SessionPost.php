<?php
declare(strict_types=1);

namespace mvc_eins\Controllers\Portfolio;

/**
 * Class SessionPost
 * @package mvc_eins\Controllers\Portfolio
 */
class SessionPost
{
	private array $datensatzArray;
	private array $indexArray;
	private array $datensatz = [];

	/**
	 * SessionPost constructor.
	 * @param array $datensatzArray
	 * @param array $formularfelder
	 */
	public function __construct(array $datensatzArray, array $formularfelder)
	{
		$this->indexArray = $formularfelder;
		$this->datensatzArray = $datensatzArray;
		$_SESSION['datum'] = date('d.F Y');
		$this->datensatz['datum'] = $_SESSION['datum'];
	}

	private function zuweisenDatensatz() : void
	{
		foreach ($this->indexArray[ 'indexArray' ] as $item => $value) {
			//kein Pflichtfeld
			if (!isset($this->datensatzArray[ $item ])) {
				$this->datensatzArray[ $item ] = '';
			}
			if ($value === 'text') {
				$this->datensatz[ $item ] = ucwords($_SESSION[ $item ] = htmlspecialchars(rtrim(trim($this->datensatzArray[ $item ]))));
			} elseif ($value === 'textarea') {
				$_SESSION[ $item ] = htmlspecialchars($this->datensatzArray[ $item ]);
				$this->datensatz[ $item ] = wordwrap(str_replace(NLT, UB, $_SESSION[ $item ]), WIDTH, UB, true);
			} elseif ($value === 'array') {
				if (!empty($this->datensatzArray[ $item ])) {
					$val = '';
					unset($_SESSION[ $item ]);
					foreach ($this->datensatzArray[ $item ] as $checkitem) {
						$_SESSION[ $item ][] = $checkitem;
						$val .= $checkitem . ' ';
					}
					$this->datensatz[ $item ] = $val;
				} else {
					$this->datensatz[ $item ] = '';
				}
			} else {
				$_SESSION[$item] = htmlspecialchars($this->datensatzArray[$item]);
				$this->datensatz[$item] = $_SESSION[$item];
			}
		}
	}

	public function getDatensatz(): array
	{
		$this->zuweisenDatensatz();
		return $this->datensatz;
	}
}