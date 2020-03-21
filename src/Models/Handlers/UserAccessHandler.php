<?php
declare(strict_types=1);

namespace mvc_eins\Models\Handlers;

/**
 * Class UserAccessHandler
 * @package mvc_eins\Models\Handlers
 */
class UserAccessHandler
{

	/**
	 * @param string $username
	 * @param string $password
	 * @return bool
	 */
	public static function checkLogin(string $username, string $password) : bool
	{
		// TODO: implement
		if ($username === array_search($password, self::getUserData(), true)) {
			$_SESSION['login'] = true;
			return true;
		}
		return false;
	}

	/**
	 * @return array
	 */
	private static function getUserData(): array
	{
		return json_decode(file_get_contents(ROOT_PATH . 'Textfiles' . DS . 'users.json'), true, 512, JSON_THROW_ON_ERROR);
	}
}