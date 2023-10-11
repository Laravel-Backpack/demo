<h2 class="h2 text-center my-4">{{ trans('backpack::base.login') }}</h2>
<form method="POST" action="{{ route('backpack.auth.login') }}" autocomplete="off" novalidate="">
    @csrf
    <div class="mb-3">
        <label class="form-label" for="{{ $username }}">{{ config('backpack.base.authentication_column_name') }}</label>
        <input autofocus tabindex="1" type="email" name="{{ $username }}" value="{{ old($username, 'admin@example.com') }}" id="{{ $username }}" class="form-control {{ $errors->has($username) ? 'is-invalid' : '' }}">
        @if ($errors->has($username))
            <div class="invalid-feedback">{{ $errors->first($username) }}</div>
        @endif
    </div>
    <div class="mb-2">
        <label class="form-label" for="password">
            {{ trans('backpack::base.password') }}
        </label>
        <input tabindex="2" type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" value="{{ old($username) ? '' : 'admin' }}">
        @if ($errors->has('password'))
            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
        @endif
    </div>
    <div class="d-flex justify-content-between align-items-center mb-2">
        <label class="form-check mb-0">
            <input name="remember" tabindex="3" type="checkbox" class="form-check-input">
            <span class="form-check-label">{{ trans('backpack::base.remember_me') }}</span>
        </label>
        @if (backpack_users_have_email())
            <div class="form-label-description">
                <a tabindex="4" href="{{ route('backpack.auth.password.reset') }}">{{ trans('backpack::base.forgot_your_password') }}</a>
            </div>
        @endif
    </div>
    <div class="form-footer">
        <button tabindex="5" type="submit" class="btn btn-primary w-100">{{ trans('backpack::base.login') }}</button>
    </div>
</form>