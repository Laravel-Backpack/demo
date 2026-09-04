{{--
    The page for one paid add-on. Content comes from config/demo.php ('paid_addons').
    When the add-on has a live example in the demo, the page links to it;
    when it can be shown in place (example_view), it is embedded below.
--}}
@extends(backpack_view('blank'))

@php
    $bundle = $addon['bundle'] ?? 'GOLD';
    $bundleNote = $bundle === 'SILVER'
        ? 'Included in the SILVER bundle, and in GOLD.'
        : 'Included in the GOLD bundle, together with every other paid add-on.';
@endphp

@section('header')
    @include('admin.partials.feature_header', ['pretitle' => 'Paid Add-ons', 'title' => $addon['name'], 'description' => $addon['tagline']])
@endsection

@section('content')
    <x-demo-callout :title="$addon['name']" :badge="$bundle" :icon="$addon['icon']" class="mt-3">
        {{ $addon['tagline'] }}
        <x-slot:actions>
            <a href="{{ $addon['product'] }}" target="_blank" class="btn btn-primary">
                See pricing &amp; buy <i class="la la-external-link-alt ms-1"></i>
            </a>
            @if(! empty($addon['example']))
                <a href="{{ backpack_url($addon['example']['url']) }}" class="btn btn-outline-primary">
                    <i class="la la-play me-1"></i> {{ $addon['example']['label'] }}
                </a>
            @endif
            <a href="{{ $addon['docs'] }}" target="_blank" class="btn btn-ghost-secondary">Read the docs</a>
        </x-slot:actions>
    </x-demo-callout>

    <div class="row g-3 mt-1">
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title">What it does</h3>
                    @foreach($addon['description'] as $paragraph)
                        <p class="{{ $loop->last ? 'mb-0' : '' }}">{{ $paragraph }}</p>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title">Highlights</h3>
                    <ul class="list-unstyled mb-0">
                        @foreach($addon['highlights'] as $highlight)
                            <li class="d-flex align-items-start mb-2">
                                <span class="badge bg-green-lt me-2 mt-1"><i class="la la-check"></i></span>
                                <span>{{ $highlight }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @if(! empty($addon['example_view']))
        <div class="page-pretitle mt-4">Live example</div>
        @include($addon['example_view'])
    @endif

    <div class="card mt-3">
        <div class="card-body d-flex flex-wrap align-items-center">
            <div class="me-3">
                <span class="avatar {{ $bundle === 'SILVER' ? 'bg-secondary-lt' : 'bg-yellow-lt' }}"><i class="la la-box-open fs-2"></i></span>
            </div>
            <div class="flex-fill">
                <strong>{{ $bundleNote }}</strong>
                <span class="text-secondary d-block d-md-inline">Or buy it on its own, for unlimited projects.</span>
            </div>
            <a href="https://backpackforlaravel.com/pricing" target="_blank" class="btn btn-outline-primary mt-2 mt-md-0">Compare bundles <i class="la la-external-link-alt ms-1"></i></a>
        </div>
    </div>
@endsection
