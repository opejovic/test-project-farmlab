@extends ('layouts.auth')

@section('pageTitle', 'Login')

@section ('content')

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">FL+</h1>

        </div>
        <h3>Welcome to FARMLAB</h3>
        <p> Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
        <p>Login in. To start browsing.</p>
        <form method="POST" class="m-t" role="form" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                 <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Username">

                 @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

             <div class="form-group">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

            <a href="{{ route('password.request') }}"><small>Forgot password?</small></a>
            <p class="text-muted text-center"><small>Do not have an account? Request one.</small></p>
            <a class="btn btn-sm btn-white btn-block" href="{{ route('password.request') }}">Request an account</a>
        </form>
        <p class="m-t"> <small>FarmLab+ all rights reserved.</small> </p>
    </div>
</div>

@endsection