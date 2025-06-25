<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Backpack for Laravel</title>

    <!-- CSS files -->
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons@2.44.0/icons-sprite.svg" rel="stylesheet"/>

    <style>
        :root {
            --tblr-primary: #7c69ef;
        }

        .theme-selection-section {
            padding: 4rem 0;
            /* background: #f8fafc; */
        }

        .theme-card {
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: 12px;
            overflow: hidden;
        }

        .theme-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.15);
        }

        .theme-card.selected {
            border-color: var(--tblr-primary);
            box-shadow: 0 0 0 4px rgba(70, 127, 208, 0.1);
        }

        .theme-preview {
            height: 235px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .theme-check {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 32px;
            height: 32px;
            background: var(--tblr-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .theme-card.selected .theme-check {
            opacity: 1;
        }

        .layout-card {
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }

        .layout-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }

        .layout-card.selected {
            border-color: var(--tblr-primary);
            box-shadow: 0 0 0 3px rgba(70, 127, 208, 0.1);
        }

        .layout-preview {
            height: 120px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .layout-check {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 24px;
            height: 24px;
            background: var(--tblr-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .layout-card.selected .layout-check {
            opacity: 1;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #1e293b;
        }

        .section-subtitle {
            font-size: 1.125rem;
            color: #64748b;
            margin-bottom: 3rem;
            line-height: 1.6;
        }

        .btn-apply {
            border: none;
            padding: 12px 32px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-apply:hover {
            background: var(--tblr-primary);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.4);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: white !important;
        }

        .navbar-nav .nav-link {
            color: rgba(255,255,255,0.8) !important;
            font-weight: 500;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .theme-preview {
                height: 150px;
            }

            .layout-preview {
                height: 100px;
            }
        }
    </style>

    {{-- Plausible.io analytics, proxied through a CloudFlare Worker --}}
    <script defer data-domain="demo.backpackforlaravel.com" src="https://sweet-surf-fd04.dhcfw.workers.dev/js/script.js"></script>
</head>
<body>

    <!-- Theme Selection Section -->
    <section class="theme-selection-section">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h4 class="section-title">Choose Theme</h4>
                    <p class="section-subtitle">
                        Select from our 3 official themes, each based on a different popular HTML template.
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('tabler.switch.layout') }}" id="themeForm">
                @csrf

                <!-- Theme Selection -->
                <div class="row g-4 mb-5">

                    <div class="col-lg-4">
                        <div class="theme-card @if(config('backpack.ui.view_namespace') === 'backpack.theme-tabler::') selected @endif" data-theme="tabler">
                            <input type="radio" name="theme" value="tabler" class="d-none theme-input" @if(config('backpack.ui.view_namespace') === 'backpack.theme-tabler::') checked @endif>
                            <div class="theme-preview" style="background-image: url('{{ asset('screenshots/theme-tabler.jpg') }}');">
                                <div class="theme-check">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20,6 9,17 4,12"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <h3 class="card-title mb-1">Tabler</h3>
                                <p class="text-muted mb-0">Bootstrap 5 • Default Theme</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="theme-card @if(config('backpack.ui.view_namespace') === 'backpack.theme-coreuiv4::') selected @endif"
                            data-theme="coreuiv4">
                            <input type="radio" name="theme" value="coreuiv4" class="d-none theme-input"
                                @if(config('backpack.ui.view_namespace')==='backpack.theme-coreuiv4::' ) checked @endif>
                            <div class="theme-preview" style="background-image: url('{{ asset('screenshots/theme-coreuiv4.jpg') }}');">
                                <div class="theme-check">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20,6 9,17 4,12" />
                                    </svg>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <h3 class="card-title mb-1">Core UI v4</h3>
                                <p class="text-muted mb-0">Bootstrap 5 • Easy upgrade from CoreUIv4</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="theme-card @if(config('backpack.ui.view_namespace') === 'backpack.theme-coreuiv2::') selected @endif" data-theme="coreuiv2">
                            <input type="radio" name="theme" value="coreuiv2" class="d-none theme-input" @if(config('backpack.ui.view_namespace') === 'backpack.theme-coreuiv2::') checked @endif>
                            <div class="theme-preview" style="background-image: url('{{ asset('screenshots/theme-coreuiv2.jpg') }}');">
                                <div class="theme-check">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20,6 9,17 4,12"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <h3 class="card-title mb-1">Core UI v2</h3>
                                <p class="text-muted mb-0">Bootstrap 4 • Legacy Support</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Layout Selection (for Tabler theme) -->
                <div id="layout-selection" class="@if(config('backpack.ui.view_namespace') !== 'backpack.theme-tabler::') d-none @endif">
                    <div class="row justify-content-center text-center mb-4">
                        <div class="col-lg-8">
                            <h3 class="h2 mb-3">Choose Your Preferred Layout</h3>
                            <p class="text-muted">Take it even further with the layouts Backpack Tabler Theme offers:</p>
                        </div>
                    </div>

                    <div class="row g-3 mb-5">
                        <div class="col-lg-2 col-md-3">
                            <div class="layout-card @if(backpack_theme_config('layout') === 'horizontal') selected @endif" data-layout="horizontal">
                                <input type="radio" name="layout" value="horizontal" class="d-none layout-input" @if(backpack_theme_config('layout') === 'horizontal') checked @endif>
                                <div class="layout-preview" style="background-image: url('{{ asset('screenshots/tabler_horizontal_layout.jpg') }}');">
                                    <div class="layout-check">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20,6 9,17 4,12"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h4 class="card-title h5 fw-bold mb-0">Horizontal</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-3">
                            <div class="layout-card @if(backpack_theme_config('layout') === 'horizontal_dark') selected @endif" data-layout="horizontal_dark">
                                <input type="radio" name="layout" value="horizontal_dark" class="d-none layout-input" @if(backpack_theme_config('layout') === 'horizontal_dark') checked @endif>
                                <div class="layout-preview" style="background-image: url('{{ asset('screenshots/tabler_horizontal_dark_layout.jpg') }}');">
                                    <div class="layout-check">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20,6 9,17 4,12"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h4 class="card-title h5 fw-bold mb-0">Horizontal Dark</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-3">
                            <div class="layout-card @if(backpack_theme_config('layout') === 'horizontal_overlap') selected @endif" data-layout="horizontal_overlap">
                                <input type="radio" name="layout" value="horizontal_overlap" class="d-none layout-input" @if(backpack_theme_config('layout') === 'horizontal_overlap') checked @endif>
                                <div class="layout-preview" style="background-image: url('{{ asset('screenshots/tabler_horizontal_overlap_layout.jpg') }}');">
                                    <div class="layout-check">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20,6 9,17 4,12"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h4 class="card-title h5 fw-bold mb-0">Horizontal Overlap</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-3">
                            <div class="layout-card @if(backpack_theme_config('layout') === 'vertical') selected @endif" data-layout="vertical">
                                <input type="radio" name="layout" value="vertical" class="d-none layout-input" @if(backpack_theme_config('layout') === 'vertical') checked @endif>
                                <div class="layout-preview" style="background-image: url('{{ asset('screenshots/tabler_vertical_layout.jpg') }}');">
                                    <div class="layout-check">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20,6 9,17 4,12"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h4 class="card-title h5 fw-bold mb-0">Vertical</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-3">
                            <div class="layout-card @if(backpack_theme_config('layout') === 'vertical_dark') selected @endif" data-layout="vertical_dark">
                                <input type="radio" name="layout" value="vertical_dark" class="d-none layout-input" @if(backpack_theme_config('layout') === 'vertical_dark') checked @endif>
                                <div class="layout-preview" style="background-image: url('{{ asset('screenshots/tabler_vertical_dark_layout.jpg') }}');">
                                    <div class="layout-check">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20,6 9,17 4,12"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h4 class="card-title h5 fw-bold mb-0">Vertical Dark</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-3">
                            <div class="layout-card @if(backpack_theme_config('layout') === 'vertical_transparent') selected @endif" data-layout="vertical_transparent">
                                <input type="radio" name="layout" value="vertical_transparent" class="d-none layout-input" @if(backpack_theme_config('layout') === 'vertical_transparent') checked @endif>
                                <div class="layout-preview" style="background-image: url('{{ asset('screenshots/tabler_vertical_transparent_layout.jpg') }}');">
                                    <div class="layout-check">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20,6 9,17 4,12"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h4 class="card-title h5 fw-bold mb-0">Vertical Transparent</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-3">
                            <div class="layout-card @if(backpack_theme_config('layout') === 'right_vertical') selected @endif" data-layout="right_vertical">
                                <input type="radio" name="layout" value="right_vertical" class="d-none layout-input" @if(backpack_theme_config('layout') === 'right_vertical') checked @endif>
                                <div class="layout-preview" style="background-image: url('{{ asset('screenshots/tabler_right_vertical_layout.jpg') }}');">
                                    <div class="layout-check">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20,6 9,17 4,12"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h4 class="card-title h5 fw-bold mb-0">Right Vertical</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-3">
                            <div class="layout-card @if(backpack_theme_config('layout') === 'right_vertical_dark') selected @endif" data-layout="right_vertical_dark">
                                <input type="radio" name="layout" value="right_vertical_dark" class="d-none layout-input" @if(backpack_theme_config('layout') === 'right_vertical_dark') checked @endif>
                                <div class="layout-preview" style="background-image: url('{{ asset('screenshots/tabler_right_vertical_dark_layout.jpg') }}');">
                                    <div class="layout-check">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20,6 9,17 4,12"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h4 class="card-title h5 fw-bold mb-0">Right Vertical Dark</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-3">
                            <div class="layout-card @if(backpack_theme_config('layout') === 'right_vertical_transparent') selected @endif" data-layout="right_vertical_transparent">
                                <input type="radio" name="layout" value="right_vertical_transparent" class="d-none layout-input" @if(backpack_theme_config('layout') === 'right_vertical_transparent') checked @endif>
                                <div class="layout-preview" style="background-image: url('{{ asset('screenshots/tabler_right_vertical_transparent_layout.jpg') }}');">
                                    <div class="layout-check">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20,6 9,17 4,12"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h4 class="card-title h5 fw-bold mb-0">Right Vertical Transparent</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Apply Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-apply btn-lg px-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                            <polyline points="20,6 9,17 4,12"/>
                        </svg>
                        Apply Theme & Layout
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Tabler Core -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const layoutSelection = document.getElementById('layout-selection');
            const themeCards = document.querySelectorAll('.theme-card');
            const layoutCards = document.querySelectorAll('.layout-card');

            // Theme card click handlers
            themeCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Remove selected class from all theme cards
                    themeCards.forEach(c => c.classList.remove('selected'));

                    // Add selected class to clicked card
                    this.classList.add('selected');

                    // Update radio button
                    const input = this.querySelector('.theme-input');
                    input.checked = true;

                    // Show/hide layout selection
                    const theme = this.dataset.theme;
                    if (theme === 'tabler') {
                        layoutSelection.classList.remove('d-none');
                    } else {
                        layoutSelection.classList.add('d-none');
                    }
                });
            });

            // Layout card click handlers
            layoutCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Remove selected class from all layout cards
                    layoutCards.forEach(c => c.classList.remove('selected'));

                    // Add selected class to clicked card
                    this.classList.add('selected');

                    // Update radio button
                    const input = this.querySelector('.layout-input');
                    input.checked = true;
                });
            });
        });
    </script>
</body>
</html>
