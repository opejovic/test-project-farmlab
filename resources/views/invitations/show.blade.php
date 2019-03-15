@extends('layouts.app')

@section('pageTitle', 'Choose your password')

@section('content')

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">FL+</h1>

        </div>
            <h2>You have been invited to join FarmLab.</h2>
        <div>
            <br>
        </div>
            <h3>Please verify your email address and choose your password.</h3>
        <div>

        <form method="POST" class="m-t" role="form" action="{{ route('auth.verify') }}">
            @csrf
            <input type="hidden" name="invitation_code" value="{{ $invitation->code }}">

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" name="password" required placeholder="Password">

                @if ($errors->has('password'))
                    <label class="control-label">
                        <strong>{{ $errors->first('password') }}</strong>
                    </label>
                @endif
            </div>

            <div class="form-group">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
            </div>

           <div class="form-group">
                <button type="submit" class="btn btn-primary block full-width m-b">Verify</button>
            </div>
        </div>

    </form>

        <p class="m-t"> <small>FarmLab+ all rights reserved.</small> </p>
    </div>
</div>
@endsection

