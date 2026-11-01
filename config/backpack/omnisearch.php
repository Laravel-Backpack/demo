<?php

/*
|--------------------------------------------------------------------------
| Omnisearch
|--------------------------------------------------------------------------
|
| The admin-wide search palette (Cmd/Ctrl+K). Each entry under `entities` is
| one searchable Eloquent model. Everything in this file must stay cacheable
| (no closures), so URLs, titles and details are patterns where {attribute}
| is replaced with the entry's attribute (accessors and dotted relations like
| {author.name} work too), and dynamic bits name a class and method of yours
| ([SomeClass::class, 'method'], 'SomeClass@method' or an invokable class),
| which the container builds and calls.
|
| Labels and other copy in this file may be translation keys ('admin.events')
| or plain text ('Events'). They are resolved per request, in the admin's
| locale, so the config stays cacheable; a key the translator does not know
| is shown as written.
|
| Per entity:
|   label    Group heading in the palette. Default: the model's plural name.
|   search   Columns matched with a case-insensitive "contains". Multi-word
|            terms must match every word, in any column.
|   exact    Columns that must match the whole term exactly (ids, numbers).
|            Exact matches rank first, then prefix matches, then the rest.
|   url      Where a hit links to, relative to the admin prefix. Default:
|            "<kebab-case model name>/{id}/show", so App\Models\BlogPost
|            becomes "blog-post/{id}/show". Set it when your CRUD route
|            segment differs, or to open the edit form instead.
|   can      Permission (Gate ability) the user needs to search this entity.
|            Without it, everyone who can open the admin panel sees it. The
|            JSON endpoint applies the same check, so hiding is not cosmetic.
|   chip     A Blade view that renders the hit, receiving $entry. Optional;
|            without it the hit renders as a plain chip from title/details.
|   title    Heading pattern for the plain chip. Default: first search column.
|   details  Detail patterns for the plain chip. Default: the other search
|            columns. Use ['la la-icon' => '{pattern}'] to add an icon.
|   with     Relations to eager-load before rendering (keeps chips N+1 free).
|   scopes   Model scopes to apply to the search query.
|   query    A handler ([SomeClass::class, 'method'], 'SomeClass@method' or an
|            invokable class) called with the query Builder, to narrow it the
|            way your CRUD narrows its list: owner-only, tenant-only, published
|            only. The search does not know what the CRUD's addClause() does,
|            so say it here (or in a scope) or the palette shows every row.
|   limit    Per-entity cap, overrides the global one.
|
*/

return [

    // Extra middleware for the JSON endpoints, on top of Backpack's admin
    // middleware. Access to each entity is decided by its own 'can' below.
    // The default rate limit (per admin, else per IP) is far above what
    // typing produces and keeps a script from hammering the search.
    // The demo uses its own `omnisearch` limiter (AppServiceProvider), 120 a
    // minute per session, since every visitor shares the demo admin account.
    'middleware' => ['throttle:omnisearch'],

    // Admin-relative path of the JSON endpoints: GET {route}?q= searches,
    // GET {route}?q=&type=&offset= loads one page of one group,
    // POST {route}/run/{shortcut} runs an action.
    'route' => 'omnisearch',

    // Ignore terms shorter than this.
    'min_length' => 2,

    // Cut terms to this many characters and this many words. Every word adds
    // one LIKE per search column to each query, so these keep a pasted
    // paragraph from building a monster query.
    'max_length' => 100,
    'max_words'  => 8,

    // Milliseconds the admin has to pause typing before the palette asks the
    // server. Each request runs to completion on the server even when the
    // palette has already moved on to the next keystroke, so on a large
    // database raise this (300-400) together with min_length (3).
    'debounce' => 150,

    // Hits per group per page. While more remain, the group ends with a
    // "Show more" row that loads the next page in place.
    'limit' => 5,

    // "Show more" stops once a group has shown this many hits: past that the
    // admin should narrow the term. Deep pages are also the expensive ones.
    'max_offset' => 200,

    /*
    | Shortcuts
    |
    | Things the admin can do from the palette, shown as the first group.
    | Two kinds:
    |
    | - go to a page: fed by the sidebar menu, rendered for the current admin
    |   (so its own @can checks decide who sees what), and by the `shortcuts`
    |   entries below that have a `url`, for pages the menu does not link to.
    | - run an action: `shortcuts` entries with a `run` handler. The palette
    |   POSTs to the run endpoint, which calls the handler and shows its
    |   message as a toast.
    |
    | Matching is by word prefix on label, description and keywords, so
    | "reord cat" finds "Reorder categories".
    |
    | Per shortcut: label, then either url (go to a page) or run (an action),
    | and optionally description (shown and searched), keywords (searched
    | only), icon (Line Awesome class), can (permission needed to see and run
    | it), key (stable id for actions; defaults to a slug of the label as
    | written here, so set it when the label is a translation key) and
    | confirm (a question the palette asks before running an action).
    | label, description, keywords and confirm may be translation keys;
    | matching runs on the translated words, so put the other language's
    | words in keywords when admins search in both.
    |
    | url is an admin-relative path, an absolute URL, or a handler when it has
    | to be built at search time, like a list filtered to last month. run is a
    | handler the run endpoint calls; it returns a message string, or an array
    | with message, type (success|info|warning|error) and an optional redirect.
    |
    | A handler is an ordinary class of yours, built by the container (so its
    | constructor dependencies are injected), in any of these forms:
    |   [\App\Services\InvoiceReports::class, 'lastMonthUrl']   an instance (or static) method
    |   'App\Services\InvoiceReports@lastMonthUrl'               the same, as a string
    |   'App\Services\InvoiceReports::lastMonthUrl'              the same
    |   \App\Actions\RebuildSearchIndex::class                 an invokable class
    | A url string counts as a handler only when it names a class that exists;
    | anything else stays a URL and is never called ('mailto:x@y' is safe).
    */

    // Turn every link in the sidebar menu into a "go to page" shortcut.
    'menu_shortcuts' => true,

    // Heading of the shortcuts group: a translation key or plain text. Null
    // for the package's own ("Shortcuts", translated into the admin's locale).
    'shortcuts_label' => null,

    'shortcuts' => [
        // [
        //     'label' => 'Reorder categories',
        //     'url' => 'category/reorder',
        //     'description' => 'Drag categories into a new order',
        //     'keywords' => 'sort',
        //     'icon' => 'la la-sort',
        //     'can' => 'manage categories',
        // ],
        // [
        //     'label' => "Last month's invoices",
        //     'url' => [\App\Services\InvoiceReports::class, 'lastMonthUrl'],
        //     'description' => 'The invoice list filtered to the previous month',
        //     'icon' => 'la la-calendar',
        //     'can' => 'manage invoices',
        // ],
        // [
        //     'label' => 'Clear the cache',
        //     'key' => 'cache-clear',
        //     'run' => \App\Actions\ClearCache::class,
        //     'description' => 'Same as php artisan cache:clear',
        //     'icon' => 'la la-broom',
        //     'confirm' => 'Clear the application cache now?',
        //     'can' => 'manage settings',
        // ],
        [
            'label'       => 'Reorder categories',
            'url'         => 'category/reorder',
            'description' => 'Drag blog categories into a new order',
            'keywords'    => 'sort',
            'icon'        => 'la la-sort',
        ],
        [
            'label'       => 'New article',
            'url'         => 'article/create',
            'description' => 'Write a new blog article',
            'keywords'    => 'add create post',
            'icon'        => 'la la-plus',
        ],
        [
            'label'       => 'New invoice',
            'url'         => 'pet-shop/invoice/create',
            'description' => 'Bill a pet shop owner',
            'keywords'    => 'add create bill',
            'icon'        => 'la la-plus',
        ],
    ],

    // The demo grants every admin access to every CRUD, so no entity has a `can`.
    'entities' => [
        \App\User::class => [
            'label'   => 'Users',
            'search'  => ['name', 'email'],
            'exact'   => ['id'],
            'url'     => 'user/{id}/show',
            'details' => [
                'la la-envelope' => '{email}',
                'la la-hashtag'  => '{id}',
            ],
        ],
        \App\Models\Article::class => [
            'search'  => ['title', 'slug'],
            'exact'   => ['id'],
            'details' => [
                'la la-folder' => '{category.name}',
            ],
            'with' => ['category'],
        ],
        \App\Models\Product::class => [
            'search'  => ['name'],
            'exact'   => ['id'],
            'details' => [
                'la la-tag'         => '{category.name}',
                'la la-dollar-sign' => '{price}',
            ],
            'with' => ['category'],
        ],
        \App\Models\PetShop\Owner::class => [
            'label'  => 'Pet owners',
            'search' => ['name'],
            'exact'  => ['id'],
            'url'    => 'pet-shop/owner/{id}/show',
        ],
        \App\Models\PetShop\Pet::class => [
            'search' => ['nickname'],
            'exact'  => ['id'],
            'url'    => 'pet-shop/pet/{id}/show',
        ],
        \App\Models\PetShop\Invoice::class => [
            'search'  => ['series'],
            'exact'   => ['id', 'number'],
            'url'     => 'pet-shop/invoice/{id}/show',
            'title'   => '{series} {number}',
            'details' => [
                'la la-user' => '{owner.name}',
            ],
            'with' => ['owner'],
        ],
        \App\Models\Monster::class => [
            'search' => ['text', 'email'],
            'exact'  => ['id'],
        ],
    ],
];
