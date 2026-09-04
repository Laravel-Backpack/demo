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
        'clean' => [
            'name'        => 'Clean',
            'description' => 'Plain Tabler on a light grey canvas. Purple accent, no effects.',
            'swatch'      => '#f6f7fb',
            'styles'      => [],
        ],
        'aurora' => [
            'name'        => 'Aurora',
            'description' => 'Frosted-glass cards floating over a pink, yellow and blue mesh gradient.',
            'swatch'      => 'radial-gradient(at 20% 20%, #f9c5ff 0, transparent 55%), radial-gradient(at 85% 25%, #ffe6a7 0, transparent 55%), radial-gradient(at 40% 85%, #a7f0ff 0, transparent 55%), #fff',
            'styles'      => [
                $skins.'glass.css',
                $skins.'fuzzy-background.css',
            ],
        ],
        'paper' => [
            'name'        => 'Paper',
            'description' => 'Warm, off-white paper texture. Calm and easy on the eyes.',
            'swatch'      => '#f3efe6',
            'styles'      => [$skins.'paper-background.css'],
        ],
        'dotted' => [
            'name'        => 'Dotted',
            'description' => 'A faint dot grid behind everything, like an engineering notebook.',
            'swatch'      => 'radial-gradient(#b9b9cc 1px, transparent 1px) 0 0/8px 8px, #fafafc',
            'styles'      => [$skins.'dotted-background.css'],
        ],
        'pinstripe' => [
            'name'        => 'Pinstripe',
            'description' => 'Thin diagonal pinstripes, banker style.',
            'swatch'      => 'repeating-linear-gradient(135deg, #e9e9f2 0 3px, #fafafc 3px 8px)',
            'styles'      => [$skins.'pinstripe-background.css'],
        ],
        'lines' => [
            'name'        => 'Lines',
            'description' => 'Faint vertical ruling, like a ledger page.',
            'swatch'      => 'repeating-linear-gradient(90deg, #e3e3ee 0 1px, #fafafc 1px 10px)',
            'styles'      => [$skins.'vertical-lines-background.css'],
        ],
    ],

    'default_skin' => 'clean',

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
    ],

    /*
     * Always loaded with the Tabler theme, whatever the skin. The Backpack color
     * palette is not a skin: color-adjustments.css depends on it.
     */
    'base_styles' => [
        $skins.'backpack-color-palette.css',
    ],
];
