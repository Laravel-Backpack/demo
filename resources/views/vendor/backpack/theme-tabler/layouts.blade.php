@extends(backpack_view('blank'))

@section('header')
    <section class="container-fluid">
        <h2>Layouts</h2>
        <p>Try out some of the layout Backpack offers out of the box...!</p>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Vertical</h3>
                    <img class="shadow backpack-sample-img" src="" alt="Horizontal Layout" data-layout="vertical">
                </div>
                <div class="card-footer">
                    @if(backpack_theme_config('layout') === 'vertical')
                        <button class="btn btn-success disabled"><i class="la la-check me-2"></i>Testing</button>
                    @else
                        <form method="POST" action="{{ route('tabler.update.layout', ['layout' => 'vertical']) }}">
                            @csrf
                            <button class="btn btn-primary" type="submit"><i class="la la-check me-2"></i>Try it</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Vertical Dark</h3>
                    <img class="shadow backpack-sample-img" src="" alt="Horizontal Layout" data-layout="vertical_dark">
                </div>
                <div class="card-footer">
                    @if(backpack_theme_config('layout') === 'vertical_dark')
                        <button class="btn btn-success disabled"><i class="la la-check me-2"></i>Testing</button>
                    @else
                        <form method="POST" action="{{ route('tabler.update.layout', ['layout' => 'vertical_dark']) }}">
                            @csrf
                            <button class="btn btn-primary" type="submit"><i class="la la-check me-2"></i>Try it</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Vertical Transparent</h3>
                    <img class="shadow backpack-sample-img" src="" alt="Horizontal Layout" data-layout="vertical_transparent">
                </div>
                <div class="card-footer">
                    @if(backpack_theme_config('layout') === 'vertical_transparent')
                        <button class="btn btn-success disabled"><i class="la la-check me-2"></i>Testing</button>
                    @else
                        <form method="POST" action="{{ route('tabler.update.layout', ['layout' => 'vertical_transparent']) }}">
                            @csrf
                            <button class="btn btn-primary" type="submit"><i class="la la-check me-2"></i>Try it</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Horizontal</h3>
                    <img class="shadow backpack-sample-img" src="" alt="Vertical Horizontal" data-layout="horizontal">
                </div>
                <div class="card-footer">
                    @if(backpack_theme_config('layout') === 'horizontal')
                        <button class="btn btn-success disabled"><i class="la la-check me-2"></i>Testing</button>
                    @else
                        <form method="POST" action="{{ route('tabler.update.layout', ['layout' => 'horizontal']) }}">
                            @csrf
                            <button class="btn btn-primary" type="submit"><i class="la la-check me-2"></i>Try it</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Horizontal Dark</h3>
                    <img class="shadow backpack-sample-img" src="" alt="Vertical Horizontal" data-layout="horizontal_dark">
                </div>
                <div class="card-footer">
                    @if(backpack_theme_config('layout') === 'horizontal_dark')
                        <button class="btn btn-success disabled"><i class="la la-check me-2"></i>Testing</button>
                    @else
                        <form method="POST" action="{{ route('tabler.update.layout', ['layout' => 'horizontal_dark']) }}">
                            @csrf
                            <button class="btn btn-primary" type="submit"><i class="la la-check me-2"></i>Try it</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Horizontal Overlap</h3>
                    <img class="shadow backpack-sample-img" src="" alt="Horizontal Overlap Layout" data-layout="horizontal_overlap">
                </div>
                <div class="card-footer">
                    @if(backpack_theme_config('layout') === 'horizontal_overlap')
                        <button class="btn btn-success disabled"><i class="la la-check me-2"></i>Testing</button>
                    @else
                        <form method="POST" action="{{ route('tabler.update.layout', ['layout' => 'horizontal_overlap']) }}">
                            @csrf
                            <button class="btn btn-primary" type="submit"><i class="la la-check me-2"></i>Try it</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Right Vertical</h3>
                    <img class="shadow backpack-sample-img" src="" alt="Horizontal Overlap Layout" data-layout="right_vertical">
                </div>
                <div class="card-footer">
                    @if(backpack_theme_config('layout') === 'right_vertical')
                        <button class="btn btn-success disabled"><i class="la la-check me-2"></i>Testing</button>
                    @else
                        <form method="POST" action="{{ route('tabler.update.layout', ['layout' => 'right_vertical']) }}">
                            @csrf
                            <button class="btn btn-primary" type="submit"><i class="la la-check me-2"></i>Try it</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Right Vertical Dark</h3>
                    <img class="shadow backpack-sample-img" src="" alt="Horizontal Overlap Layout" data-layout="right_vertical_dark">
                </div>
                <div class="card-footer">
                    @if(backpack_theme_config('layout') === 'right_vertical_dark')
                        <button class="btn btn-success disabled"><i class="la la-check me-2"></i>Testing</button>
                    @else
                        <form method="POST" action="{{ route('tabler.update.layout', ['layout' => 'right_vertical_dark']) }}">
                            @csrf
                            <button class="btn btn-primary" type="submit"><i class="la la-check me-2"></i>Try it</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Right Vertical Transparent</h3>
                    <img class="shadow backpack-sample-img" src="" alt="Horizontal Overlap Layout" data-layout="right_vertical_transparent">
                </div>
                <div class="card-footer">
                    @if(backpack_theme_config('layout') === 'right_vertical_transparent')
                        <button class="btn btn-success disabled"><i class="la la-check me-2"></i>Testing</button>
                    @else
                        <form method="POST" action="{{ route('tabler.update.layout', ['layout' => 'right_vertical_transparent']) }}">
                            @csrf
                            <button class="btn btn-primary" type="submit"><i class="la la-check me-2"></i>Try it</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
    <script>
        const images = $('.backpack-sample-img');

        function loadSamplesImages() {
            images.each(function () {
                const layout = $(this).data('layout');
                $(this).attr('src', '/img/' + layout + '-' + colorMode.get() + '.png');
            });
        }

        colorMode.registerListener(function () {
            loadSamplesImages();
        });

        loadSamplesImages();
    </script>
@endsection