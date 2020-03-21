<?php
declare(strict_types=1);

namespace mvc_eins\Controllers\Contact;
use mvc_eins\AbstractClasses\AbstractController;
use mvc_eins\Views\Contact\ViewContact;

/**
 * Class Controller
 * @package mvc_eins\Controllers\Contact
 */
class Controller extends AbstractController
{
    public function indexAction(): void
    {
        $this->getView();
    }

    private function getView(): void
    {
        ViewContact::getContent();
    }
}