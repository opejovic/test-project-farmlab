@component('navigation.components.top-left')
    @slot('route')
        <a href="{{ route('members.show', auth()->user()->hash_id) }}">
            {{ __('Profile') }}
        </a>
    @endslot

    @slot('home')
        {{ __('Home') }}
    @endslot
@endcomponent

<li class="{{ isActiveroute('practices.index') }} {{ isActiveroute('practices.create') }} {{ isActiveroute('practices.show') }} {{ isActiveRoute('vets.show') }}">
    <a href="index.html"><i class="fa fa-ambulance"></i> <span class="nav-label">{{ __('Vets') }}</span> <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li class="{{ isActiveroute('practices.index') }} {{ isActiveroute('practices.show') }}"><a href="{{ route('practices.index') }}">{{ __('Practices') }}</a></li>
        <li class="{{ isActiveroute('practices.create') }}"><a href="{{ route('practices.create') }}">{{ __('Add new') }}</a></li>
    </ul>
</li>            

<li class="{{ isActiveRoute('files.index') }} {{ isActiveRoute('files.create') }}">
    <a href="{{ route('files.index') }}"><i class="fa fa-file"></i> <span class="nav-label">{{ __('Files') }}</span></a>
</li>
