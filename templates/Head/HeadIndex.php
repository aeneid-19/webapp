<?php
declare(strict_types=1);
namespace mvc_eins\Head;

/**
 * Class HeadIndex
 * @package mvc_eins\Template\Head
 */
class HeadIndex
    {
       public static function getHead(): void
       {
             require_once __DIR__ . '/header.tpl.php';
       }
    }

