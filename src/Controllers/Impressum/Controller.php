<?php
declare(strict_types=1);
namespace mvc_eins\Controllers\Impressum;
use mvc_eins\AbstractClasses\AbstractController;
use mvc_eins\Models\Datatable\DataTableArray;
use mvc_eins\Views\Impressum\ViewImpressum;

/**
 * Class Controller
 * @package mvc_eins\Controllers\Impressum
 */
class Controller extends AbstractController
{
    public function indexAction(): void
    {
        $this->getView();
    }

    private function getView(): void
    {
    	$dataset = new DataTableArray();
        ViewImpressum::getContent($dataset->getDatasetJson());
    }
}