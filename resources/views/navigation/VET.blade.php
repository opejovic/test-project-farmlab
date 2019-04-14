@component('navigation.components.top-left')
    @slot('route')
        <a href="{{ route('vets.show', auth()->user()->hash_id) }}">
            {{ __('Profile') }}
        </a>
    @endslot

    @slot('home')
        {{ __('My Results') }}
    @endslot
@endcomponent

<li class="{{ isActiveRoute('labresults.index') }} 
           {{ isActiveRoute('labresults.show') }}">
    <a href="{{ route('labresults.index') }}"><i class="fa fa-th"></i> 
        <span class="nav-label">{{ __('All Results') }}</span></a>
</li>
