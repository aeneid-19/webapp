<?php
declare(strict_types=1);
namespace mvc_eins\Controllers\Access;
use mvc_eins\AbstractClasses\AbstractController;
use mvc_eins\Models\Handlers\UserAccessHandler;
use mvc_eins\Views\Home\ViewHome;
use mvc_eins\Views\Login\ViewLogin;

/**
 * Class Controller
 * @package mvc_eins\Controllers\Login
 */
class Controller extends AbstractController
{
	public function indexAction(): void
	{
		$this->getView();
	}

	/**
	 * @param string|null $errormsg [optional] <p>
	 * May send an error message back to the view.
	 * </p>
	 */
	private function getView(string $errormsg = null): void
	{
		ViewLogin::getContent($errormsg);
	}

	public function loginAction(): void
	{
		//dnd($_POST);
		// TODO: Force input in both fields through HTML/CSS.
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$this->getView('Incomplete input! Fill out both fields.');
		} elseif (\strlen($_POST['password']) < 6) {
			$this->getView('Your password must have at least 6 characters!');
		} elseif (preg_match('/[\W]+/', $_POST['username'])) {
			if (UserAccessHandler::checkLogin(htmlspecialchars(stripslashes(trim($_POST['username']))), htmlspecialchars(trim($_POST['password'])))) {
				ViewHome::getContent();
			} else {
				$this->getView('Login data was invalid.');
			}
		} else {
			$this->getView('Your username has illegal characters! Only A-Z, a-z, 0-9 and _ are allowed.');
		}
	}
	
	public function logoutAction(): void
	{
		// TODO: add funtionality (remove/change buttons, deny access...)
		session_destroy();
		session_start();
	}

	public function registerAction(): void
	{
		// TODO: implement
	}

	private function authRegister()
	{
		// TODO: check if user input has all required params
		// TODO: create Register model that adds the new user to the Users.json file
	}
}