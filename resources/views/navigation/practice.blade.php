<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="img-circle" src="/images/{{ auth()->id() }}.jpg" 
                        onerror="if (this.src != '/images/errorSmall.jpg') this.src = '/images/errorSmall.jpg';">  
                             
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{ auth()->user()->name }}</strong>
                            </span> <span class="text-muted text-xs block">{{ __('Admin') }}<b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('members.show', auth()->id()) }}">{{ __('Profile') }}</a></li>
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
            
            <li class="{{ isActiveRoute('vets.index') }} {{ isActiveRoute('vets.create') }} {{ isActiveRoute('vets.show') }}">
                <a href="index.html"><i class="fa fa-ambulance"></i> <span class="nav-label">Vets</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="{{ isActiveRoute('vets.index') }} {{ isActiveRoute('vets.show') }}"><a href="{{ route('vets.index') }}">Show all</a></li>
                    <li class="{{ isActiveRoute('vets.create') }}"><a href="{{ route('vets.create') }}">Add new</a></li>
                </ul>
            </li>            

            <li class="{{ isActiveRoute('labresults.index') }} {{ isActiveRoute('labresults.create') }}">
                <a href="{{ route('labresults.index') }}"><i class="fa fa-th"></i> <span class="nav-label">Results</span></a>
            </li>
        </ul>

    </div>
</nav>