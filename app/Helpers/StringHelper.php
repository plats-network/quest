<?php

namespace App\Helpers;

class StringHelper
{
    public static function checkSearchString($word, $str)
    {
        if (str_contains($str, $word) !== false) {
            return true;
        }

        return false;
    }

    /**
     * Camel case to underscore string input
     *
     * @return string
     */
    public static function decamelize($string)
    {
        return strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $string));
    }
}
