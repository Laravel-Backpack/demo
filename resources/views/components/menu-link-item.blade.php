{{--
    A regular dropdown menu entry with an optional FREE / PRO label.
    Same markup as <x-backpack::menu-dropdown-item>, plus the badge.

    Usage: <x-menu-link-item title="List Operation" icon="la la-list" :link="backpack_url('pet-shop/owner?explainer=list')" label="FREE" />
--}}
@props(['title', 'icon' => null, 'link', 'label' => null])

<a {{ $attributes->merge(['class' => 'dropdown-item', 'href' => $link]) }}>
    @if($icon)<i class="nav-icon {{ $icon }} d-block d-lg-none d-xl-block"></i>@endif
    <span>{{ $title }}</span>
    @if($label)<span class="badge {{ $label === 'PRO' ? 'bg-primary-lt' : 'bg-green-lt' }} ms-2">{{ $label }}</span>@endif
</a>
