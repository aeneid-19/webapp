<?php
declare(strict_types=1);
namespace mvc_eins;
use Exception;
use mvc_eins\Exceptions\NotFoundAction;
use mvc_eins\Exceptions\NotFoundController;
use mvc_eins\Template\Foot\FootIndex;
use mvc_eins\Template\Head\HeadIndex;
use mvc_eins\Template\Navi\NaviIndex;

require __DIR__ . '/config/config.php';

//dnd($_POST);
try {
$init = new Init();
$_SESSION['activeItem']=$init->getControllerName();
$_SESSION['title']=$_SESSION['activeItem'];
HeadIndex::getHead();
NaviIndex::getNavi($_SESSION['activeItem']);
$init->setDisplay();
} catch (NotFoundAction | NotFoundController | Exception $e) {
   echo $e->getMessage();
   #header('Refresh:0;http://webapp.local/');
}

FootIndex::getFoot();