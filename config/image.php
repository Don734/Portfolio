<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports “GD Library” and “Imagick” to process images
    | internally. Depending on your PHP setup, you can choose one of them.
    |
    | Included options:
    |   - \Intervention\Image\Drivers\Gd\Driver::class
    |   - \Intervention\Image\Drivers\Imagick\Driver::class
    |
    */

    'driver' => \Intervention\Image\Drivers\Gd\Driver::class,

    /*
    |--------------------------------------------------------------------------
    | Configuration Options
    |--------------------------------------------------------------------------
    |
    | These options control the behavior of Intervention Image.
    |
    | - "autoOrientation" controls whether an imported image should be
    |    automatically rotated according to any existing Exif data.
    |
    | - "decodeAnimation" decides whether a possibly animated image is
    |    decoded as such or whether the animation is discarded.
    |
    | - "blendingColor" Defines the default blending color.
    */

    'options' => [
        'autoOrientation' => true,
        'decodeAnimation' => true,
        'blendingColor' => 'ffffff',
        'post_config' => [
            'main_strict' => true,
            'main_width' => 1024,
            'main_height' => 400,
            'preview_strict' => true,
            'preview_width' => 300,
            'preview_height' => 300,
            'thumb_strict' => true,
            'thumb_width' => 280,
            'thumb_height' => 280,
            'extension' => "png",
            'upsize' => false,
        ],
        'project_config' => [
            'main_strict' => true,
            'main_width' => 715,
            'main_height' => 715,
            'preview_strict' => true,
            'preview_width' => 680,
            'preview_height' => 680,
            'thumb_strict' => true,
            'thumb_width' => 120,
            'thumb_height' => 120,
            'extension' => "png",
            'upsize' => false,
        ],
        'banner_config' => [
            'main_strict' => true,
            'main_width' => 715,
            'main_height' => 715,
            'preview_strict' => true,
            'preview_width' => 680,
            'preview_height' => 680,
            'thumb_strict' => true,
            'thumb_width' => 120,
            'thumb_height' => 120,
            'extension' => "png",
            'upsize' => false,
        ],
        'user_config' => [
            'main_strict' => true,
            'main_width' => 512,
            'main_height' => 512,
            'preview_strict' => true,
            'preview_width' => 250,
            'preview_height' => 250,
            'thumb_strict' => true,
            'thumb_width' => 100,
            'thumb_height' => 100,
            'extension' => "png",
            'upsize' => false,
        ],
    ]
];
