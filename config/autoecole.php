<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Contact Email
    |--------------------------------------------------------------------------
    |
    | This is the email address where contact form submissions will be sent.
    |
    */

    'contact_email' => env('CONTACT_EMAIL', 'contact@autoecole.com'),

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    |
    | Default pagination settings for the application.
    |
    */

    'pagination' => [
        'per_page' => env('PAGINATION_PER_PAGE', 15),
        'users_per_page' => env('USERS_PAGINATION', 15),
    ],

    /*
    |--------------------------------------------------------------------------
    | File Upload Settings
    |--------------------------------------------------------------------------
    |
    | Configuration for file uploads in the application.
    |
    */

    'uploads' => [
        'max_size' => 2048, // in KB (2MB)
        'allowed_image_types' => ['jpeg', 'png', 'jpg', 'gif'],
        'directories' => [
            'users' => 'users',
            'vehicles' => 'vehicles',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Date & Time Formats
    |--------------------------------------------------------------------------
    |
    | Default date and time formats for the application.
    |
    */

    'date_format' => 'Y-m-d',
    'time_format' => 'H:i',
    'datetime_format' => 'Y-m-d H:i:s',

    /*
    |--------------------------------------------------------------------------
    | Currency Settings
    |--------------------------------------------------------------------------
    |
    | Currency settings for payments and financial reports.
    |
    */

    'currency' => [
        'symbol' => env('CURRENCY_SYMBOL', 'MAD'),
        'position' => env('CURRENCY_POSITION', 'after'), // before or after
        'decimals' => 2,
    ],

];
