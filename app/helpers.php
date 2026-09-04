<?php

if (!function_exists('backpack_pro_badge')) {
    /**
     * Echo a purple badge to tell the viewer this is a PRO feature.
     *
     * @param string $string
     *
     * @return string
     */
    function backpack_pro_badge(string $string = 'PRO')
    {
        return '<a href="https://backpackforlaravel.com/pricing" target="_blank" class="badge badge-pill badge-sm bg-primary bg-primary-lt mx-2" tabindex="-1">'.$string.'</a>';
    }
}

if (!function_exists('backpack_new_badge')) {
    /**
     * Echo a yellow badge to tell the viewer this is a NEW feature.
     *
     * @param string $string
     *
     * @return string
     */
    function backpack_new_badge(string $string = 'NEW')
    {
        return '<span class="badge badge-pill badge-sm bg-warning bg-warning-lt mx-2">'.$string.'</span>';
    }
}

if (!function_exists('backpack_free_badge')) {
    /**
     * Echo a green badge to tell the viewer this is a FREE feature.
     *
     * @param string $string
     *
     * @return string
     */
    function backpack_free_badge(string $string = 'FREE')
    {
        return '<span class="badge badge-pill badge-sm bg-success bg-success-lt mx-2">'.$string.'</span>';
    }
}

/*
|--------------------------------------------------------------------------
| Demo helpers
|--------------------------------------------------------------------------
|
| The visitor's theme, layout, skin and text direction, as chosen in the
| "Customize" drawer. They live in a long-lived cookie (not the session),
| so they survive logging out and are already there on the login page.
| Options live in config/demo.php; the cookie is written by DemoController.
|
*/

if (!function_exists('demo_choices')) {
    /**
     * Everything the visitor chose, as an array: theme, layout, skin, direction.
     */
    function demo_choices(): array
    {
        $raw = request()->cookie('demo');
        $choices = is_string($raw) ? json_decode($raw, true) : null;

        return is_array($choices) ? $choices : [];
    }
}

if (!function_exists('demo_theme')) {
    function demo_theme(): string
    {
        $theme = demo_choices()['theme'] ?? 'tabler';

        return array_key_exists($theme, config('demo.themes', [])) ? $theme : 'tabler';
    }
}

if (!function_exists('demo_layout')) {
    function demo_layout(): string
    {
        $layout = demo_choices()['layout'] ?? config('backpack.theme-tabler.layout', 'horizontal');

        return array_key_exists($layout, config('demo.layouts', [])) ? $layout : 'horizontal';
    }
}

if (!function_exists('demo_skin')) {
    function demo_skin(): string
    {
        $skin = demo_choices()['skin'] ?? config('demo.default_skin', 'clean');

        return array_key_exists($skin, config('demo.skins', [])) ? $skin : config('demo.default_skin', 'clean');
    }
}

if (!function_exists('demo_direction')) {
    function demo_direction(): string
    {
        $direction = demo_choices()['direction'] ?? config('backpack.ui.html_direction', 'ltr');

        return in_array($direction, ['ltr', 'rtl']) ? $direction : 'ltr';
    }
}
