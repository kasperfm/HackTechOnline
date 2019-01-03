<?php

namespace App\Classes\Helpers;


class StringHelper
{
    static function camelCaseToWords($str) {
        $splitCamelArray = preg_split('/(?=[A-Z])/', $str);

        return ucwords(implode($splitCamelArray, ' '));
    }
}