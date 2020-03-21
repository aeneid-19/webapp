<?php
declare(strict_types=1);
namespace mvc_eins\Template\Foot;

/**
 * Class FootIndex
 * @package mvc_eins\Template\Foot
 */
class FootIndex
    {
       public static function getFoot(): void
       {
             require_once __DIR__ . '/footer.tpl.php';
        }
    }

