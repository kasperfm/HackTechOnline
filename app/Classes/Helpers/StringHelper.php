<?php

namespace App\Classes\Helpers;


class StringHelper
{
    public static function camelCaseToWords($str) : string
    {
        $splitCamelArray = preg_split('/(?=[A-Z])/', $str);

        return ucwords(implode(' ', $splitCamelArray,));
    }
}