                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('vets.show', auth()->id()) }}">{{ __('Profile') }}</a></li>
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
    <a href="{{ route('home') }}"><i class="fa fa-th-large"></i> 
        <span class="nav-label">{{ __('My Results') }}</span></a>
</li>

<li class="{{ isActiveRoute('labresults.index') }} 
           {{ isActiveRoute('labresults.show') }}">
    <a href="{{ route('labresults.index') }}"><i class="fa fa-th"></i> 
        <span class="nav-label">{{ __('All Results') }}</span></a>
</li>
