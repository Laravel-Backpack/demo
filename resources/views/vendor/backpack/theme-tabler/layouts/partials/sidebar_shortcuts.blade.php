{{-- Vertical layouts: only the light/dark switcher here. Skins and layouts live in the floating "Customize" drawer. --}}
<div class="w-100 justify-content-center d-none d-lg-flex sidebar-shortcuts">
    @includeWhen(backpack_theme_config('options.showColorModeSwitcher'), backpack_view('layouts.partials.switch_theme'))
</div>
