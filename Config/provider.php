<?php

return [

/*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */


    'admins' => [
        'driver' => 'eloquent',
        'model' => Elightwalk\AuthGuard\Eloquent\Admins::class,
    ],
    'customers' => [
        'driver' => 'eloquent',
        'model' => Elightwalk\AuthGuard\Eloquent\Customers::class,
    ]
];
