<?php

namespace App\Http\Middleware;

use App\Http\Controllers\DemoController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;

/**
 * Applies the visitor's demo choices (theme, layout, skin, text direction)
 * on top of the Backpack config, for this request only.
 *
 * The choices live in the "demo" cookie, written by App\Http\Controllers\DemoController;
 * the options themselves live in config/demo.php.
 *
 * Deep links: ?skin=<key> and ?layout=<key> on any URL apply that choice and
 * remember it, so the website can link straight into the demo wearing a skin.
 */
class Theme
{
    public function handle(Request $request, Closure $next): mixed
    {
        $this->applyDeepLinks($request);

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

    /**
     * Turn ?skin= and ?layout= query parameters into remembered choices.
     */
    private function applyDeepLinks(Request $request): void
    {
        $choices = [];

        if (array_key_exists((string) $request->query('skin'), config('demo.skins', []))) {
            $choices['skin'] = $request->query('skin');
        }

        if (array_key_exists((string) $request->query('layout'), config('demo.layouts', []))) {
            $choices['layout'] = $request->query('layout');
        }

        if (!$choices) {
            return;
        }

        $merged = json_encode(array_merge(demo_choices(), $choices));

        // For this request (the helpers read the request cookie) and for the next ones.
        $request->cookies->set('demo', $merged);
        Cookie::queue('demo', $merged, DemoController::COOKIE_LIFETIME);
    }
}
