{{-- Features > Design: the HTML templates behind the themes, and where to browse their components. --}}
@extends(backpack_view('blank'))

@php
    $templates = [
        [
            'name'        => 'Tabler',
            'theme'       => 'Tabler theme',
            'badge'       => 'default',
            'bootstrap'   => 'Bootstrap 5',
            'description' => 'A clean, modern admin template with hundreds of components: cards, tables, forms, modals, steps, timelines, charts, icons and full page layouts. This demo runs on it.',
            'links'       => [
                ['label' => 'Live preview', 'url' => 'https://tabler.io/admin-template/preview'],
                ['label' => 'Components', 'url' => 'https://tabler.io/docs'],
                ['label' => 'Icons', 'url' => 'https://tabler.io/icons'],
            ],
        ],
        [
            'name'        => 'CoreUI 4',
            'theme'       => 'CoreUI v4 theme',
            'badge'       => 'legacy',
            'bootstrap'   => 'Bootstrap 5',
            'description' => 'The template behind the CoreUI v4 theme. Kept so older projects keep working; new projects should use Tabler.',
            'links'       => [
                ['label' => 'Live preview', 'url' => 'https://coreui.io/demos/bootstrap/4.2/free/'],
                ['label' => 'Components', 'url' => 'https://coreui.io/bootstrap/docs/'],
            ],
        ],
        [
            'name'        => 'CoreUI 2',
            'theme'       => 'CoreUI v2 theme',
            'badge'       => 'legacy',
            'bootstrap'   => 'Bootstrap 4',
            'description' => 'The template behind the CoreUI v2 theme, Backpack\'s default for years. Still works, no longer evolving.',
            'links'       => [
                ['label' => 'Source, v2.1', 'url' => 'https://github.com/coreui/coreui-free-bootstrap-admin-template/tree/v2.1.16'],
                ['label' => 'Bootstrap 4 docs', 'url' => 'https://getbootstrap.com/docs/4.6/components/'],
            ],
        ],
    ];
@endphp

@section('header')
    @include('admin.partials.feature_header', ['title' => $title, 'description' => $description, 'docs' => 'https://backpackforlaravel.com/docs/7.x/base-themes'])
@endsection

@section('content')
    <x-demo-callout title="300+ components, ready to use" icon="la la-pencil-ruler" class="mt-3">
        Every Backpack theme is built on a free, open-source HTML template, so anything in that template is yours to use in custom pages, widgets and fields: copy the HTML from its docs and paste it into a Blade file. No extra build step, no extra dependency.
    </x-demo-callout>

    <div class="row g-3 mt-1">
        @foreach($templates as $template)
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <h3 class="card-title mb-0 me-2">{{ $template['name'] }}</h3>
                            <span class="badge {{ $template['badge'] === 'default' ? 'bg-green-lt' : 'bg-secondary-lt' }}">{{ $template['badge'] }}</span>
                        </div>
                        <div class="text-secondary small mb-2">{{ $template['theme'] }} &middot; {{ $template['bootstrap'] }}</div>
                        <p class="text-secondary">{{ $template['description'] }}</p>
                    </div>
                    <div class="card-footer d-flex flex-wrap gap-2">
                        @foreach($template['links'] as $link)
                            <a href="{{ $link['url'] }}" target="_blank" class="btn btn-sm {{ $loop->first ? 'btn-primary' : 'btn-outline-primary' }}">{{ $link['label'] }} <i class="la la-external-link-alt ms-1"></i></a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
