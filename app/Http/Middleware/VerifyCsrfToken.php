<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //Allow all
        '*',
    ];
    protected $except2 = [
        //
        'api/*',
        'sub.domain.zone' => [
            'prefix/*'
        ],
        //Localhost 5173
        'http://localhost:5173/api/*',
        'http://localhost:5173/*',
        'localhost:5173/*',
    ];
}
