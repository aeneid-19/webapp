<?php
declare(strict_types=1);

namespace mvc_eins\Controllers\DB;

use mvc_eins\AbstractClasses\AbstractController;
use mvc_eins\Services\DBconnect\DB;

/**
 * Class Controller
 * @package mvc_eins\Controllers\DB
 */
class Controller extends AbstractController
{

	/**
	 * @inheritDoc
	 */
	public function indexAction()
	{
		// TODO: Implement indexAction() method.
		if ($db = DB::getInstance()){
			echo 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
		} else {
			echo 'sgoiwnrgpijnwspkgnsdpkgngpkn';
		}
	}
}