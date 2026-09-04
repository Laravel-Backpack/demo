{{-- Features > Themes: what a theme is, which ones exist, and a CTA to try them in the Customize drawer. --}}
@extends(backpack_view('blank'))

@php
    $themes = config('demo.themes');
    $screenshots = [
        'tabler'   => 'screenshots/theme-tabler.jpg',
        'coreuiv4' => 'screenshots/theme-coreuiv4.jpg',
        'coreuiv2' => 'screenshots/theme-coreuiv2.jpg',
    ];
    $highlights = [
        'tabler'   => ['Bootstrap 5', '9 layouts', 'Skins', 'Light & dark mode', 'RTL'],
        'coreuiv4' => ['Bootstrap 5', 'Light & dark mode'],
        'coreuiv2' => ['Bootstrap 4'],
    ];
@endphp

@section('header')
    @include('admin.partials.feature_header', ['title' => $title, 'description' => $description, 'docs' => 'https://backpackforlaravel.com/docs/7.x/base-themes'])
@endsection

@section('content')
    <div class="row g-3 mt-1">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">What a theme is</h3>
                    <p>A Backpack theme is a complete admin design, adapted to Backpack: the layout, the menu, the login pages, the look of every field, column, button and widget. It takes an existing Bootstrap HTML template and makes it work with everything Backpack renders.</p>
                    <p>Themes are Composer packages. Install one, point <code>config/backpack/ui.php</code> to it, and every page of your admin panel changes. Because all CRUD views share the same Bootstrap markup, you can switch themes without touching your controllers.</p>
                    <p class="mb-0">Want a design nobody else has? Take any Bootstrap template you like and adapt it, the same way we did with Tabler. The docs walk you through it.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <x-demo-callout title="Try them live" icon="la la-swatchbook" class="h-100">
                Switch themes, layouts and skins from the Customize drawer. It stays open while you browse.
                <x-slot:actions>
                    <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#demo-customizer">Open Customize</button>
                </x-slot:actions>
            </x-demo-callout>
        </div>
    </div>

    <div class="row g-3 mt-1">
        @foreach($themes as $key => $item)
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="{{ asset($screenshots[$key]) }}" alt="{{ $item['name'] }}" class="card-img-top">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <h3 class="card-title mb-0 me-2">{{ $item['name'] }}</h3>
                            @if($item['legacy'])
                                <span class="badge bg-secondary-lt">legacy</span>
                            @else
                                <span class="badge bg-green-lt">default</span>
                            @endif
                        </div>
                        <p class="text-secondary">{{ $item['description'] }}</p>
                        <div class="d-flex flex-wrap gap-1">
                            @foreach($highlights[$key] as $highlight)
                                <span class="badge bg-primary-lt">{{ $highlight }}</span>
                            @endforeach
                        </div>
                    </div>
                    @if($item['legacy'])
                        <div class="card-footer text-secondary small">Kept so older projects keep working. Not recommended for new ones.</div>
                    @else
                        <div class="card-footer text-secondary small">Actively developed. The one we recommend for every new project.</div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
