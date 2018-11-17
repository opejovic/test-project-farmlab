<li class="{{ isActiveRoute('home')}}">
    <a href="{{ route('home') }}"><i class="fa fa-th-large"></i> 
        <span class="nav-label">{{ __('My Results') }}</span></a>
</li>

<li class="{{ isActiveRoute('labresults.index') }} 
           {{ isActiveRoute('labresults.show') }}">
    <a href="{{ route('labresults.index') }}"><i class="fa fa-th"></i> 
        <span class="nav-label">{{ __('All Results') }}</span></a>
</li>
