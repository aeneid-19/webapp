<?php
declare(strict_types=1);

namespace mvc_eins\Library;
use mvc_eins\Interfaces\IController;
use RuntimeException;

/**
 * Class ControllerFactory
 * @package mvc_eins\Library
 */
class ControllerFactory
{
	/**
	 * @var string $namespace
	 * @var object $request
	 * @var object $controller
	 * @var string $controllerName
	 */
	private string $namespace;
	private object $request;
	private object $controller;
	private string $controllerName;
	private string $controllerPath;

	/**
	 * ControllerFactory constructor.
	 * @param string         $namespace
	 * @param RequestHandler $request
	 */
	public function __construct(string $namespace, RequestHandler $request)
	{
		$this->namespace = $namespace;
		$this->request = $request;
		$this->buildControllerNameWithNamespace();
		$this->buildControllerPath();
		$this->checkIfControllerExists();
		$this->loadController();
		$this->checkIfActionExists();
	}

	/**
	 * Builds the path to the controller
	 */
	private function buildControllerPath() : void
	{
		$this->controllerPath = ROOT_PATH . 'src/Controllers/' . $this->request->getControllerName() . '/Controller.php';
	}

	private function checkIfControllerExists() : void
	{
		if (!file_exists($this->controllerPath)) {
			throw new RuntimeException($this->request->getControllerName() . ' Controller existiert nicht!');
		}
	}

	private function checkIfActionExists() : void
	{
		if (!method_exists($this->controller, $this->request->getActionName() . 'Action')) {
			throw new \RuntimeException($this->request->getActionName() . 'Action existiert nicht!');
		}
	}

	/**
	 * @return IController|object
	 */
	public function getController() : IController
	{
		return $this->controller;
	}

	/**
	 * Zusammenbau des Pfades zum Controllers
	 * Setzt use dynamisch zusammen. use \mvc_eins\Controllers\xxx\Controllers (Klasse)
	 */
	private function buildControllerNameWithNamespace() : void
	{
		$this->controllerName = '\\' . $this->namespace . '\\Controllers\\' . $this->request->getControllerName() . '\\Controller';
	}

	/**
	 * Erzeugt ein Object der jeweiligen Controllerklasse
	 */
	private function loadController() : void
	{
		$this->controller = new $this->controllerName($this->request);
	}
}