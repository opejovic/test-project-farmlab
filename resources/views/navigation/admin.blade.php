<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="img-circle" src="/images/{{ auth()->user()->name }}.jpg" />
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{ auth()->user()->name }}</strong>
                            </span> <span class="text-muted text-xs block">{{ ucfirst(strtolower(auth()->user()->type)) }}<b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Mailbox</a></li>
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
            <li class="{{ isActiveRoute('members.index') }} {{ isActiveRoute('members.create') }}">
                <a href=""><i class="fa fa-flask"></i> <span class="nav-label">Team</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="{{ isActiveRoute('members.index') }}"><a href="{{ route('members.index') }}">Members</a></li>
                    <li class="{{ isActiveRoute('members.create') }}"><a href="{{ route('members.create')}}">Add new</a></li>
                    <li><a href="dashboard_3.html">Dashboard v.3</a></li>
                    <li><a href="dashboard_5.html">Dashboard v.5 </a></li>
                </ul>
            </li>             
            
            <li class="{{ isActiveRoute('practice.index') }} {{ isActiveRoute('practice.create') }}">
                <a href="index.html"><i class="fa fa-user-md"></i> <span class="nav-label">Vets</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="{{ isActiveRoute('practice.index') }}"><a href="{{ route('practice.index') }}">Practices</a></li>
                    <li class="{{ isActiveRoute('practice.create') }}"><a href="{{ route('practice.create') }}">Add new</a></li>
                    <li><a href="dashboard_3.html">Dashboard v.3</a></li>
                    <li><a href="dashboard_5.html">Dashboard v.5 </a></li>
                </ul>
            </li>            

            <li>
                <a href="index.html"><i class="fa fa-table"></i> <span class="nav-label">Results</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="active"><a href="{{ route('members.index') }}">Practices</a></li>
                    <li><a href="dashboard_2.html">Upload</a></li>
                    <li><a href="dashboard_3.html">Dashboard v.3</a></li>
                    <li><a href="dashboard_5.html">Dashboard v.5 </a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>