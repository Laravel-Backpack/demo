<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class TablerTheme
{
    public function handle($request, Closure $next): mixed
    {
        if (config('backpack.base.view_namespace') === 'backpack.theme-tabler::') {
            // Set layout if exist in session
            if (Session::has('backpack.theme-tabler.layout')) {
                Config::set('backpack.theme-tabler.layout', Session::get('backpack.theme-tabler.layout'));
            }
        }

        return $next($request);
    }
}
