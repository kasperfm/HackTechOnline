<?php


if (!function_exists('useJSCache')) {
    function useJSCache()
    {
        if (config('hacktech.nojscache', true)) {
            return md5(time());
        }

        return md5(42);
    }
}