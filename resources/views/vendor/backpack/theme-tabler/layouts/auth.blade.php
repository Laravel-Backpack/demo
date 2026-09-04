{{--
    Demo override of the Tabler auth layout (login, register, password reset).
    Same as the theme's own, plus the "Customize" drawer, so visitors can pick
    their skin and layout before they log in. Links from the website use
    ?open_drawer=true to open it right away.
--}}
<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" dir="{{ backpack_theme_config('html_direction') }}">

<head>
    @include(backpack_view('inc.head'))
    <style>
        footer {
            width: 100%;
            position: fixed;
            bottom: 0;
            background-color: transparent !important;
            border: none !important;
        }
        .switch-mode {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 999;
        }
    </style>
</head>

<body class="{{ backpack_theme_config('classes.body') }} @if(backpack_theme_config('auth_layout') === 'cover') d-flex flex-column theme-light @endif">

@include(backpack_view('layouts.partials.light_dark_mode_logic'))

@if(backpack_theme_config('options.showColorModeSwitcher'))
    <div class="switch-mode p-3">
        @includeWhen(backpack_theme_config('options.showColorModeSwitcher'), backpack_view('layouts.partials.switch_theme'))
    </div>
@endif

@yield('content')

{{-- Demo: the "Customize" drawer. Included here (after the head) on purpose:
     the drawer resolves every skin's stylesheet URL, and doing that before the
     head renders would make Basset skip the active skin's <link>. --}}
@include('admin.partials.theme_switcher')

@yield('before_scripts')
@stack('before_scripts')

@include(backpack_view('inc.footer'))

@include(backpack_view('inc.scripts'))
@include(backpack_view('inc.theme_scripts'))

@yield('after_scripts')
@stack('after_scripts')
</body>
</html>
