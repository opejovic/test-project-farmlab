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
                            </span> <span class="text-muted text-xs block">{{ auth()->user()->formatted_type }}<b class="caret"></b></span>
                        </span>
                    </a>

                @if (auth()->user()->type === \App\Models\User::ADMIN)
                    @include('navigation.admin')
                @elseif (auth()->user()->type === \App\Models\User::FARM_LAB_MEMBER)
                    @include('navigation.labmember')
                @elseif (auth()->user()->type === \App\Models\User::PRACTICE_ADMIN)
                    @include('navigation.practice')
                @elseif (auth()->user()->type === \App\Models\User::VET)
                    @include('navigation.vet')
                @endif
        </ul>

    </div>
</nav>