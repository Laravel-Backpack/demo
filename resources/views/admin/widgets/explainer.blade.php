{{--
    The explainer card shown at the top of a page when the URL has ?explainer=<key>.
    Added by App\Http\Middleware\DemoExplainer; texts come from config/demo.php.

    Inside CRUD views, ":fields" and ":columns" in the text are replaced with the
    number of fields / columns of the current CRUD panel.
--}}
@php
    $explainer = $widget['explainer'];
    $body = $explainer['body'];

    if (isset($crud)) {
        $body = str_replace(
            [':fields', ':columns'],
            [count($crud->fields()), count($crud->columns())],
            $body
        );
    }

    $hideUrl = request()->fullUrlWithoutQuery('explainer');
@endphp

<x-demo-callout :title="$explainer['title']" :badge="$explainer['badge'] ?? null" :icon="$explainer['icon'] ?? 'la la-info-circle'" class="mb-3">
    {!! $body !!}

    <x-slot:actions>
        @if(! empty($explainer['product']))
            <a href="{{ $explainer['product'] }}" target="_blank" class="btn btn-primary">
                See on backpackforlaravel.com <i class="la la-external-link-alt ms-1"></i>
            </a>
            <a href="{{ $explainer['docs'] }}" target="_blank" class="btn btn-outline-primary">Read the docs</a>
        @else
            <a href="{{ $explainer['docs'] }}" target="_blank" class="btn btn-primary">
                Read the docs <i class="la la-external-link-alt ms-1"></i>
            </a>
        @endif
        <a href="{{ $hideUrl }}" class="btn btn-ghost-secondary">Hide this</a>
    </x-slot:actions>

    <x-slot:close>
        <a href="{{ $hideUrl }}" class="btn-close" aria-label="Hide"></a>
    </x-slot:close>
</x-demo-callout>

<script>
    // Drop ?explainer from the address bar now that the card is rendered. Backpack's
    // persistent table remembers a list URL with query parameters and restores it
    // later, even from a datatable embedded on another page; the parameter must not
    // be part of what it remembers.
    (function () {
        var url = new URL(window.location.href);
        if (url.searchParams.has('explainer')) {
            url.searchParams.delete('explainer');
            window.history.replaceState({}, '', url.toString());
        }
    })();
</script>
