<?php
declare(strict_types=1);
namespace mvc_eins\Controllers\ContactMe;
use mvc_eins\AbstractClasses\AbstractController;
use mvc_eins\Views\ContactMe\ViewContactMe;

/**
 * Class Controller
 * @package mvc_eins\Controllers\ContactMe
 */
class Controller extends AbstractController
{
    public function indexAction(): void
    {
        $this->getView();
    }

    private function getView(): void
    {
        ViewContactMe::getContent();
    }
}