      <header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand"><strong>FarmLab</strong></h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link active" href="/home">Home</a>
            <a class="nav-link" href="#">Projects</a>
            <a class="nav-link" href="#">Contact</a>
            @if (Auth::check())
            
              <a class="nav-link" href="#">{{ Auth::user()->name }}</a>
              <a class="nav-link" href="/logout">Log out</a> 

            @endif
          </nav> 
        </div>
      </header>