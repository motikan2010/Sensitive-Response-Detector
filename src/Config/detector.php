<?php

return [

    'enabled' => env('DETECTOR_ENABLED', true),

    'block' => [
        'view' => env('DETECTOR_VIEW', null),
        'redirect' => env('DETECTOR_REDIRECT', null),
        'abort' => env('DETECTOR_ABORT', false),
        'code' => env('DETECTOR_CODE', 403),
    ],

    'patterns' => [
        '#[\w\.=-]+@[\w\.-]+\.[\w]{2,3}#i',
        '#\d{1,3}[.]\d{1,3}[.]\d{1,3}[.]\d{1,3}#i',
        '#(?:5[1-5][0-9]{2}|222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12}#',
        '#\b([4]\d{3}[\s]\d{4}[\s]\d{4}[\s]\d{4}|[4]\d{3}[-]\d{4}[-]\d{4}[-]\d{4}|[4]\d{3}[.]\d{4}[.]\d{4}[.]\d{4}|[4]\d{3}\d{4}\d{4}\d{4})\b#',
    ]

];
