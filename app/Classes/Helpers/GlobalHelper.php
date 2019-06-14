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

if (!function_exists('currentPlayer')) {
    function currentPlayer()
    {
        return App\Classes\Game\Handlers\UserHandler::player();
    }
}

if (!function_exists('getUser')) {
    function getUser($userID)
    {
        return App\Classes\Game\Handlers\UserHandler::getUser($userID);
    }
}