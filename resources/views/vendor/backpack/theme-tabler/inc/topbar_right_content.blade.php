<li class="nav-item me-1">
    <a href="javascript:void(0);" class="nav-link px-0" data-bs-toggle="modal" data-bs-target="#modal-layout">
        <i class="la la-stream fs-2"></i>
    </a>
</li>

@section('before_scripts')
    <div class="modal modal-blur fade pe-0" id="modal-layout" tabindex="-1" style="display: none;" aria-modal="false" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="{{ route('tabler.switch.layout') }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Layouts</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Try out some layouts <strong>Backpack Tabler Theme</strong> offers out of the box...!</p>
                        @csrf
                        <div class="form-selectgroup-boxes row mb-3">
                            @unless(backpack_theme_config('layout') === 'horizontal')
                                <div class="col-lg-6 mb-2">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="layout" value="horizontal" class="form-selectgroup-input">
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
                            @endunless
                            @unless(backpack_theme_config('layout') === 'horizontal_dark')
                                <div class="col-lg-6 mb-2">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="layout" value="horizontal_dark" class="form-selectgroup-input">
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
                            @endunless
                            @unless(backpack_theme_config('layout') === 'horizontal_overlap')
                                <div class="col-lg-6 mb-2">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="layout" value="horizontal_overlap" class="form-selectgroup-input">
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
                            @endunless
                            @unless(backpack_theme_config('layout') === 'vertical')
                                <div class="col-lg-6 mb-2">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="layout" value="vertical" class="form-selectgroup-input">
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
                            @endunless
                            @unless(backpack_theme_config('layout') === 'vertical_dark')
                                <div class="col-lg-6 mb-2">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="layout" value="vertical_dark" class="form-selectgroup-input">
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
                            @endunless
                            @unless(backpack_theme_config('layout') === 'vertical_transparent')
                                <div class="col-lg-6 mb-2">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="layout" value="vertical_transparent" class="form-selectgroup-input">
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
                            @endunless
                            @unless(backpack_theme_config('layout') === 'right_vertical')
                                <div class="col-lg-6 mb-2">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="layout" value="right_vertical" class="form-selectgroup-input">
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
                            @endunless
                            @unless(backpack_theme_config('layout') === 'right_vertical_dark')
                                <div class="col-lg-6 mb-2">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="layout" value="right_vertical_dark" class="form-selectgroup-input">
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
                            @endunless
                            @unless(backpack_theme_config('layout') === 'right_vertical_transparent')
                                <div class="col-lg-6 mb-2">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="layout" value="right_vertical_transparent" class="form-selectgroup-input">
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
                            @endunless
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button class="btn btn-primary" type="submit"><i class="la la-check me-2"></i>Apply layout</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection