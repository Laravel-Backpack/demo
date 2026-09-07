{{-- Opens the demo "Customize" drawer (skins, layouts, direction, legacy themes), next to the light/dark switch. --}}
<li class="nav-item me-2">
    <button type="button" class="btn-link nav-link px-0 shadow-none" data-bs-toggle="offcanvas" data-bs-target="#demo-customizer" aria-controls="demo-customizer" title="Customize: skin, layout, theme">
        <i class="la la-swatchbook fs-2 me-1 text-secondary"></i>
    </button>
</li>

@include('backpack.language-switcher::language-switcher')

{{-- The drawer itself, plus the floating "Customize" button at the bottom right. --}}
@section('before_scripts')
    @include('admin.partials.theme_switcher')
@endsection
