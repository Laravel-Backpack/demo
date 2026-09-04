{{--
    Page header for the "Features" pages.
    @include('admin.partials.feature_header', ['title' => 'Widgets', 'description' => '...', 'docs' => 'https://...'])
--}}
<div class="container-fluid">
    <div class="row g-2 align-items-center">
        <div class="col">
            <div class="page-pretitle">{{ $pretitle ?? 'Features' }}</div>
            <h2 class="page-title">{{ $title }}</h2>
            @if(! empty($description))
                <p class="mt-2 mb-0 text-secondary">{{ $description }}</p>
            @endif
        </div>
        @if(! empty($docs))
            <div class="col-auto ms-auto d-print-none">
                <a href="{{ $docs }}" target="_blank" class="btn btn-outline-primary">{{ $docsLabel ?? 'See docs' }} <i class="la la-external-link-alt ms-1"></i></a>
            </div>
        @endif
    </div>
</div>
