@component('mail::message')
# Hello

Welcome to FarmLab

@component('mail::button', ['url' => ''])
Start browsing
@endcomponent

@component('mail::panel', ['url' => ''])
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
