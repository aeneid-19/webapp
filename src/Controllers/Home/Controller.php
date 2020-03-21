<?php
declare(strict_types=1);

namespace mvc_eins\Controllers\Home;
use mvc_eins\AbstractClasses\AbstractController;
use mvc_eins\Views\Home\ViewHome;

/**
 * Class Controller
 * @package mvc_eins\Controllers\Home
 */
class Controller extends AbstractController
{
    public function indexAction(): void
    {
        $this->getView();
    }

    private function getView(): void
    {
        ViewHome::getContent();
    }
}