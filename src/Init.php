<?php
declare(strict_types=1);

namespace mvc_eins;
use mvc_eins\Exceptions\NotFoundAction;
use mvc_eins\Exceptions\NotFoundController;
use mvc_eins\Library\ControllerFactory;
use mvc_eins\Library\RequestHandler;

/**
 * Class Init
 * @package mvc_eins
 */
class Init
{
    private object $requestHandler;
    private object $controllerFactory;
    private object $controller;

    public function __construct()
    {
            $this->requestHandler = new RequestHandler($_SERVER);
    }

	/**
	 * @return string
	 */
	public function  getControllerName(): string
    {
        return  $this->requestHandler->getControllerName();
    }

    public function setDisplay(): void
    {
        $this->controllerFactory = new ControllerFactory(__NAMESPACE__, $this->requestHandler);
        $this->controller = $this->controllerFactory->getController();
        $action = $this->requestHandler->getActionName().'Action'; // ActionName z. B. index -> $action = 'indexAction'
        $this->controller->$action();
    }
}