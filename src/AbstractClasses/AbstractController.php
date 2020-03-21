<?php
declare(strict_types=1);

namespace mvc_eins\AbstractClasses;

use mvc_eins\Interfaces\IController;
use mvc_eins\Library\RequestHandler;

/**
 * Class AbstractController
 * @package mvc_eins\AbstractClasses
 */
abstract class AbstractController implements IController
{
	/**
	 * @var RequestHandler
	 */
	private RequestHandler $request;

	/**
	 * AbstractController constructor.
	 * @param RequestHandler $request
	 */
	final public function __construct(RequestHandler $request)
    {
        $this->request = $request;
    }

	/**
	 * @return mixed
	 */
	abstract public function indexAction();
}