<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class Theme
{
    public function handle($request, Closure $next): mixed
    {
        // Set theme if exists
        if (Session::has('backpack.ui.view_namespace')) {
            Config::set('backpack.ui.view_namespace', Session::get('backpack.ui.view_namespace'));
        }

        // Set layout if exist in session — only for Tabler
        if (Session::get('backpack.ui.view_namespace') === 'backpack.theme-tabler::') {
            Config::set('backpack.theme-tabler.layout', Session::get('backpack.theme-tabler.layout') ?? config('backpack.theme-tabler.layout'));

            // Set styles if exist in session — only for Tabler
            $sessionStyles = Session::get('backpack.theme-tabler.styles');
            if ($sessionStyles !== null && !empty($sessionStyles)) {
                Config::set('backpack.theme-tabler.styles', $sessionStyles);
            }
        }

        // Set HTML direction if exists in session
        if (Session::has('backpack.ui.html_direction')) {
            Config::set('backpack.ui.html_direction', Session::get('backpack.ui.html_direction'));
        }

        return $next($request);
    }
}
