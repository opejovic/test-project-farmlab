<li class="{{ isActiveRoute('home')}}">
    <a href="{{ route('home') }}"><i class="fa fa-th-large"></i> <span class="nav-label">{{ __('Home') }}</span></a>
</li>

<li class="{{ isActiveRoute('vets.index') }} {{ isActiveRoute('vets.create') }} {{ isActiveRoute('vets.show') }}">
    <a href="index.html"><i class="fa fa-ambulance"></i> <span class="nav-label">Vets</span> <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li class="{{ isActiveRoute('vets.index') }} {{ isActiveRoute('vets.show') }}"><a href="{{ route('vets.index') }}">Show all</a></li>
        <li class="{{ isActiveRoute('vets.create') }}"><a href="{{ route('vets.create') }}">Add new</a></li>
    </ul>
</li>            

<li class="{{ isActiveRoute('labresults.index') }} {{ isActiveRoute('labresults.show') }}">
    <a href="{{ route('labresults.index') }}"><i class="fa fa-th"></i> <span class="nav-label">Results</span></a>
</li>
