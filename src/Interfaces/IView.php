<?php
declare(strict_types=1);

namespace mvc_eins\Interfaces;

/**
 * Interface IView
 * @package mvc_eins\Interfaces
 */
interface IView
{
	public static function getContent(): void;
}