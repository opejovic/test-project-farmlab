@extends ('layouts.app')

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
        <p>Login, to start browsing.</p>
        <form method="POST" class="m-t" role="form" action="{{ route('login') }}">
            @csrf
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                 <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Username">

                 @if ($errors->has('email'))
                    <label class="control-label">
                        <strong>{{ $errors->first('email') }}</strong>
                    </label>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" name="password" required placeholder="Password">

                @if ($errors->has('password'))
                    <label class="control-label">
                        <strong>{{ $errors->first('password') }}</strong>
                    </label>
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