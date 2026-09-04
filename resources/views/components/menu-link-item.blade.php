{{--
    A regular dropdown menu entry with an optional label: FREE, PRO, SILVER or GOLD.
    Same markup as <x-backpack::menu-dropdown-item>, plus the badge.

    Usage: <x-menu-link-item title="Trash Operation" icon="la la-trash-restore" :link="backpack_url('pet-shop/invoice?explainer=trash')" label="PRO" />
--}}
@props(['title', 'icon' => null, 'link', 'label' => null])

@php
    $labelClass = match ($label) {
        'PRO'    => 'bg-primary-lt',
        'SILVER' => 'bg-secondary-lt',
        'GOLD'   => 'bg-yellow-lt',
        default  => 'bg-green-lt',
    };
@endphp

<a {{ $attributes->merge(['class' => 'dropdown-item', 'href' => $link]) }}>
    @if($icon)<i class="nav-icon {{ $icon }} d-block d-lg-none d-xl-block"></i>@endif
    <span>{{ $title }}</span>
    @if($label)<span class="badge {{ $labelClass }} ms-2">{{ $label }}</span>@endif
</a>
