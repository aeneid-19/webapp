<?php
declare(strict_types=1);
namespace mvc_eins\Views\Login;

use mvc_eins\Interfaces\IView;

/**
 * Class ViewLogin
 * @package mvc_eins\Views\Login
 */
class ViewLogin implements IView
{
	/**
	 * @param string|null $errormsg [optional] <p>
	 * May receive an error message from the controller.
	 * </p>
	 */
	public static function getContent(string $errormsg = null): void
    {
        require_once __DIR__ . '/login.php';
    }
}