<?php
declare(strict_types=1);
namespace mvc_eins\Library;

/**
 * Class RequestHandler
 * @package mvc_eins\Library
 */
class RequestHandler
{
	private string $defaultAction = 'index';
	private string $defaultController = 'home';
	private string $requestUri;
	private string $controllerName;
	private string $actionName;

	/**
	 * RequestHandler constructor.
	 * @param array $serverVars
	 */
	public function __construct(array $serverVars)
	{
		$this->requestUri = $serverVars['REQUEST_URI'];
		$matches = $this->cutUriParts();
		$this->checkIfUriPartsExists($matches);
	}

	/**
	 * @return string
	 */
	public function getControllerName() : string
	{
		return ucfirst($this->controllerName);
	}

	/**
	 * @return string
	 */
	public function getActionName() : string
	{
		return $this->actionName;
	}

	/**
	 * @return array
	 */
	private function cutUriParts() : array
	{
		$pattern = '/^\/([^\/]+)?(\/([^\/]+))/';
		preg_match($pattern, $this->requestUri, $matches);
		return $matches;
	}

	/**
	 * @param array $matches
	 */
	private function checkIfUriPartsExists(array $matches) : void
	{
		$this->controllerName = $matches[1] ?? $this->defaultController;
		$this->actionName = $matches[3] ?? $this->defaultAction;
	}
}