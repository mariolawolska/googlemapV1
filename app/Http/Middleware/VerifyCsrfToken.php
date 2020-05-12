<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware {

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'https://googlemapv1.wolscy.com/resources/js/map.js?mapId=*',
        'https://www.googlemapv1.wolscy.com/resources/js/map.js?mapId=*',
        'https://googlemapv1.wolscy.com/public/getNearBy',
        'https://www.googlemapv1.wolscy.com/public/getNearBy',
    ];

}
