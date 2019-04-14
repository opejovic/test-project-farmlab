<ul class="dropdown-menu animated fadeInRight m-t-xs">
    <li>
        {{ $route }}
    </li>
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

<li class="{{ isActiveRoute('home')}}">
    <a href="{{ route('home') }}"><i class="fa fa-th-large"></i> <span class="nav-label">{{ $home }}</span></a>
</li>
