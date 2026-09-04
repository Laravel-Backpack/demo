@include('backpack.language-switcher::language-switcher')

{{-- The demo "Customize" drawer (skin, layout, direction, legacy themes). --}}
@section('before_scripts')
    @include('admin.partials.theme_switcher')
@endsection
