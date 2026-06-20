<?php

use Intervention\Image\Drivers\Gd\Driver;

return [
    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports GD, Imagick, and libvips. GD is the most
    | widely available option for local Laravel development.
    |
    */

    'driver' => env('IMAGE_DRIVER', Driver::class),

    /*
    |--------------------------------------------------------------------------
    | Configuration Options
    |--------------------------------------------------------------------------
    */

    'options' => [
        'autoOrientation' => true,
        'decodeAnimation' => true,
        'backgroundColor' => 'ffffff',
        'strip' => false,
    ],
];
