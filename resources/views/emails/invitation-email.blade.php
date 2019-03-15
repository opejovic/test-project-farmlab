@component('mail::message')
# Hello,

You are invited to join FarmLab.

Your username is: {{ $invitation->email }}.

Please create your password at the link below.

@component('mail::button', ['url' => "http://127.0.0.1:8000/invitations/{$invitation->code}"])
    Create your password
@endcomponent

@component('mail::panel', ['url' => ''])
    In order to use the application, you need to create your password. This link will be valid for only one time. If you forget your password, you will have to request a password reset on the homepage.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent