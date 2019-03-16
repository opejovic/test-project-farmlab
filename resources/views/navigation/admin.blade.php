                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('members.show', auth()->user()->hash_id) }}">{{ __('Profile') }}</a></li>
                        <li><a href="#">{{ __('Contact') }}</a></li>
                        <li><a href="#">{{ __('Mailbox') }}</a></li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}" 
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Log out') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">
                    FL+
                </div>
            </li>
    <li class="{{ isActiveRoute('home')}}">
        <a href="{{ route('home') }}"><i class="fa fa-th-large"></i> <span class="nav-label">{{ __('Home') }}</span></a>
    </li>

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
