<li class="nav-item me-2">
    <button class="btn-link nav-link px-0 shadow-none" data-bs-toggle="modal" data-bs-target="#modal-layout" title="Switch themes and layouts">
        <i class="la la-swatchbook fs-2 me-1 text-secondary"></i>
    </button>
</li>

@include('backpack.language-switcher::language-switcher')

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
                        <p>Choose from the available <strong>Backpack</strong> themes:</p>
                        @csrf
                        <div class="row mb-4">
                            <div class="col-lg-4 mb-3">
                                <label class="form-selectgroup-item cursor-pointer">
                                    <input @if(config('backpack.ui.view_namespace') === 'backpack.theme-tabler::') checked @endif type="radio" name="theme" value="tabler" class="form-selectgroup-input theme-choice">
                                    <div class="form-selectgroup-label p-0 border rounded">
                                        <div class="position-relative">
                                            <img src="{{ asset('screenshots/theme-tabler.jpg') }}" class="img-fluid rounded-top" alt="Tabler Theme" style="height: 120px; width: 100%; object-fit: cover;">
                                            <div class="position-absolute top-0 end-0 p-2">
                                                <span class="form-selectgroup-check bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 20px; height: 20px; font-size: 12px;"></span>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            <div class="form-selectgroup-title fw-bold mb-1">Tabler</div>
                                            <small class="text-muted">Bootstrap 5 • Default</small>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label class="form-selectgroup-item cursor-pointer">
                                    <input @if(config('backpack.ui.view_namespace') === 'backpack.theme-coreuiv4::') checked @endif type="radio" name="theme" value="coreuiv4" class="form-selectgroup-input theme-choice">
                                    <div class="form-selectgroup-label p-0 border rounded">
                                        <div class="position-relative">
                                            <img src="{{ asset('screenshots/theme-coreuiv4.jpg') }}" class="img-fluid rounded-top" alt="CoreUI v4 Theme" style="height: 120px; width: 100%; object-fit: cover;">
                                            <div class="position-absolute top-0 end-0 p-2">
                                                <span class="form-selectgroup-check bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 20px; height: 20px; font-size: 12px;"></span>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            <div class="form-selectgroup-title fw-bold mb-1">Core UI v4</div>
                                            <small class="text-muted">Bootstrap 5 • Legacy</small>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label class="form-selectgroup-item cursor-pointer">
                                    <input @if(config('backpack.ui.view_namespace') === 'backpack.theme-coreuiv2::') checked @endif type="radio" name="theme" value="coreuiv2" class="form-selectgroup-input theme-choice">
                                    <div class="form-selectgroup-label p-0 border rounded">
                                        <div class="position-relative">
                                            <img src="{{ asset('screenshots/theme-coreuiv2.jpg') }}" class="img-fluid rounded-top" alt="CoreUI v2 Theme" style="height: 120px; width: 100%; object-fit: cover;">
                                            <div class="position-absolute top-0 end-0 p-2">
                                                <span class="form-selectgroup-check bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 20px; height: 20px; font-size: 12px;"></span>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            <div class="form-selectgroup-title fw-bold mb-1">Core UI v2</div>
                                            <small class="text-muted">Bootstrap 4 • Legacy</small>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div id="tabler-layouts-selection" class="mb-3">
                            <p>Tabler comes with a few layouts baked in - <strong>which layout would you like to use?</strong></p>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label class="form-selectgroup-item cursor-pointer">
                                        <input @if(backpack_theme_config('layout') === 'horizontal') checked @endif type="radio" name="layout" value="horizontal" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label p-0 border rounded">
                                            <div class="position-relative">
                                                <img src="{{ asset('screenshots/tabler_horizontal_layout.jpg') }}" class="img-fluid rounded-top" alt="Horizontal Layout" style="height: 120px; width: 100%; object-fit: cover;">
                                                <div class="position-absolute top-0 end-0 p-1">
                                                    <span class="form-selectgroup-check bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 16px; height: 16px; font-size: 10px;"></span>
                                                </div>
                                            </div>
                                            <div class="p-2">
                                                <div class="form-selectgroup-title fw-bold small">Horizontal</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label class="form-selectgroup-item cursor-pointer">
                                        <input @if(backpack_theme_config('layout') === 'horizontal_dark') checked @endif type="radio" name="layout" value="horizontal_dark" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label p-0 border rounded">
                                            <div class="position-relative">
                                                <img src="{{ asset('screenshots/tabler_horizontal_dark_layout.jpg') }}" class="img-fluid rounded-top" alt="Horizontal Dark Layout" style="height: 120px; width: 100%; object-fit: cover;">
                                                <div class="position-absolute top-0 end-0 p-1">
                                                    <span class="form-selectgroup-check bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 16px; height: 16px; font-size: 10px;"></span>
                                                </div>
                                            </div>
                                            <div class="p-2">
                                                <div class="form-selectgroup-title fw-bold small">Horizontal Dark</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label class="form-selectgroup-item cursor-pointer">
                                        <input @if(backpack_theme_config('layout') === 'horizontal_overlap') checked @endif type="radio" name="layout" value="horizontal_overlap" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label p-0 border rounded">
                                            <div class="position-relative">
                                                <img src="{{ asset('screenshots/tabler_horizontal_overlap_layout.jpg') }}" class="img-fluid rounded-top" alt="Horizontal Overlap Layout" style="height: 120px; width: 100%; object-fit: cover;">
                                                <div class="position-absolute top-0 end-0 p-1">
                                                    <span class="form-selectgroup-check bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 16px; height: 16px; font-size: 10px;"></span>
                                                </div>
                                            </div>
                                            <div class="p-2">
                                                <div class="form-selectgroup-title fw-bold small">Horizontal Overlap</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label class="form-selectgroup-item cursor-pointer">
                                        <input @if(backpack_theme_config('layout') === 'vertical') checked @endif type="radio" name="layout" value="vertical" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label p-0 border rounded">
                                            <div class="position-relative">
                                                <img src="{{ asset('screenshots/tabler_vertical_layout.jpg') }}" class="img-fluid rounded-top" alt="Vertical Layout" style="height: 120px; width: 100%; object-fit: cover;">
                                                <div class="position-absolute top-0 end-0 p-1">
                                                    <span class="form-selectgroup-check bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 16px; height: 16px; font-size: 10px;"></span>
                                                </div>
                                            </div>
                                            <div class="p-2">
                                                <div class="form-selectgroup-title fw-bold small">Vertical</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label class="form-selectgroup-item cursor-pointer">
                                        <input @if(backpack_theme_config('layout') === 'vertical_dark') checked @endif type="radio" name="layout" value="vertical_dark" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label p-0 border rounded">
                                            <div class="position-relative">
                                                <img src="{{ asset('screenshots/tabler_vertical_dark_layout.jpg') }}" class="img-fluid rounded-top" alt="Vertical Dark Layout" style="height: 120px; width: 100%; object-fit: cover;">
                                                <div class="position-absolute top-0 end-0 p-1">
                                                    <span class="form-selectgroup-check bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 16px; height: 16px; font-size: 10px;"></span>
                                                </div>
                                            </div>
                                            <div class="p-2">
                                                <div class="form-selectgroup-title fw-bold small">Vertical Dark</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label class="form-selectgroup-item cursor-pointer">
                                        <input @if(backpack_theme_config('layout') === 'vertical_transparent') checked @endif type="radio" name="layout" value="vertical_transparent" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label p-0 border rounded">
                                            <div class="position-relative">
                                                <img src="{{ asset('screenshots/tabler_vertical_transparent_layout.jpg') }}" class="img-fluid rounded-top" alt="Vertical Transparent Layout" style="height: 120px; width: 100%; object-fit: cover;">
                                                <div class="position-absolute top-0 end-0 p-1">
                                                    <span class="form-selectgroup-check bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 16px; height: 16px; font-size: 10px;"></span>
                                                </div>
                                            </div>
                                            <div class="p-2">
                                                <div class="form-selectgroup-title fw-bold small">Vertical Transparent</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label class="form-selectgroup-item cursor-pointer">
                                        <input @if(backpack_theme_config('layout') === 'right_vertical') checked @endif type="radio" name="layout" value="right_vertical" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label p-0 border rounded">
                                            <div class="position-relative">
                                                <img src="{{ asset('screenshots/tabler_right_vertical_layout.jpg') }}" class="img-fluid rounded-top" alt="Right Vertical Layout" style="height: 120px; width: 100%; object-fit: cover;">
                                                <div class="position-absolute top-0 end-0 p-1">
                                                    <span class="form-selectgroup-check bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 16px; height: 16px; font-size: 10px;"></span>
                                                </div>
                                            </div>
                                            <div class="p-2">
                                                <div class="form-selectgroup-title fw-bold small">Right Vertical</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label class="form-selectgroup-item cursor-pointer">
                                        <input @if(backpack_theme_config('layout') === 'right_vertical_dark') checked @endif type="radio" name="layout" value="right_vertical_dark" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label p-0 border rounded">
                                            <div class="position-relative">
                                                <img src="{{ asset('screenshots/tabler_right_vertical_dark_layout.jpg') }}" class="img-fluid rounded-top" alt="Right Vertical Dark Layout" style="height: 120px; width: 100%; object-fit: cover;">
                                                <div class="position-absolute top-0 end-0 p-1">
                                                    <span class="form-selectgroup-check bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 16px; height: 16px; font-size: 10px;"></span>
                                                </div>
                                            </div>
                                            <div class="p-2">
                                                <div class="form-selectgroup-title fw-bold small">Right Vertical Dark</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <label class="form-selectgroup-item cursor-pointer">
                                        <input @if(backpack_theme_config('layout') === 'right_vertical_transparent') checked @endif type="radio" name="layout" value="right_vertical_transparent" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label p-0 border rounded">
                                            <div class="position-relative">
                                                <img src="{{ asset('screenshots/tabler_right_vertical_transparent_layout.jpg') }}" class="img-fluid rounded-top" alt="Right Vertical Transparent Layout" style="height: 120px; width: 100%; object-fit: cover;">
                                                <div class="position-absolute top-0 end-0 p-1">
                                                    <span class="form-selectgroup-check bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 16px; height: 16px; font-size: 10px;"></span>
                                                </div>
                                            </div>
                                            <div class="p-2">
                                                <div class="form-selectgroup-title fw-bold small">Right Vertical Transparent</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
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

        // Hide layout selection initially if not using Tabler theme
        @if(config('backpack.ui.view_namespace') !== 'backpack.theme-tabler::')
        layoutSelection.hide();
        @endif

        // Handle theme selection changes
        $('.theme-choice').on('click', function () {
            const selectedTheme = $(this).val();

            if (selectedTheme === 'tabler') {
                layoutSelection.slideDown();
            } else {
                // Hide layout options for CoreUI themes (coreuiv2, coreuiv4)
                layoutSelection.slideUp();
            }
        });

        // Also handle the case when modal is opened - ensure correct initial state
        $('#modal-layout').on('shown.bs.modal', function () {
            const checkedTheme = $('.theme-choice:checked').val();
            if (checkedTheme === 'tabler') {
                layoutSelection.show();
            } else {
                layoutSelection.hide();
            }
        });
    </script>
@endsection
