{{-- Features > Alerts: trigger notifications from PHP (flash + redirect) or from JavaScript (Noty). --}}
@extends(backpack_view('blank'))

@php
    $types = [
        'success' => ['label' => 'Success', 'class' => 'btn-success'],
        'info'    => ['label' => 'Info', 'class' => 'btn-info'],
        'warning' => ['label' => 'Warning', 'class' => 'btn-warning'],
        'error'   => ['label' => 'Error', 'class' => 'btn-danger'],
    ];
@endphp

@section('header')
    @include('admin.partials.feature_header', ['title' => $title, 'description' => $description, 'docs' => 'https://backpackforlaravel.com/docs/7.x/base-alerts'])
@endsection

@section('content')
    <div class="row g-3 mt-1">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title">From PHP</h3>
                    <p class="text-secondary">Flash an alert in a controller, redirect, and Backpack shows it on the next page. This is what every CRUD operation does after saving.</p>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        @foreach($types as $type => $button)
                            <form method="POST" action="{{ route('features.alerts.trigger') }}">
                                @csrf
                                <input type="hidden" name="type" value="{{ $type }}">
                                <button type="submit" class="btn {{ $button['class'] }}">{{ $button['label'] }}</button>
                            </form>
                        @endforeach
                    </div>
<pre class="mb-0"><code>use Prologue\Alerts\Facades\Alert;

Alert::success('Entry saved.')->flash();

return redirect()->back();</code></pre>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title">From JavaScript</h3>
                    <p class="text-secondary">Show an alert right away, without a page load. Backpack bundles <a href="https://github.com/needim/noty" target="_blank">Noty</a>, already styled to match the theme.</p>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        @foreach($types as $type => $button)
                            <button type="button" class="btn {{ $button['class'] }}" data-demo-alert="{{ $type }}">{{ $button['label'] }}</button>
                        @endforeach
                    </div>
<pre class="mb-0"><code>new Noty({
    type: 'success',
    text: 'Entry saved.',
}).show();</code></pre>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
    <script>
        document.querySelectorAll('[data-demo-alert]').forEach(function (button) {
            button.addEventListener('click', function () {
                new Noty({
                    type: button.dataset.demoAlert,
                    text: 'This "' + button.dataset.demoAlert + '" alert was shown from JavaScript, no page load.',
                }).show();
            });
        });
    </script>
@endsection
