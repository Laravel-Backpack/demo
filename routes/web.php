<?php

use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| The demo has no front-end: everything happens in the admin panel.
|
*/

Route::get('/', fn () => redirect(backpack_url('dashboard')));

// Remember the visitor's skin, layout, theme and text direction (session only).
// Deliberately outside the admin middleware, so the login page can offer the same choices.
Route::post(config('backpack.base.route_prefix', 'admin').'/demo/switch-theme', [DemoController::class, 'switchTheme'])
    ->name('demo.switch-theme');

// Local development only: log in as any user without typing a password.
// Example: /dev/login-as/admin@example.com
if (app()->environment('local')) {
    Route::get('dev/login-as/{email?}', function (?string $email = null) {
        $user = \App\User::where('email', $email ?? 'admin@example.com')->firstOrFail();
        backpack_auth()->login($user);

        return redirect(backpack_url('dashboard'));
    });

    // Local development only: log in with a given skin and layout, then open the dashboard.
    // Handy for taking screenshots. Example: /dev/preview/aurora/horizontal
    Route::get('dev/preview/{skin}/{layout?}', function (string $skin, string $layout = 'horizontal') {
        abort_unless(array_key_exists($skin, config('demo.skins')), 404);
        abort_unless(array_key_exists($layout, config('demo.layouts')), 404);

        backpack_auth()->login(\App\User::where('email', 'admin@example.com')->firstOrFail());
        \Illuminate\Support\Facades\Cookie::queue('demo', json_encode(['theme' => 'tabler', 'skin' => $skin, 'layout' => $layout]), DemoController::COOKIE_LIFETIME);

        return redirect(backpack_url('dashboard'));
    });
}
