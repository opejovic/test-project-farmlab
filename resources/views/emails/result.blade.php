@component('mail::message')
# Hello, {{ $vet->name }}

New lab result for the farmer {{ $labresult->farmer_name }} has just been uploaded.

Check it out.

@component('mail::button', ['url' => "http://127.0.0.1:8000/practices/{$vet->practice_id}/labresults/{$labresult->hash_id}"])
    {{ $labresult->hash_id }}
@endcomponent

@component('mail::panel', ['url' => ''])
    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
