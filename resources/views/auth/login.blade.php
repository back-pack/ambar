@extends('layouts.master')

@section('title')
    <title>Login</title>
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="patterns">
                <div class="contain_pat">
                  <css-doodle grid="3" #4>
                    background: @p(#FFF4E0, #d2565e, #4402a4, #e5937b, #bb6a93);
                    :after {
                      content: '';
                      @size: 100%;
                      position: absolute;
                      background:
                        @m(4, radial-gradient(
                          circle at @p(-40% -40%, 140% 140%, 140%  -40%, -40% 140%),
                          @p(#FFF4E0, #d2565e, #4402a4, #e5937b, #bb6a93) 50%,
                          transparent 50%
                        )),
                        radial-gradient(
                          @p(#FFF4E0, #d2565e, #4402a4, #e5937b, #bb6a93) @r(10%, 40%),
                          transparent 0
                        )
                    }
                  </css-doodle>
                </div>
                <h2 style="font-size: 3.1rem;line-height: 1;font-weight: 100;font-style: normal; padding: .75rem 1.25rem;">Ambar</h2>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
