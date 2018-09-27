@component('mail::message')
# Hello, {{ $newUser->name }}

Welcome to FarmLab

Your username is: {{ $newUser->email }}

@component('mail::button', ['url' => ''])
    Create a password
@endcomponent

@component('mail::panel', ['url' => ''])
    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
