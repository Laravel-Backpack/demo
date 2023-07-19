<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Theme (User Interface)
    |--------------------------------------------------------------------------
    */
    // Change the view namespace in order to load a different theme than the one Backpack provides.
    // You can create child themes yourself, by creating a view folder anywhere in your resources/views
    // and choosing that view_namespace instead of the default one. Backpack will load a file from there
    // if it exists, otherwise it will load it from the fallback namespace.

    'view_namespace'          => 'backpack.theme-tabler::',
    'view_namespace_fallback' => 'backpack.theme-tabler::',

    /*
    |--------------------------------------------------------------------------
    | Look & feel customizations
    |--------------------------------------------------------------------------
    |
    | To make the UI feel yours.
    |
    | Note that values set here might be overriden by theme config files
    | (eg. config/backpack/theme-tabler.php) when that theme is in use.
    |
    */

    // Date & Datetime Format Syntax: https://carbon.nesbot.com/docs/#api-localization
    'default_date_format'     => 'D MMM YYYY',
    'default_datetime_format' => 'D MMM YYYY, HH:mm',

    // Direction, according to language
    // (left-to-right vs right-to-left)
    'html_direction' => 'ltr',

    // ----
    // HEAD
    // ----

    // Project name - shown in the window title
    'project_name' => 'Backpack Admin Panel',

    // Content of the HTML meta robots tag to prevent indexing and link following
    'meta_robots_content' => 'noindex, nofollow',

    // ------
    // HEADER
    // ------

    // When clicking on the admin panel's top-left logo/name,
    // where should the user be redirected?
    // The string below will be passed through the url() helper.
    // - default: '' (project root)
    // - alternative: 'admin' (the admin's dashboard)
    'home_link' => '',

    // Menu logo. You can replace this with an <img> tag if you have a logo.
    'project_logo'   => '<img src="/assets/img/backpack_logo.svg" class="project-logo" style="width: 142px; height: auto;" alt="Backpack for Laravel">',

    // Show / hide breadcrumbs on admin panel pages.
    'breadcrumbs' => true,

    // ------
    // FOOTER
    // ------

    // Developer or company name. Shown in footer.
    'developer_name' => 'Cristian Tabacitu',

    // Developer website. Link in footer. Type false if you want to hide it.
    'developer_link' => 'http://tabacitu.ro',

    // Show powered by Laravel Backpack in the footer? true/false
    'show_powered_by' => true,

    // ---------
    // DASHBOARD
    // ---------

    // Show "Getting Started with Backpack" info block?
    'show_getting_started' => env('APP_ENV') == 'local',

    // -------------
    // GLOBAL STYLES
    // -------------

    // CSS files that are loaded in all pages, using Laravel's asset() helper
    'styles' => [
        // 'styles/example.css',
        // 'https://some-cdn.com/example.css',
    ],

    // CSS files that are loaded in all pages, using Laravel's mix() helper
    'mix_styles' => [ // file_path => manifest_directory_path
        // 'css/app.css' => '',
    ],

    // CSS files that are loaded in all pages, using Laravel's @vite() helper
    // Please note that support for Vite was added in Laravel 9.19. Earlier versions are not able to use this feature.
    'vite_styles' => [ // resource file_path
        // 'resources/css/app.css' => '',
    ],

    // --------------
    // GLOBAL SCRIPTS
    // --------------

    // JS files that are loaded in all pages, using Laravel's asset() helper
    'scripts' => [
        // 'js/example.js',
        // 'https://unpkg.com/vue@2.4.4/dist/vue.min.js',
        // 'https://unpkg.com/react@16/umd/react.production.min.js',
        // 'https://unpkg.com/react-dom@16/umd/react-dom.production.min.js',
    ],

    // JS files that are loaded in all pages, using Laravel's mix() helper
    'mix_scripts' => [ // file_path => manifest_directory_path
        // 'js/app.js' => '',
    ],

    // JS files that are loaded in all pages, using Laravel's @vite() helper
    'vite_scripts' => [ // resource file_path
        // 'resources/js/app.js',
    ],

];
