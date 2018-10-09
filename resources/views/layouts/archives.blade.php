 <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Browse lab results
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="{{ route('labresults.index') }}">All results</a>
      <a class="dropdown-item" href="/labresults?by={{ Auth::user()->name }}">My results</a> 
    </div>
</li>