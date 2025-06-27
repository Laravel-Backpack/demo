<li class="nav-item">
    <button class="btn btn-link nav-link shadow-none border-0 bg-transparent" data-toggle="tooltip" title="Back to using the Tabler theme" style="height: 1.25rem" onclick="switchToTablerTheme()">
        <i class="la la-swatchbook" style="font-size: 20px;"></i>
    </button>
</li>

@push('after_scripts')
<script>
function switchToTablerTheme() {
    // Create a form to submit the theme switch request
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route('tabler.switch.layout') }}';
    form.style.display = 'none';

    // Add CSRF token
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = '{{ csrf_token() }}';
    form.appendChild(csrfToken);

    // Add theme parameter
    const themeInput = document.createElement('input');
    themeInput.type = 'hidden';
    themeInput.name = 'theme';
    themeInput.value = 'tabler';
    form.appendChild(themeInput);

    // Add layout parameter (default to horizontal)
    const layoutInput = document.createElement('input');
    layoutInput.type = 'hidden';
    layoutInput.name = 'layout';
    layoutInput.value = 'horizontal';
    form.appendChild(layoutInput);

    // Submit the form
    document.body.appendChild(form);
    form.submit();
}
</script>
@endpush

@include('backpack.language-switcher::language-switcher')
