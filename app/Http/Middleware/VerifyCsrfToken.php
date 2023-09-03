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
        '/v1/license/validate',
        '/v1/license/invalidate/details',
        '/v1/license/ghost/details',
        '/v1/license/integrity/details'
    ];
}
