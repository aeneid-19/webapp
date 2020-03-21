<?php
declare(strict_types=1);

namespace mvc_eins\Views\About;
use mvc_eins\Interfaces\IView;

/**
 * Class ViewAbout
 * @package mvc_eins\Views\About
 */
class ViewAbout implements IView
{
	/**
	 * @param array $dataset [optional] <p>Data to be processed in the view</p>
	 */
	public static function getContent(array $dataset = []): void
    {
        require_once __DIR__ . '/about.php';
    }
}