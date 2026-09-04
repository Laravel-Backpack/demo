{{--
    A greyed-out menu entry for a page the demo does not have yet.
    Same markup as <x-backpack::menu-dropdown-item>, but not clickable, with an "Example coming soon" tooltip.

    Usage: <x-menu-todo-item title="Themes" icon="la la-palette" label="FREE" />
--}}
@props(['title', 'icon' => null, 'label' => null, 'tooltip' => 'Example coming soon'])

<a {{ $attributes->merge(['class' => 'dropdown-item demo-todo-item', 'href' => 'javascript:void(0)', 'data-bs-toggle' => 'tooltip', 'data-bs-placement' => 'right', 'title' => $tooltip]) }}>
    @if($icon)<i class="nav-icon {{ $icon }} d-block d-lg-none d-xl-block"></i>@endif
    <span>{{ $title }}</span>
    @if($label)<span class="badge bg-green-lt ms-2">{{ $label }}</span>@endif
</a>
