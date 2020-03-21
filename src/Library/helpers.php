<?php
declare(strict_types=1);
// Helper functions \\

/**
 * var_dump and die for debugging
 * @param $data <p>data to debug</p>
 */
function dnd($data)
{
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
	die();
}

/**
 * print_r and die for debugging
 * @param $data <p>data to debug</p>
 */
function pnd($data)
{
	echo '<pre>';
	print_r($data);
	echo '</pre>';
	die();
}