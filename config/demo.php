<?php

/*
|--------------------------------------------------------------------------
| Demo-only configuration
|--------------------------------------------------------------------------
|
| Everything the "Customize" drawer in the demo can switch between. None of
| this is needed in a real Backpack app: a real app sets its layout and
| styles once in config/backpack/theme-tabler.php and moves on.
|
| The visitor's choices are kept in the "demo" cookie (theme, layout, skin,
| direction) and applied on every request by App\Http\Middleware\Theme.
|
*/

// Every skin ships with the theme (backpack/theme-tabler 2.1+), one CSS file each.
$skins = base_path('vendor/backpack/theme-tabler/resources/assets/css/skins/');

return [

    /*
     * Themes. Only Tabler is actively developed; the CoreUI themes are kept so
     * Backpack maintainers can check that features still work in older installs.
     */
    'themes' => [
        'tabler' => [
            'name'           => 'Tabler',
            'description'    => 'Bootstrap 5. The current theme, and the one we recommend for every new project.',
            'view_namespace' => 'backpack.theme-tabler::',
            'legacy'         => false,
        ],
        'coreuiv4' => [
            'name'           => 'CoreUI v4',
            'description'    => 'Bootstrap 5. Legacy theme, no layouts or skins.',
            'view_namespace' => 'backpack.theme-coreuiv4::',
            'legacy'         => true,
        ],
        'coreuiv2' => [
            'name'           => 'CoreUI v2',
            'description'    => 'Bootstrap 4. Legacy theme, no layouts or skins.',
            'view_namespace' => 'backpack.theme-coreuiv2::',
            'legacy'         => true,
        ],
    ],

    /*
     * Layouts that ship with the Tabler theme.
     */
    'layouts' => [
        'horizontal'                 => ['name' => 'Horizontal', 'screenshot' => 'screenshots/tabler_horizontal_layout.jpg'],
        'horizontal_dark'            => ['name' => 'Horizontal Dark', 'screenshot' => 'screenshots/tabler_horizontal_dark_layout.jpg'],
        'horizontal_overlap'         => ['name' => 'Horizontal Overlap', 'screenshot' => 'screenshots/tabler_horizontal_overlap_layout.jpg'],
        'vertical'                   => ['name' => 'Vertical', 'screenshot' => 'screenshots/tabler_vertical_layout.jpg'],
        'vertical_dark'              => ['name' => 'Vertical Dark', 'screenshot' => 'screenshots/tabler_vertical_dark_layout.jpg'],
        'vertical_transparent'       => ['name' => 'Vertical Transparent', 'screenshot' => 'screenshots/tabler_vertical_transparent_layout.jpg'],
        'right_vertical'             => ['name' => 'Right Vertical', 'screenshot' => 'screenshots/tabler_right_vertical_layout.jpg'],
        'right_vertical_dark'        => ['name' => 'Right Vertical Dark', 'screenshot' => 'screenshots/tabler_right_vertical_dark_layout.jpg'],
        'right_vertical_transparent' => ['name' => 'Right Vertical Transparent', 'screenshot' => 'screenshots/tabler_right_vertical_transparent_layout.jpg'],
    ],

    /*
     * Skins. A skin is a preset: a name, a one-line description, a small CSS
     * swatch shown in the picker, and the CSS files it loads on top of the
     * Tabler theme. Visitors pick exactly one.
     */
    'skins' => [
        'atlas' => [
            'name'        => 'Atlas',
            'description' => 'Cool greys, hairline borders, dense tables, a confident blue. Dependable, like a good fintech dashboard.',
            'accent'      => '37, 99, 235',
            'swatch'      => 'linear-gradient(#fff, #fff) 18% 50% / 64% 46% no-repeat, linear-gradient(#e3e8ee, #e3e8ee) 18% 50% / 64% 48% no-repeat, #f6f8fa',
            'styles'      => [$skins.'atlas.css'],
        ],
        'aurora' => [
            'name'        => 'Aurora',
            'description' => 'What Backpack ships with: frosted-glass cards over a soft mesh gradient, Backpack purple.',
            'theme_default' => true, // gets the "default" badge: this is what a fresh install looks like
            'swatch'      => 'radial-gradient(at 20% 20%, #f9c5ff 0, transparent 55%), radial-gradient(at 85% 25%, #ffe6a7 0, transparent 55%), radial-gradient(at 40% 85%, #a7f0ff 0, transparent 55%), #fff',
            'styles'      => [$skins.'aurora.css'],
        ],
        'manuscript' => [
            'name'        => 'Manuscript',
            'description' => 'Warm cream, serif headings, a terracotta accent and room to breathe.',
            'accent'      => '196, 93, 60',
            'swatch'      => 'radial-gradient(circle at 74% 50%, #c45d3c 0 14%, transparent 15%), linear-gradient(#fdfcf9, #fdfcf9) 16% 50% / 42% 46% no-repeat, #f4f1ea',
            'styles'      => [$skins.'manuscript.css'],
        ],
        'ink' => [
            'name'        => 'Ink',
            'description' => 'Dark first: near-black canvas, electric sky-blue accent, compact rows. Built for long nights in the admin.',
            'accent'      => '56, 189, 248',
            'swatch'      => 'linear-gradient(#16171e, #16171e) 18% 50% / 64% 46% no-repeat, linear-gradient(rgba(56,189,248,.7), rgba(56,189,248,.7)) 18% 50% / 64% 48% no-repeat, #0b0c10',
            'color_mode'  => 'dark',
            'styles'      => [$skins.'ink.css'],
        ],
        'mono' => [
            'name'        => 'Mono',
            'description' => 'Black on white, sharp corners, monospace labels. Nothing but the content.',
            'accent'      => '115, 115, 115',
            'swatch'      => 'linear-gradient(#000, #000) 18% 32% / 64% 18% no-repeat, linear-gradient(#eaeaea, #eaeaea) 18% 62% / 64% 2px no-repeat, linear-gradient(#eaeaea, #eaeaea) 18% 76% / 40% 2px no-repeat, #fff',
            'styles'      => [$skins.'mono.css'],
        ],
        'blueprint' => [
            'name'        => 'Blueprint',
            'description' => 'A graph-paper grid behind everything, with a blueprint blue accent. For people who plan.',
            'swatch'      => 'radial-gradient(circle at 74% 50%, #2b4c7e 0 14%, transparent 15%), linear-gradient(#d9dde6 1px, transparent 1px) 0 0 / 12px 12px, linear-gradient(90deg, #d9dde6 1px, transparent 1px) 0 0 / 12px 12px, #f1f3f7',
            'accent'      => '43, 76, 126',
            'styles'      => [$skins.'blueprint.css'],
        ],
        'honey' => [
            'name'        => 'Honey',
            'description' => 'A warm honey-amber accent over a faint dot grid, like an engineering notebook.',
            'swatch'      => 'radial-gradient(circle at 74% 50%, #d97706 0 14%, transparent 15%), radial-gradient(#b9b9cc 1px, transparent 1px) 0 0/8px 8px, #fafafc',
            'accent'      => '217, 119, 6',
            'styles'      => [$skins.'honey.css'],
        ],
        'pine' => [
            'name'        => 'Pine',
            'description' => 'A deep emerald accent over thin diagonal pinstripes. Quietly expensive.',
            'swatch'      => 'radial-gradient(circle at 74% 50%, #047857 0 14%, transparent 15%), repeating-linear-gradient(135deg, #e9e9f2 0 3px, #fafafc 3px 8px)',
            'accent'      => '4, 120, 87',
            'styles'      => [$skins.'pine.css'],
        ],
        'synth' => [
            'name'        => 'Synth',
            'description' => 'A teal accent over faint vertical lines. A little retro, a little future.',
            'swatch'      => 'radial-gradient(circle at 74% 50%, #0f766e 0 14%, transparent 15%), repeating-linear-gradient(90deg, #e3e3ee 0 1px, #fafafc 1px 10px)',
            'accent'      => '15, 118, 110',
            'styles'      => [$skins.'synth.css'],
        ],
    ],

    'default_skin' => 'atlas',

    /*
     * Explainers. Add ?explainer=<key> to any URL and App\Http\Middleware\DemoExplainer
     * shows the matching card at the top of the page. The "Features" menu links
     * to CRUD pages this way. Inside CRUD views, ":fields" and ":columns" in the
     * text are replaced with the number of fields / columns of that panel.
     */
    'explainers' => [
        'list' => [
            'title' => 'List Operation',
            'badge' => 'FREE',
            'icon'  => 'la la-list',
            'body'  => 'Every CRUD starts here: a table of entries with search, sorting, pagination, filters, bulk actions and export buttons. This table shows :columns columns for Owners, all configured in a few lines inside <code>setupListOperation()</code>. Click a column header to sort, type in the search box, or open the Filters bar.',
            'docs'  => 'https://backpackforlaravel.com/docs/7.x/crud-operation-list-entries',
        ],
        'create' => [
            'title' => 'Create Operation',
            'badge' => 'FREE',
            'icon'  => 'la la-plus',
            'body'  => 'The Create operation builds a form from the fields you declare in <code>setupCreateOperation()</code>. This form has :fields fields, including relationship fields that add related entries without leaving the page. Validation, tabs and "save and continue" actions come out of the box.',
            'docs'  => 'https://backpackforlaravel.com/docs/7.x/crud-operation-create',
        ],
        'update' => [
            'title' => 'Update Operation',
            'badge' => 'FREE',
            'icon'  => 'la la-edit',
            'body'  => 'The Update operation reuses the fields from Create (or its own set), pre-filled with the entry\'s current values. Backpack takes care of relationships, uploads and translatable content. This form edits one pet, with :fields fields.',
            'docs'  => 'https://backpackforlaravel.com/docs/7.x/crud-operation-update',
        ],
        'delete' => [
            'title' => 'Delete Operation',
            'badge' => 'FREE',
            'icon'  => 'la la-trash',
            'body'  => 'The Delete operation adds a Delete button to every row, and a bulk delete for selected rows, both with a confirmation. In this online demo deleting is disabled, for obvious reasons: the buttons are there, the request is politely refused.',
            'docs'  => 'https://backpackforlaravel.com/docs/7.x/crud-operation-delete',
        ],
        'show' => [
            'title' => 'Show Operation',
            'badge' => 'FREE',
            'icon'  => 'la la-eye',
            'body'  => 'The Show operation displays one entry in read-only form, using the same column types as the List operation, so relationships, images and chips render nicely. This page shows one invoice, its owner and its items.',
            'docs'  => 'https://backpackforlaravel.com/docs/7.x/crud-operation-show',
        ],
        'clone' => [
            'title' => 'Clone Operation',
            'badge' => 'FREE',
            'icon'  => 'la la-clone',
            'body'  => 'The Clone operation duplicates an entry with one click, and Bulk Clone does the same for every selected row. Look for the Clone button on each product.',
            'docs'  => 'https://backpackforlaravel.com/docs/7.x/crud-operation-clone',
        ],
        'reorder' => [
            'title' => 'Reorder Operation',
            'badge' => 'FREE',
            'icon'  => 'la la-sort',
            'body'  => 'The Reorder operation gives you a drag-and-drop tree to change the order, and the nesting, of entries. Drag a category somewhere else and hit Save.',
            'docs'  => 'https://backpackforlaravel.com/docs/7.x/crud-operation-reorder',
        ],
        'revise' => [
            'title' => 'Revise Operation',
            'badge' => 'FREE',
            'icon'  => 'la la-history',
            'body'  => 'The Revise operation keeps a history of every change to an entry, who made it and when, and lets you restore any previous version. Edit an icon, then open its Revisions.',
            'docs'  => 'https://backpackforlaravel.com/docs/7.x/crud-operation-revisions',
        ],
        'inline-create' => [
            'title' => 'InlineCreate Operation',
            'badge' => 'PRO',
            'icon'  => 'la la-plus-square',
            'body'  => 'InlineCreate lets users add a related entry from inside a form, in a modal, without losing what they have typed. On the Relationship tab, look for the small "Add" link on the icon and product fields: a form opens in a modal, the entry is created, and it is selected for you when you save.',
            'docs'  => 'https://backpackforlaravel.com/docs/7.x/crud-operation-inline-create',
        ],
        'trash' => [
            'title' => 'Trash Operation',
            'badge' => 'PRO',
            'icon'  => 'la la-trash-restore',
            'body'  => 'The Trash operation soft-deletes entries instead of removing them, adds a Trashed filter to the list, and lets you restore or delete permanently. Toggle the Trashed filter above the table to see it in action. Deleting is disabled in the online demo.',
            'docs'  => 'https://backpackforlaravel.com/docs/7.x/crud-operation-trash',
        ],

        // Paid add-ons that have a live page in this demo. 'product' adds a button to the product page.
        'pro' => [
            'title'   => 'Backpack PRO',
            'badge'   => 'SILVER',
            'icon'    => 'la la-gem',
            'body'    => 'Everything on this page that carries a PRO badge comes from one package: 28 more fields, 6 more columns, 10 more filters, chart widgets and 5 more operations on top of the free core. This Monster CRUD uses most of them. Open the Create form and look for the badges.',
            'docs'    => 'https://backpackforlaravel.com/docs/7.x/introduction#backpack-pro',
            'product' => 'https://backpackforlaravel.com/products/pro-for-unlimited-projects',
        ],
        'devtools' => [
            'title'   => 'DevTools',
            'badge'   => 'GOLD',
            'icon'    => 'la la-toolbox',
            'body'    => 'DevTools is a browser UI that writes code for you: models, migrations, seeders, factories, requests and complete CRUDs, with every field configured from a form. Try it: create a model here and watch the files appear in your project.',
            'docs'    => 'https://backpackforlaravel.com/products/devtools',
            'product' => 'https://backpackforlaravel.com/products/devtools',
        ],
        'editable-columns' => [
            'title'   => 'Editable Columns',
            'badge'   => 'GOLD',
            'icon'    => 'la la-spell-check',
            'body'    => 'Edit entries right inside the table, no form needed: click a cell, change the value, and it is saved over AJAX. Text, numbers, selects, checkboxes, dates. Try it on any cell below.',
            'docs'    => 'https://github.com/Laravel-Backpack/editable-columns',
            'product' => 'https://backpackforlaravel.com/products/editable-columns',
        ],
        'calendar-operation' => [
            'title'   => 'Calendar Operation',
            'badge'   => 'GOLD',
            'icon'    => 'la la-calendar',
            'body'    => 'Show any CRUD with dates as a calendar: month, week or day views, drag an entry to reschedule it, click a slot to create one, click an entry to edit it in a modal. All from the same controller as the table view.',
            'docs'    => 'https://github.com/Laravel-Backpack/calendar-operation',
            'product' => 'https://backpackforlaravel.com/products/calendar-operation',
        ],
        'report-operation' => [
            'title'   => 'Report Operation',
            'badge'   => 'GOLD',
            'icon'    => 'la la-chart-line',
            'body'    => 'Turn any CRUD into a report page: totals, trends and comparisons over a date range, with line, bar and pie charts and tables, defined with a few lines in the controller. Change the period above and watch every metric update.',
            'docs'    => 'https://github.com/Laravel-Backpack/report-operation',
            'product' => 'https://backpackforlaravel.com/products/report-operation',
        ],
    ],

    /*
     * Paid add-ons. Each gets a page at /admin/paid/<key> (App\Http\Controllers\Admin\PaidAddonsController).
     * Add-ons that also have a live example in the demo link to it from the page.
     *
     * 'bundle' is the cheapest bundle on backpackforlaravel.com/pricing that includes the add-on:
     * SILVER = PRO + Dataform Modal; GOLD = every paid add-on.
     */
    'paid_addons' => [
        'pro' => [
            'name'        => 'Backpack PRO',
            'tagline'     => '28 more fields, 6 more columns, 10 more filters, chart widgets and 5 more operations.',
            'bundle'      => 'SILVER',
            'icon'        => 'la la-gem',
            'product'     => 'https://backpackforlaravel.com/products/pro-for-unlimited-projects',
            'docs'        => 'https://backpackforlaravel.com/docs/7.x/introduction#backpack-pro',
            'example'     => ['url' => 'monster?explainer=pro', 'label' => 'See it live on the Monster CRUD'],
            'description' => [
                'The free core gives you a complete admin panel. PRO is what you reach for when the requirements get specific: relationship fields with inline create, repeatable groups, address and map fields, date range and select filters, chart widgets, custom views, trash and bulk operations.',
                'It is one package, one install command, and it works with every CRUD you already have.',
            ],
            'highlights'  => ['28 more fields: relationship, repeatable, address, map and more', '10 more filters, for every list', 'Clone, BulkClone, BulkDelete, InlineCreate and Fetch operations', 'Chart widgets with several chart libraries'],
        ],
        'devtools' => [
            'name'        => 'DevTools',
            'tagline'     => 'Generate models, migrations and CRUDs, from a familiar web interface.',
            'bundle'      => 'GOLD',
            'icon'        => 'la la-toolbox',
            'product'     => 'https://backpackforlaravel.com/products/devtools',
            'docs'        => 'https://backpackforlaravel.com/products/devtools',
            'example'     => null,
            'description' => [
                'DevTools adds a page to your local admin panel where you describe a model, its columns and its relationships in a form, and it writes the migration, the model, the seeder, the factory, the request and the CRUD controller for you.',
                'It is a development dependency, so it never ships to production. That is also why it is not installed in this online demo.',
            ],
            'highlights'  => ['Models, migrations, seeders, factories, requests and CRUDs', 'Every field type configured visually', 'Edits existing models too', 'Local only, never in production'],
        ],
        'test-generators' => [
            'name'        => 'Test Generators',
            'tagline'     => 'Starter tests for your Backpack CRUDs, generated in seconds.',
            'bundle'      => 'GOLD',
            'icon'        => 'la la-vial',
            'product'     => 'https://backpackforlaravel.com/products/test-generators',
            'docs'        => 'https://backpackforlaravel.com/products/test-generators',
            'example'     => null,
            'description' => [
                'One artisan command per CRUD, and you get a starter test class for its operations: listing, creating, updating, deleting, validation. Adjust it to your rules, and you have coverage you would otherwise never find the time to write.',
                'Run them in CI and find out about a broken field or a missing validation rule before your users do.',
            ],
            'highlights'  => ['One command per CRUD', 'Covers the operations the CRUD uses', 'Readable tests you can extend', 'Works with the CRUDs you already have'],
        ],
        'multi-auth' => [
            'name'        => 'Multi Auth',
            'tagline'     => 'More ways for your admins to log in: 2FA, magic links, passkeys and social login.',
            'bundle'      => 'GOLD',
            'icon'        => 'la la-user-shield',
            'product'     => 'https://backpackforlaravel.com/products/multi-auth',
            'docs'        => 'https://backpackforlaravel.com/products/multi-auth',
            'example'     => null,
            'description' => [
                'A password is the bare minimum. Multi Auth adds the login methods your admins expect today: two-factor authentication, magic links sent by email, passkeys, and social login, with the pages and flows that go with them.',
                'Enable the methods you want, keep the ones you do not off, and your existing users keep logging in the way they always have.',
            ],
            'highlights'  => ['Two-factor authentication', 'Magic links by email', 'Passkeys', 'Social login'],
        ],
        'editable-columns' => [
            'name'        => 'Editable Columns',
            'tagline'     => 'Make quick edits to database entries, right in the table view.',
            'bundle'      => 'GOLD',
            'icon'        => 'la la-spell-check',
            'product'     => 'https://backpackforlaravel.com/products/editable-columns',
            'docs'        => 'https://github.com/Laravel-Backpack/editable-columns',
            'example'     => ['url' => 'editable-monster?explainer=editable-columns', 'label' => 'See it live'],
            'description' => [
                'For the small changes that do not deserve a whole form: click a cell in the list, change the value, and it is saved over AJAX. Text, numbers, selects, checkboxes, dates and more.',
                'Turn any column into an editable one with one option in the controller.',
            ],
            'highlights'  => ['Edit in place, no form', 'Saved instantly over AJAX', 'Text, select, checkbox, date, number and more', 'Validation still applies'],
        ],
        'calendar-operation' => [
            'name'        => 'Calendar Operation',
            'tagline'     => 'List, search and interact with your entries, on a calendar.',
            'bundle'      => 'GOLD',
            'icon'        => 'la la-calendar',
            'product'     => 'https://backpackforlaravel.com/products/calendar-operation',
            'docs'        => 'https://github.com/Laravel-Backpack/calendar-operation',
            'example'     => ['url' => 'meeting/calendar?explainer=calendar-operation', 'label' => 'See it live'],
            'description' => [
                'Meetings, bookings, shifts, deadlines: show them in month, week or day views. Drag an entry to reschedule it, click a slot to create one, click an entry to edit it in a modal.',
                'It is an operation, so it lives next to the table view of the same CRUD and uses the same fields and validation.',
            ],
            'highlights'  => ['Month, week and day views', 'Drag and drop to reschedule', 'Create and edit in a modal', 'Same controller as the table'],
        ],
        'figma-template' => [
            'name'        => 'Figma Template',
            'tagline'     => 'Create designs and mockups using Backpack\'s UI components.',
            'bundle'      => 'GOLD',
            'icon'        => 'lab la-figma',
            'product'     => 'https://backpackforlaravel.com/products/figma-template',
            'docs'        => 'https://backpackforlaravel.com/products/figma-template',
            'example'     => null,
            'description' => [
                'A Figma file with every Backpack building block: layouts, menus, fields, columns, buttons, filters, widgets and the login pages, in the Tabler theme. Drag them together and you have a mockup a client can approve, that a developer can then build one to one.',
                'No more mockups that look nothing like the finished admin panel.',
            ],
            'highlights'  => ['Every field, column and button', 'All layouts of the Tabler theme', 'Light and dark mode', 'Matches what Backpack renders'],
        ],
        'report-operation' => [
            'name'        => 'Report Operation',
            'tagline'     => 'A report page for any CRUD, with filterable metrics.',
            'bundle'      => 'GOLD',
            'icon'        => 'la la-chart-line',
            'product'     => 'https://backpackforlaravel.com/products/report-operation',
            'docs'        => 'https://github.com/Laravel-Backpack/report-operation',
            'example'     => ['url' => 'pet-shop/invoice/report?explainer=report-operation', 'label' => 'See it live'],
            'description' => [
                'Totals, trends and comparisons over a date range, with line, bar and pie charts and tables. Each metric is a few lines in the controller; the page, the period picker and the charts are taken care of.',
                'The invoice report in this demo is the real thing: change the period and every metric updates.',
            ],
            'highlights'  => ['Date range and interval picker', 'Line, bar, pie and table metrics', 'Compare with the previous period', 'Defined in the controller, like everything else'],
        ],
        'dataform-modal' => [
            'name'         => 'Dataform Modal',
            'tagline'      => 'Create and update forms in modals, across your admin panel.',
            'bundle'       => 'SILVER',
            'icon'         => 'la la-window-restore',
            'product'      => 'https://backpackforlaravel.com/products/dataform-modal',
            'docs'         => 'https://backpackforlaravel.com/products/dataform-modal',
            'example'      => null,
            'example_view' => 'admin.partials.dataform-modal-examples',
            'description'  => [
                'Open a full Backpack form in a modal, from any page: a dashboard, a custom table, a show page. Same fields, same validation, same controller. It adds two operations, CreateInModal and UpdateInModal, and one Blade component.',
                'Try it right here: the table below is a custom one, and every Edit link opens the real invoice form.',
            ],
            'highlights'  => ['Any form, in a modal', 'One Blade component', 'CreateInModal and UpdateInModal operations', 'Validation and saving handled for you'],
        ],
        'auto-translate' => [
            'name'        => 'Auto Translate',
            'tagline'     => 'Translate your Eloquent models automatically, using AI or translation services.',
            'bundle'      => 'GOLD',
            'icon'        => 'la la-globe',
            'product'     => 'https://backpackforlaravel.com/products/auto-translate',
            'docs'        => 'https://backpackforlaravel.com/products/auto-translate',
            'example'     => null,
            'description' => [
                'For apps with translatable content: write in one language, and let AI or a translation service fill in the others for you, instead of pasting every field into a translator by hand.',
                'It plugs into the translatable models you already have, so nothing about your data changes.',
            ],
            'highlights'  => ['AI or translation services, your choice', 'Works with your translatable models', 'Fills every language from one', 'Pick the languages you need'],
        ],
    ],

    /*
     * Always loaded with the Tabler theme, whatever the skin. The Backpack color
     * palette is not a skin: color-adjustments.css depends on it.
     */
    'base_styles' => [
        $skins.'backpack-color-palette.css',
    ],
];
