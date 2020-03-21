<?php
declare(strict_types=1);

namespace mvc_eins\Models\Handlers;
/**
 * Class DataAccessHandler
 * @package mvc_eins\Models\Handlers
 */
class DataAccessHandler
{

    /**
     * @param string $item
     * @return bool
     */
    public static function checkIfExists(string $item): bool
    {
        return (file_exists($item));
    }

    /**
     * @param string $item
     * @return bool
     */
    public static function checkIfReadable(string $item): bool
    {
        return is_readable($item);
    }

    /**
     * @param string $item
     * @return bool
     */
    public static function checkIfWritable(string $item): bool
    {
        return is_writable($item);
    }
}