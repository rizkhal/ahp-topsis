<?php

declare (strict_types = 1);

namespace App\Constants;

abstract class BaseConstant
{
    /**
     * The abstract method for constant
     * 
     * @return array
     */
    abstract public static function labels(): array;

    /**
     * Get the label from array labels
     * 
     * @param  int    $int
     * @return string
     */
    public static function label(int $int): string
    {
        return static::labels()[$int];
    }
}
