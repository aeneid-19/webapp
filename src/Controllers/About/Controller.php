<?php
declare(strict_types=1);

namespace mvc_eins\Controllers\About;
use mvc_eins\Interfaces\IController;
use mvc_eins\Views\About\ViewAbout;

/**
 * Class Controller
 * @package mvc_eins\Controllers\About
 */
class Controller implements IController
{
    public function indexAction(): void
    {
        $this->getView();
    }

    private function getView(): void
    {
        ViewAbout::getContent();
    }
}