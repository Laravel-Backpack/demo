<?php

use App\Http\Middleware\CheckIfAdmin;
use Laravel\VaporUi\Http\Middleware\EnsureEnvironmentVariables;
use Laravel\VaporUi\Http\Middleware\EnsureUpToDateAssets;
use Laravel\VaporUi\Http\Middleware\EnsureUserIsAuthorized;

return [

    /*
    |--------------------------------------------------------------------------
    | Vapor UI Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to every Vapor UI route - giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => [
        'web',
        EnsureUserIsAuthorized::class,
        EnsureEnvironmentVariables::class,
        EnsureUpToDateAssets::class,
        CheckIfAdmin::class,
    ],

];
