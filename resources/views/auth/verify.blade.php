@extends('layouts.auth')

@section('pageTitle', 'Verify E-mail')

@section('content')

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">FL+</h1>

        </div>
        <h3>Welcome to FARMLAB</h3>

        <div>
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }}, 
            <a class="btn btn-primary" type="submit" href="{{ route('verification.resend') }}">{{ __('click here to request another') }}
            </a>
        </div>
        <p class="m-t"> <small>FarmLab+ all rights reserved.</small> </p>
    </div>
</div>
@endsection

