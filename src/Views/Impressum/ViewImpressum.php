<?php
declare(strict_types=1);

namespace mvc_eins\Views\Impressum;
use mvc_eins\Interfaces\IView;

/**
 * Class ViewImpressum
 * @package mvc_eins\Views\Impressum
 */
class ViewImpressum implements IView
{
	/**
	 * @param array $dataset [optional] <p>Data to be processed in the view</p>
	 */
	public static function getContent(array $dataset = []): void
    {
        require_once __DIR__ . '/impressum.php';
    }
}