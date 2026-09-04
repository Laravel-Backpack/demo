{{-- Features > Skins: what a skin is, the ones available, and a CTA to try them in the Customize drawer. --}}
@extends(backpack_view('blank'))

@php
    $skins = config('demo.skins');
    $currentSkin = demo_skin();
@endphp

@section('header')
    @include('admin.partials.feature_header', ['title' => $title, 'description' => $description, 'docs' => 'https://backpackforlaravel.com/docs/7.x/base-themes'])
@endsection

@section('content')
    <div class="row g-3 mt-1">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">What a skin is</h3>
                    <p>A skin is one or more CSS files loaded after the theme's own stylesheets. It changes colors, backgrounds, spacing or effects, and nothing else: the layout, the markup and your code stay the same. That makes a skin the cheapest way to give an admin panel a personality.</p>
                    <p>Skins are a feature of the <strong>Tabler</strong> theme. To use one in your project, list its CSS files in <code>config/backpack/theme-tabler.php</code>:</p>
<pre class="mb-0"><code>'styles' => [
    base_path('vendor/backpack/theme-tabler/resources/assets/css/skins/backpack-color-palette.css'),
    base_path('vendor/backpack/theme-tabler/resources/assets/css/skins/glass.css'),
    base_path('vendor/backpack/theme-tabler/resources/assets/css/skins/fuzzy-background.css'),
],</code></pre>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <x-demo-callout title="Try them live" icon="la la-swatchbook" class="h-100">
                Pick a skin in the Customize drawer and watch this page change, no reload needed.
                <x-slot:actions>
                    <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#demo-customizer">Open Customize</button>
                </x-slot:actions>
            </x-demo-callout>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title">Skins in this demo</h3>
        </div>
        <div class="list-group list-group-flush">
            @foreach($skins as $key => $skin)
                <div class="list-group-item">
                    <div class="row align-items-center g-3">
                        <div class="col-auto">
                            <span class="d-block rounded-3 border" style="width: 3.5rem; height: 3.5rem; background: {{ $skin['swatch'] }}"></span>
                        </div>
                        <div class="col">
                            <div class="d-flex align-items-center">
                                <strong>{{ $skin['name'] }}</strong>
                                @if($key === config('demo.default_skin'))<span class="badge bg-secondary-lt ms-2">default</span>@endif
                                @if($key === $currentSkin)<span class="badge bg-green-lt ms-2">active</span>@endif
                            </div>
                            <div class="text-secondary">{{ $skin['description'] }}</div>
                        </div>
                        <div class="col-auto text-secondary small">
                            {{ count($skin['styles']) }} {{ Str::plural('CSS file', count($skin['styles'])) }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
