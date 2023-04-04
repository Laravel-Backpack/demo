@extends(backpack_view('blank'))

@section('header')
    <section class="container-fluid">
        <h2>Layouts</h2>
        <p>Try out some of the layout Backpack offers out of the box...!</p>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Vertical</h3>
                    <img id="img-vertical" class="shadow" src="" alt="Horizontal Layout">
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Horizontal</h3>
                    <img id="img-horizontal" class="shadow" src="" alt="Vertical Horizontal">
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Horizontal Overlap</h3>
                    <img id="img-horizontal_overlap" class="shadow" src="" alt="Horizontal Overlap Layout">
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
    </div>
@endsection

@section('after_scripts')
    <script>
        const imgHorizontal = $('#img-horizontal');
        const imgHorizontalOverlap = $('#img-horizontal_overlap');
        const imgVertical = $('#img-vertical');

        imgHorizontal.attr('src', '/img/horizontal-' + colorMode.get() + '.png');
        imgHorizontalOverlap.attr('src', '/img/horizontal_overlap-' + colorMode.get() + '.png');
        imgVertical.attr('src', '/img/vertical-' + colorMode.get() + '.png');

        colorMode.registerListener(function (theme) {
            imgHorizontal.attr('src', '/img/horizontal-' + theme + '.png');
            imgHorizontalOverlap.attr('src', '/img/horizontal_overlap-' + theme + '.png');
            imgVertical.attr('src', '/img/vertical-' + theme + '.png');
        });
    </script>
@endsection