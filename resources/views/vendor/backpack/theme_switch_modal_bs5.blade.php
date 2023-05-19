@section('before_scripts')
    <div class="modal modal-blur fade pe-0" id="modal-layout" tabindex="-1" style="display: none;" aria-modal="false" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="{{ route('tabler.switch.layout') }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Themes</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Try out the themes <strong>Backpack</strong> offers you out of the box...!</p>
                        @csrf
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-4 mb-2">
                                <label class="form-selectgroup-item">
                                    <input @if(config('backpack.ui.view_namespace') === 'backpack.theme-coreuiv2::') checked @endif type="radio" name="theme" value="coreuiv2" class="form-selectgroup-input theme-choice">
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Core UI v2</span><br>
                                            <small>Bootstrap 4</small>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-4 mb-2">
                                <label class="form-selectgroup-item">
                                    <input @if(config('backpack.ui.view_namespace') === 'backpack.theme-coreuiv4::') checked @endif type="radio" name="theme" value="coreuiv4" class="form-selectgroup-input theme-choice">
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Core UI v4</span><br>
                                            <small>Bootstrap 5</small>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-4 mb-2">
                                <label class="form-selectgroup-item">
                                    <input @if(config('backpack.ui.view_namespace') === 'backpack.theme-tabler::') checked @endif type="radio" name="theme" value="tabler" class="form-selectgroup-input theme-choice">
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Tabler</span><br>
                                            <small>Bootstrap 5</small>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div id="tabler-layouts-selection" class="form-selectgroup-boxes row mb-3">
                            <p>Take it even further with the layouts <strong>Backpack Tabler Theme</strong> offers:</p>
                            <div class="col-lg-6 mb-2">
                                <label class="form-selectgroup-item">
                                    <input @if(backpack_theme_config('layout') === 'horizontal') checked @endif type="radio" name="layout" value="horizontal" class="form-selectgroup-input">
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                            <span class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </span>
                                            <span class="form-selectgroup-label-content">
                                                <span class="form-selectgroup-title strong mb-1">Horizontal</span>
                                            </span>
                                        </span>
                                </label>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-selectgroup-item">
                                    <input @if(backpack_theme_config('layout') === 'horizontal_dark') checked @endif type="radio" name="layout" value="horizontal_dark" class="form-selectgroup-input">
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                            <span class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </span>
                                            <span class="form-selectgroup-label-content">
                                                <span class="form-selectgroup-title strong mb-1">Horizontal Dark</span>
                                            </span>
                                        </span>
                                </label>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-selectgroup-item">
                                    <input @if(backpack_theme_config('layout') === 'horizontal_overlap') checked @endif type="radio" name="layout" value="horizontal_overlap" class="form-selectgroup-input">
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                            <span class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </span>
                                            <span class="form-selectgroup-label-content">
                                                <span class="form-selectgroup-title strong mb-1">Horizontal Overlap</span>
                                            </span>
                                        </span>
                                </label>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-selectgroup-item">
                                    <input @if(backpack_theme_config('layout') === 'vertical') checked @endif type="radio" name="layout" value="vertical" class="form-selectgroup-input">
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                            <span class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </span>
                                            <span class="form-selectgroup-label-content">
                                                <span class="form-selectgroup-title strong mb-1">Vertical</span>
                                            </span>
                                        </span>
                                </label>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-selectgroup-item">
                                    <input @if(backpack_theme_config('layout') === 'vertical_dark') checked @endif type="radio" name="layout" value="vertical_dark" class="form-selectgroup-input">
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                            <span class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </span>
                                            <span class="form-selectgroup-label-content">
                                                <span class="form-selectgroup-title strong mb-1">Vertical Dark</span>
                                            </span>
                                        </span>
                                </label>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-selectgroup-item">
                                    <input @if(backpack_theme_config('layout') === 'vertical_transparent') checked @endif type="radio" name="layout" value="vertical_transparent" class="form-selectgroup-input">
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                            <span class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </span>
                                            <span class="form-selectgroup-label-content">
                                                <span class="form-selectgroup-title strong mb-1">Vertical Transparent</span>
                                            </span>
                                        </span>
                                </label>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-selectgroup-item">
                                    <input @if(backpack_theme_config('layout') === 'right_vertical') checked @endif type="radio" name="layout" value="right_vertical" class="form-selectgroup-input">
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                            <span class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </span>
                                            <span class="form-selectgroup-label-content">
                                                <span class="form-selectgroup-title strong mb-1">Right Vertical</span>
                                            </span>
                                        </span>
                                </label>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-selectgroup-item">
                                    <input @if(backpack_theme_config('layout') === 'right_vertical_dark') checked @endif type="radio" name="layout" value="right_vertical_dark" class="form-selectgroup-input">
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                            <span class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </span>
                                            <span class="form-selectgroup-label-content">
                                                <span class="form-selectgroup-title strong mb-1">Right Vertical Dark</span>
                                            </span>
                                        </span>
                                </label>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-selectgroup-item">
                                    <input @if(backpack_theme_config('layout') === 'right_vertical_transparent') checked @endif type="radio" name="layout" value="right_vertical_transparent" class="form-selectgroup-input">
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                            <span class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </span>
                                            <span class="form-selectgroup-label-content">
                                                <span class="form-selectgroup-title strong mb-1">Right Vertical Transparent</span>
                                            </span>
                                        </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-dismiss="modal" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button class="btn btn-primary" type="submit"><i class="la la-check me-2"></i>Apply layout</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('after_scripts')
    <script>
        const layoutSelection = $('#tabler-layouts-selection');
        @if(config('backpack.ui.view_namespace') !== 'backpack.theme-tabler::')
        layoutSelection.hide();
        @endif
        $('.theme-choice').on('click', function () {
            $(this).val() === 'tabler'
                ? layoutSelection.slideDown()
                : layoutSelection.slideUp();
        });
    </script>
@endsection