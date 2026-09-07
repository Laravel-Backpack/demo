{{-- Vertical layouts: the light/dark switch and a button that opens the demo "Customize" drawer. --}}
<div class="w-100 justify-content-center d-none d-lg-flex sidebar-shortcuts">
    @includeWhen(backpack_theme_config('options.showColorModeSwitcher'), backpack_view('layouts.partials.switch_theme'))
    <button type="button" class="btn-link text-secondary nav-link px-0 shadow-none" data-bs-toggle="offcanvas" data-bs-target="#demo-customizer" aria-controls="demo-customizer" title="Customize: skin, layout, theme">
        <i class="la la-swatchbook fs-2 me-1"></i>
    </button>
</div>
