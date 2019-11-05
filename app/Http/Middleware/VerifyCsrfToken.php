<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/game/web/*',
        '/game/module/FileViewer/get/list'
    ];

    protected function tokensMatch($request)
    {
        return (($request->session()->token() == $request->input('_token')) ||
            ($request->session()->token() == $request->header('x-csrf-token')));
    }
}
