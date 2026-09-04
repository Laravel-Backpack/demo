<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

/**
 * Applies the visitor's demo choices (theme, layout, skin, text direction)
 * on top of the Backpack config, for this request only.
 *
 * The choices live in the "demo" cookie, written by App\Http\Controllers\DemoController;
 * the options themselves live in config/demo.php.
 */
class Theme
{
    public function handle($request, Closure $next): mixed
    {
        $theme = config('demo.themes.'.demo_theme());
        Config::set('backpack.ui.view_namespace', $theme['view_namespace']);

        // Layouts and skins are Tabler features.
        if ($theme['view_namespace'] === 'backpack.theme-tabler::') {
            Config::set('backpack.theme-tabler.layout', demo_layout());
            Config::set('backpack.theme-tabler.styles', array_merge(
                config('demo.base_styles'),
                config('demo.skins.'.demo_skin().'.styles', [])
            ));
        }

        Config::set('backpack.ui.html_direction', demo_direction());

        return $next($request);
    }
}
