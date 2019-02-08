@component('mail::message')
# Hello, {{ $newUser->name }}

Welcome to FarmLab

Your username is: {{ $newUser->email }}

@component('mail::button', ['url' => "http://127.0.0.1:8000/password/reset/{$token}"])
    Create a password
@endcomponent

@component('mail::panel', ['url' => ''])
    In order to use the application, you need to choose your password. This link will be valid for only 60 minutes. After that, you will have to request a new password reset on the homepage.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
