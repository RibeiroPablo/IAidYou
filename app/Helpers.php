<?php namespace App;

class Helpers
{
    /**
     * Remove all non-numeric values from a string
     *
     * @param string $value
     * @return string|string[]|null
     */
    public static function onlyNumbers($value)
    {
        return preg_replace('/[^0-9]/','', $value);
    }
}
