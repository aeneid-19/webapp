<?php
declare(strict_types=1);

namespace mvc_eins\Controllers\AboutMe;
use mvc_eins\Interfaces\IController;
use mvc_eins\Views\AboutMe\ViewAboutMe;

/**
 * Class Controller
 * @package mvc_eins\Controllers\AboutMe
 */
class Controller implements IController
{
    public function indexAction(): void
    {
        $this->getView();
    }

    private function getView(): void
    {
        ViewAboutMe::getContent();
    }
}