<div class="w-100 justify-content-center d-none d-lg-flex sidebar-shortcuts">
    @includeWhen(backpack_theme_config('options.showColorModeSwitcher'), backpack_view('layouts.partials.switch_theme'))
    <button class="btn-link text-secondary nav-link px-0 shadow-none" data-bs-toggle="modal" data-bs-target="#modal-layout">
        <i class="la la-palette fs-2 me-1"></i>
    </button>
</div>

@include('vendor.backpack.theme_switch_modal_bs5')