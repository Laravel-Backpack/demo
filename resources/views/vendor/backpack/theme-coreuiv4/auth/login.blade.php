{{-- BACKPACK DEMO FILE --}}
{{-- It makes sure the login inputs are pre-populated with the default admin user. --}}
@extends(backpack_view('layouts.plain'))

@section('content')
<div class="row justify-content-center align-items-center d-flex flex-row min-vh-100">
    <div class="col-12 col-md-6 col-lg-4">
        <h3 class="text-center mb-4">{{ trans('backpack::base.login') }}</h3>
        <div class="card p-2">
            <div class="card-body">
                <form class="col-md-12 p-t-10" role="form" method="POST" action="{{ route('backpack.auth.login') }}">
                    {!! csrf_field() !!}

                    <div class="form-group mb-2">
                        <label class="control-label" for="{{ $username }}">{{
                            config('backpack.base.authentication_column_name') }}</label>

                        <div>
                            <input type="text" class="form-control{{ $errors->has($username) ? ' is-invalid' : '' }}"
                                name="{{ $username }}" value="{{ old($username) ?? 'admin@example.com' }}"
                                id="{{ $username }}">

                            @if ($errors->has($username))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first($username) }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-2">
                        <label class="control-label" for="password">{{ trans('backpack::base.password') }}</label>

                        <div>
                            <input type="password"
                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                id="password" value="{{ old('username')?'':'admin' }}">

                            @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-2">
                        <div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> {{ trans('backpack::base.remember_me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3 mb-0">
                        <div>
                            <button type="submit" class="btn btn-block btn-primary">
                                {{ trans('backpack::base.login') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if (backpack_users_have_email())
        <div class="text-center mt-2"><a href="{{ route('backpack.auth.password.reset') }}">{{
                trans('backpack::base.forgot_your_password') }}</a></div>
        @endif
        @if (config('backpack.base.registration_open'))
        <div class="text-center"><a href="{{ route('backpack.auth.register') }}">{{ trans('backpack::base.register')
                }}</a></div>
        @endif
    </div>
</div>
@endsection
