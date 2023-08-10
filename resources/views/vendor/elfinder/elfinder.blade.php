@extends(backpack_view('blank'))

@section('after_scripts')

        @include('vendor.elfinder.common_scripts')
        @include('vendor.elfinder.common_styles')

        <!-- elFinder initialization (REQUIRED) -->
        <script type="text/javascript" charset="utf-8">
            // Documentation for client options:
            // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
            $(document).ready(function() {
                $('#elfinder').elfinder({
                    // set your elFinder options here
                    @if($locale)
                        lang: '{{ $locale }}', // locale
                    @endif
                    customData: { 
                        _token: '{{ csrf_token() }}'
                    },
                    url : '{{ route("elfinder.connector") }}',  // connector URL
                    soundPath: '{{ Basset::getUrl(base_path("vendor/studio-42/elfinder/sounds")) }}',
                    cssAutoLoad : false,
                });
            });
        </script>
@endsection

@php
  $breadcrumbs = [
    trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
    trans('backpack::crud.file_manager') => false,
  ];
@endphp

@section('header')
    <section class="container-fluid" bp-section="page-header">
      <h1 bp-section="page-heading">{{ trans('backpack::crud.file_manager') }}</h1>
    </section>
@endsection

@section('content')

        <!-- Element where elFinder will be created (REQUIRED) -->
        <div id="elfinder"></div>

@endsection
