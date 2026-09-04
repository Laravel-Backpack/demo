{{--
    A callout card that clearly is not part of the "normal" page: tinted background,
    decorative dots, big title. Used for the explainer widgets and the CTAs on the
    Features pages. Same look as the old "Help us polish v7" card.

    <x-demo-callout title="List Operation" badge="FREE" icon="la la-list">
        Body text...
        <x-slot:actions> buttons </x-slot:actions>
        <x-slot:close> a close link </x-slot:close>
    </x-demo-callout>
--}}
@props(['title', 'badge' => null, 'icon' => null])

@php
    // FREE is green, PRO purple, and the bundles get their metal.
    $badgeClass = match ($badge) {
        'PRO'    => 'bg-primary text-white',
        'SILVER' => 'bg-secondary text-white',
        'GOLD'   => 'bg-yellow text-dark',
        default  => 'bg-green text-white',
    };
@endphp

<div {{ $attributes->merge(['class' => 'card demo-callout']) }}>
    @include('admin.partials.dots_decoration')
    <div class="card-body position-relative p-4">
        <div class="d-flex align-items-start">
            @if($icon)
                <span class="avatar avatar-lg bg-primary text-white rounded-3 me-4 flex-shrink-0"><i class="{{ $icon }} fs-1"></i></span>
            @endif
            <div class="flex-fill">
                <div class="d-flex align-items-center flex-wrap mb-1">
                    <h2 class="h1 mb-0 me-2">{{ $title }}</h2>
                    @if($badge)
                        <span class="badge {{ $badgeClass }}">{{ $badge }}</span>
                    @endif
                </div>
                <div class="demo-callout-body fs-3 fw-normal text-secondary">{{ $slot }}</div>
                @isset($actions)
                    <div class="mt-3 d-flex flex-wrap gap-2">{{ $actions }}</div>
                @endisset
            </div>
            @isset($close)
                <div class="ms-3 flex-shrink-0">{{ $close }}</div>
            @endisset
        </div>
    </div>
</div>

@once
    <style>
        .demo-callout {
            position: relative;
            overflow: hidden;
            border: none;
            background: color-mix(in srgb, var(--tblr-primary) 5%, var(--tblr-bg-surface));
        }
        .demo-callout .demo-decoration {
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            pointer-events: none;
        }
        [dir="rtl"] .demo-callout .demo-decoration {
            right: auto;
            left: 0;
            transform: scaleX(-1);
        }
        .demo-callout-body p:last-child {
            margin-bottom: 0;
        }
        .demo-callout-body code {
            font-size: .85em;
        }
    </style>
@endonce
