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

<li class="{{ isActiveRoute('members.index') }} 
           {{ isActiveRoute('members.create') }} 
           {{ isActiveRoute('members.show') }}">
    <a href=""><i class="fa fa-flask"></i> <span class="nav-label">{{ __('Team') }}</span>
        <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li class="{{ isActiveRoute('members.index') }} {{ isActiveRoute('members.show') }}">
            <a href="{{ route('members.index') }}">{{ __('Members') }}</a>
        </li>
        <li class="{{ isActiveRoute('members.create') }}">
            <a href="{{ route('members.create')}}">{{ __('Add new') }}</a>
        </li>
    </ul>
</li>             

<li class="{{ isActiveroute('practices.index') }} 
           {{ isActiveroute('practices.create') }} 
           {{ isActiveroute('practices.show') }} 
           {{ isActiveRoute('vets.show') }}">
    <a href="index.html"><i class="fa fa-ambulance"></i> <span class="nav-label">{{ __('Practices') }}</span> <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li class="{{ isActiveroute('practices.index') }} {{ isActiveroute('practices.show') }}">
            <a href="{{ route('practices.index') }}">{{ __('Show All') }}</a>
        </li>
        <li class="{{ isActiveroute('practices.create') }}">
            <a href="{{ route('practices.create') }}">{{ __('Add new') }}</a>
        </li>
    </ul>
</li>            

<li class="{{ isActiveRoute('files.index') }} {{ isActiveRoute('files.create') }}">
    <a href="{{ route('files.index') }}"><i class="fa fa-file"></i> <span class="nav-label">{{ __('Files') }}</span></a>
</li>
