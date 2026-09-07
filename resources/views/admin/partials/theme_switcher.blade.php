{{--
    The demo "Customize" drawer: skin, layout, text direction and (for maintainers) legacy themes.
    Included on every Tabler page, the login page included, from inc/topbar_right_content.

    - Skins are swapped in the browser without a reload (their stylesheets are toggled) and saved in the background.
    - Layout, direction and theme reload the page; the drawer re-opens afterwards.
    - Add ?open_drawer=true to any URL to open the drawer on page load (used by links from the website).

    Options live in config/demo.php; choices are stored in a cookie by DemoController@switchTheme.
--}}
@php
    $themes = config('demo.themes');
    $layouts = config('demo.layouts');
    $skins = config('demo.skins');

    $currentTheme = demo_theme();
    $currentLayout = demo_layout();
    $currentSkin = demo_skin();
    $currentDirection = demo_direction();
    $isTabler = $currentTheme === 'tabler';
    $loggedIn = backpack_auth()->check();
    $openDrawer = request()->boolean('open_drawer') || session('demo.open_drawer', false);

    // Every skin stylesheet URL, so the browser can toggle them without a reload.
    $skinUrls = collect($skins)->map(fn ($skin) => array_map(fn ($file) => basset($file), $skin['styles']));
@endphp

<button type="button" class="btn btn-primary demo-customize-btn shadow" data-bs-toggle="offcanvas" data-bs-target="#demo-customizer" aria-controls="demo-customizer" title="Change skin, layout, theme">
    <i class="la la-swatchbook fs-2"></i>
    <span class="ms-1">Customize</span>
</button>

<div class="offcanvas offcanvas-end demo-customizer" tabindex="-1" id="demo-customizer" data-bs-backdrop="false" data-bs-scroll="true" aria-labelledby="demo-customizer-title">
    <div class="offcanvas-header">
        <div>
            <h2 class="offcanvas-title" id="demo-customizer-title">Customize</h2>
            <div class="text-secondary small">Keep browsing while you try things out.</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form id="demo-customizer-form" method="POST" action="{{ route('demo.switch-theme') }}" data-skin-urls='@json($skinUrls)' data-skin-modes='@json(collect($skins)->map(fn ($skin) => $skin['color_mode'] ?? null)->filter())' data-skin-accents='@json(collect($skins)->map(fn ($skin) => $skin['accent'] ?? '124, 105, 239'))'>
            @csrf
            <input type="hidden" name="theme" value="{{ $currentTheme }}">

            {{-- SKIN --}}
            <div class="mb-4">
                <div class="d-flex align-items-baseline mb-1">
                    <h3 class="mb-0">Skin</h3>
                    <span class="text-secondary small ms-auto">Tabler theme</span>
                </div>
                <p class="text-secondary small mb-2">Same layout, different look. Changes apply instantly.</p>
                <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column gap-2">
                    @foreach($skins as $key => $skin)
                        <label class="form-selectgroup-item flex-fill">
                            <input type="radio" name="skin" value="{{ $key }}" class="form-selectgroup-input" @checked($key === $currentSkin) @disabled(! $isTabler)>
                            <span class="form-selectgroup-label d-flex align-items-center p-2">
                                <span class="me-3"><span class="form-selectgroup-check"></span></span>
                                <span class="demo-skin-swatch me-3" style="background: {{ $skin['swatch'] }}"></span>
                                <span class="form-selectgroup-label-content">
                                    <span class="form-selectgroup-title strong mb-1">
                                        {{ $skin['name'] }}
                                        @if(! empty($skin['theme_default']))<span class="badge bg-secondary-lt ms-1" title="What a fresh Backpack install looks like">default</span>@endif
                                    </span>
                                    <span class="d-block text-secondary small">{{ $skin['description'] }}</span>
                                </span>
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- LAYOUT --}}
            <div class="mb-4">
                <div class="d-flex align-items-baseline mb-1">
                    <h3 class="mb-0">Layout</h3>
                    <span class="text-secondary small ms-auto">Tabler theme</span>
                </div>
                <p class="text-secondary small mb-2">Where the menu goes. {{ $loggedIn ? 'Reloads the page.' : 'You will see it once you log in.' }}</p>
                <div class="row g-2">
                    @foreach($layouts as $key => $layout)
                        <div class="col-4">
                            <label class="form-imagecheck mb-0" title="{{ $layout['name'] }}">
                                <input name="layout" type="radio" value="{{ $key }}" class="form-imagecheck-input" @checked($key === $currentLayout) @disabled(! $isTabler)>
                                <span class="form-imagecheck-figure">
                                    <img src="{{ asset($layout['screenshot']) }}" alt="{{ $layout['name'] }}" class="form-imagecheck-image">
                                </span>
                                <span class="d-block mt-1 small text-secondary lh-sm">{{ $layout['name'] }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- DIRECTION --}}
            <div class="mb-4">
                <h3 class="mb-1">Text direction</h3>
                <div class="form-selectgroup w-100">
                    <label class="form-selectgroup-item flex-fill">
                        <input type="radio" name="direction" value="ltr" class="form-selectgroup-input" @checked($currentDirection === 'ltr')>
                        <span class="form-selectgroup-label text-center">LTR <span class="d-block small text-secondary">Left to right</span></span>
                    </label>
                    <label class="form-selectgroup-item flex-fill">
                        <input type="radio" name="direction" value="rtl" class="form-selectgroup-input" @checked($currentDirection === 'rtl')>
                        <span class="form-selectgroup-label text-center">RTL <span class="d-block small text-secondary">Right to left</span></span>
                    </label>
                </div>
            </div>

            {{-- LEGACY THEMES (only once logged in) --}}
            @if($loggedIn)
                <div class="pt-3 border-top">
                    <a class="d-flex align-items-center text-secondary small text-decoration-none" data-bs-toggle="collapse" href="#demo-legacy-themes" role="button" aria-expanded="{{ $isTabler ? 'false' : 'true' }}" aria-controls="demo-legacy-themes">
                        <i class="la la-history me-1"></i> Legacy themes, for Backpack maintainers
                        <i class="la la-angle-down ms-auto"></i>
                    </a>
                    <div class="collapse {{ $isTabler ? '' : 'show' }} mt-2" id="demo-legacy-themes">
                        <div class="alert alert-warning small py-2 mb-2">
                            The CoreUI themes are kept so we can check that new features still work in older installs. They have no layouts or skins. New projects should use Tabler.
                        </div>
                        <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column gap-2">
                            @foreach($themes as $key => $theme)
                                <label class="form-selectgroup-item flex-fill">
                                    <input type="radio" name="theme" value="{{ $key }}" class="form-selectgroup-input" @checked($key === $currentTheme)>
                                    <span class="form-selectgroup-label d-flex align-items-center p-2">
                                        <span class="me-3"><span class="form-selectgroup-check"></span></span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">{{ $theme['name'] }} @if($theme['legacy'])<span class="badge bg-secondary-lt ms-1">legacy</span>@endif</span>
                                            <span class="d-block text-secondary small">{{ $theme['description'] }}</span>
                                        </span>
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </form>
    </div>
</div>

<style>
    .demo-customize-btn {
        position: fixed;
        right: 1.25rem;
        bottom: 1.25rem;
        z-index: 1035;
        border-radius: 999px;
        padding: .45rem 1rem .45rem .8rem;
    }
    [dir="rtl"] .demo-customize-btn {
        right: auto;
        left: 1.25rem;
    }
    @media (max-width: 575.98px) {
        .demo-customize-btn span { display: none; }
        .demo-customize-btn { padding: .5rem .7rem; }
    }
    .demo-customizer {
        --tblr-offcanvas-width: 26rem;
        box-shadow: -0.5rem 0 2rem rgba(0, 0, 0, .12);
        backdrop-filter: blur(16px);
    }
    .demo-skin-swatch {
        flex: 0 0 auto;
        width: 2.5rem;
        height: 2.5rem;
        border-radius: .5rem;
        border: 1px solid var(--tblr-border-color);
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .5);
    }
    #demo-customizer-form .form-imagecheck-image {
        aspect-ratio: 16 / 10;
        object-fit: cover;
        width: 100%;
    }
    /* Menu entries for pages the demo does not have yet */
    .demo-todo-item {
        opacity: .5;
        cursor: not-allowed;
    }
    /* The "Demo Inc." wordmark (config/backpack/ui.php): the mark takes the skin's accent */
    .demo-brand {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        font-size: 1.125rem;
        line-height: 1;
        color: var(--tblr-emphasis-color);
        text-decoration: none;
        white-space: nowrap;
    }
    .demo-brand-mark {
        position: relative;
        display: inline-block;
        width: 1.75rem;
        height: 1.75rem;
        border-radius: var(--tblr-border-radius);
        /* A diagonal gradient built from the skin's accent, the way the Backpack logo uses its purple. */
        background: linear-gradient(135deg,
            color-mix(in srgb, var(--tblr-primary) 78%, #fff) 0%,
            var(--tblr-primary) 55%,
            color-mix(in srgb, var(--tblr-primary) 72%, #000) 100%);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25), 0 1px 2px rgba(0, 0, 0, 0.18);
    }
    /* The Backpack "B", as a mask so it can take any colour (white on most tiles, black on Mono's white tile). */
    .demo-brand-mark::before {
        content: "";
        position: absolute;
        inset: 0;
        background: var(--tblr-primary-fg, #fff);
        -webkit-mask: url("{{ asset('assets/img/backpack_b.svg') }}") center / auto 58% no-repeat;
        mask: url("{{ asset('assets/img/backpack_b.svg') }}") center / auto 58% no-repeat;
    }
    .demo-brand-name {
        font-weight: 600;
        letter-spacing: -0.02em;
    }
    .auth-logo-container .demo-brand {
        font-size: 1.5rem;
    }
    .auth-logo-container .demo-brand-mark {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: var(--tblr-border-radius-lg);
    }
    [data-bs-theme=dark] .navbar-dark .demo-brand,
    .navbar-dark .demo-brand {
        color: #fff;
    }
</style>

<script>
    (function () {
        var form = document.getElementById('demo-customizer-form');
        if (! form) return;

        var skinUrls = JSON.parse(form.dataset.skinUrls || '{}');
        var skinModes = JSON.parse(form.dataset.skinModes || '{}');
        var skinAccents = JSON.parse(form.dataset.skinAccents || '{}');
        var token = form.querySelector('input[name="_token"]').value;

        // Charts get their colours from the server when they load. Repaint the ones that
        // follow the skin accent (options.followsSkinAccent) so an instant switch keeps up.
        function recolorCharts(chosen) {
            if (! window.Chart || ! Chart.instances) return;
            var rgb = skinAccents[chosen] || '124, 105, 239';
            Object.keys(Chart.instances).forEach(function (key) {
                var chart = Chart.instances[key];
                var options = chart && chart.config && chart.config.options;
                if (! options || ! options.followsSkinAccent) return;
                chart.data.datasets.forEach(function (dataset) {
                    dataset.borderColor = 'rgba(' + rgb + ', 1)';
                    dataset.backgroundColor = 'rgba(' + rgb + ', 0.35)';
                });
                chart.update();
            });
        }

        // Some skins are dark first: picking one switches to dark mode, and leaving it
        // restores whatever color mode the visitor had before.
        function applyColorMode(chosen) {
            if (! window.colorMode) return;
            var wanted = skinModes[chosen];
            var remembered = localStorage.getItem('demo_color_mode_before_skin');

            if (wanted) {
                if (remembered === null) localStorage.setItem('demo_color_mode_before_skin', colorMode.get() || 'system');
                if (colorMode.result !== wanted) colorMode.set(wanted);
            } else if (remembered !== null) {
                localStorage.removeItem('demo_color_mode_before_skin');
                colorMode.set(remembered);
            }
        }
        applyColorMode('{{ $currentSkin }}');

        // Save the current choices, without leaving the page.
        function persist() {
            return fetch(form.action, {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                body: new FormData(form)
            });
        }

        // Find a stylesheet <link> by URL. Compare resolved URLs: the ones written into the
        // head are relative (/storage/basset/...), the ones in our map are absolute.
        function findLink(url) {
            var absolute = new URL(url, window.location.href).href;
            return Array.prototype.find.call(document.querySelectorAll('link[rel="stylesheet"]'), function (link) {
                return link.href === absolute;
            }) || null;
        }

        // Enable the chosen skin's stylesheets and disable every other skin's.
        function applySkin(chosen) {
            var wanted = (skinUrls[chosen] || []).map(function (url) { return new URL(url, window.location.href).href; });
            Object.keys(skinUrls).forEach(function (key) {
                skinUrls[key].forEach(function (url) {
                    var link = findLink(url);
                    var enabled = wanted.indexOf(new URL(url, window.location.href).href) !== -1;
                    if (! link && enabled) {
                        link = document.createElement('link');
                        link.rel = 'stylesheet';
                        link.href = url;
                        document.head.appendChild(link);
                    }
                    if (link) link.disabled = ! enabled;
                });
            });
        }

        form.querySelectorAll('input[name="skin"]').forEach(function (input) {
            input.addEventListener('change', function () {
                applySkin(input.value);
                applyColorMode(input.value);
                recolorCharts(input.value);
                persist();
            });
        });

        form.querySelectorAll('input[name="layout"], input[name="direction"], input[name="theme"]').forEach(function (input) {
            input.addEventListener('change', function () {
                form.submit();
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Open the drawer on load when asked to (?open_drawer=true, or right after a reload it caused).
            @if($openDrawer)
                var drawer = document.getElementById('demo-customizer');
                if (window.bootstrap && bootstrap.Offcanvas) {
                    bootstrap.Offcanvas.getOrCreateInstance(drawer).show();
                } else {
                    drawer.classList.add('show');
                }
            @endif

            // "Example coming soon" tooltips on the greyed-out menu entries.
            if (window.bootstrap && bootstrap.Tooltip) {
                document.querySelectorAll('.demo-todo-item').forEach(function (el) {
                    bootstrap.Tooltip.getOrCreateInstance(el);
                });
            }
        });
    })();
</script>
