@if ($flash = session('message'))
    <div id="flash-message" class="alert alert-secondary" role="alert">
        {{ $flash }}
    </div>
@endif 