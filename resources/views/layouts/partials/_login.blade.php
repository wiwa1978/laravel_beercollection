<div class="col col-login mx-auto">
        <form class="card" action="{{ route('login') }}" method="post" novalidate>
                @csrf
                <div class="card-body p-6">
                    <div class="card-title">@lang('Login to your account')</div>

                    <div class="form-group">
                        <label class="form-label" for="email">@lang('E-Mail Address')</label>
                        <input
                            type="email"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            name="email"
                            id="email"
                            aria-describedby="emailHelp"
                            placeholder="Enter email"
                            value="{{ old('email') }}"
                            required
                            autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            @lang('Password')
                            <a href="{{ route('password.request') }}" class="float-right small">
                                @lang('I forgot my password')
                            </a>
                        </label>
                        <input
                            type="password"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            name="password"
                            id="password"
                            placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input
                                type="checkbox"
                                class="custom-control-input"
                                name="remember"
                                {{ old('remember') ? 'checked' : '' }}/>
                            <span class="custom-control-label">@lang('Remember me')</span>
                        </label>
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-block">@lang('Sign in')</button>
                    </div>
                </div>
            </form>
    </div>
