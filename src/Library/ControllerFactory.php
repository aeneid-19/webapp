<?php
declare(strict_types=1);

namespace mvc_eins\Library;

use mvc_eins\Exceptions\NotFoundAction;
use mvc_eins\Exceptions\NotFoundController;
use mvc_eins\Interfaces\IController;

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
	 * @throws NotFoundAction
	 * @throws NotFoundController
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
    private function buildControllerPath(): void
    {
        $this->controllerPath = ROOT_PATH . 'src/Controllers/' . $this->request->getControllerName() . '/Controller.php';
    }

    /**
     * @throws NotFoundController
     */
    private function checkIfControllerExists(): void
    {
        if (!file_exists($this->controllerPath)) {
            throw new NotFoundController($this->request->getControllerName() . ' Controller existiert nicht!');
        }
    }

    /**
     * @throws NotFoundAction
     */
    private function checkIfActionExists(): void
    {
        if (!method_exists($this->controller, $this->request->getActionName() . 'Action')) {
            throw new NotFoundAction($this->request->getActionName() . 'Action existiert nicht!');
        }
        /* $methods = get_class_methods($this->controllerName);
         foreach ($methods as $method) {
             if(substr($method, -6) !== 'Action') {
                 continue;
             }
             if($this->request->getActionName().'Action'===$method) {
                 return true;
             }
         }
         throw new NotFoundAction($this->request->getActionName() . ' Action existiert nicht in ' . $this->request->getControllerName() . 'Controller');*/
    }

    /**
     * @return IController|object
     */
    public function getController(): IController
    {
        return $this->controller;
    }

    /**
     * Zusammenbau des Pfades zum Controllers
     * Setzt use dynamisch zusammen. use \mvc_eins\Controllers\xxx\Controllers (Klasse)
     */
    private function buildControllerNameWithNamespace(): void
    {
        $this->controllerName = '\\' . $this->namespace . '\\Controllers\\' . $this->request->getControllerName() . '\\Controller';
    }

    /**
     * Erzeugt ein Object der jeweiligen Controllerklasse
     */
    private function loadController(): void
    {
        $this->controller = new $this->controllerName($this->request);
    }
}