<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/drugs/*',
        '/drugs/category',
        '/*',
        '/drugs',
        '/drug-categories',
        '/drug-categories/*',
        '/purchases',
        '/purchases/*',
        '/purchases-user/*',
        '/purchases-drug/*',
        '/subscribe',
        '/unsubscribe',
        '/subscription',
    ];
}
