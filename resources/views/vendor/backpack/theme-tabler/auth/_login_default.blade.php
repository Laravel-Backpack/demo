{{-- BACKPACK DEMO FILE --}}
{{-- It makes sure the login inputs are pre-populated with the default admin user. --}}
@extends(backpack_view('layouts.auth'))

@section('content')
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4 display-6">
                {!! backpack_theme_config('project_logo') !!}
            </div>
            <div class="card card-md">
                <div class="pt-3 pe-3 d-flex justify-content-end w-100">
                    <a href="javascript:void(0);" onclick="colorMode.switch()" class="nav-link px-0 hide-theme-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Enable dark mode" data-bs-original-title="Enable dark mode">
                        <i class="la la-sun fs-2"></i>
                    </a>
                    <a href="javascript:void(0);" onclick="colorMode.switch()" class="nav-link px-0 hide-theme-light" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Enable light mode" data-bs-original-title="Enable light mode">
                        <i class="la la-moon fs-2"></i>
                    </a>
                </div>
                <div class="card-body pt-0">
                    <h2 class="h2 text-center mb-4">{{ trans('backpack::base.login') }}</h2>
                    <form method="POST" action="{{ route('backpack.auth.login') }}" autocomplete="off" novalidate="">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="{{ $username }}">{{ config('backpack.base.authentication_column_name') }}</label>
                            <input autofocus type="email" name="{{ $username }}" value="{{ old($username, 'admin@example.com') }}" id="{{ $username }}" class="form-control {{ $errors->has($username) ? 'is-invalid' : '' }}">
                            @if ($errors->has($username))
                                <div class="invalid-feedback">{{ $errors->first($username) }}</div>
                            @endif
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="password">
                                {{ trans('backpack::base.password') }}
                                @if (backpack_users_have_email())
                                    <div class="form-label-description">
                                        <a href="{{ route('backpack.auth.password.reset') }}">{{ trans('backpack::base.forgot_your_password') }}</a>
                                    </div>
                                @endif
                            </label>
                            <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" value="{{ old($username) ? '' : 'admin' }}">
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="mb-2">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input">
                                <span class="form-check-label">{{ trans('backpack::base.remember_me') }}</span>
                            </label>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">{{ trans('backpack::base.login') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            @if (config('backpack.base.registration_open'))
                <div class="text-center text-muted mt-3">
                    <a href="{{ route('backpack.auth.register') }}" tabindex="-1">{{ trans('backpack::base.register') }}</a>
                </div>
            @endif
        </div>
    </div>
@endsection