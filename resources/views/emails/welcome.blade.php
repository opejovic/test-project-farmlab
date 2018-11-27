@component('mail::message')
# Hello, {{ $newUser->name }}

Welcome to FarmLab

Your username is: {{ $newUser->email }}

@component('mail::button', ['url' => "http://127.0.0.1:8000/password/reset/{$token}"])
    Create a password
@endcomponent

@component('mail::panel', ['url' => ''])
    In order to use the application, you need to choose your password.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
