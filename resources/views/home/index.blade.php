@extends ('layouts.master')

@section ('content')

@if (! Auth::check())
      <main role="main" class="inner cover">
        <h1 class="cover-heading">Welcome to FarmLab</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <p class="lead">
        	
          		<a href="/login" class="btn btn-lg btn-secondary">Log in</a>

        </p>
      </main>

@elseif (auth()->user()->type == 'ADMIN')
      <main role="main" class="inner cover">
        <h1 class="cover-heading">Admin dashboard</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <p class="lead">
        	
          		<a href="/farmlab/dashboard" class="btn btn-lg btn-secondary">Admin dashboard</a>

        </p>
      </main>

@elseif (auth()->user()->type == 'FARM_LAB_TEAM_MEMBER')
      <main role="main" class="inner cover">
        <h1 class="cover-heading">FL Team member dashboard</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <p class="lead">
        	
          		<a href="/farmlab/dashboard" class="btn btn-lg btn-secondary">Create a practice</a>

        </p>
      </main>

@elseif (auth()->user()->type == 'PRACTICE_ADMIN')
      <main role="main" class="inner cover">
        <h1 class="cover-heading">Practice Admin dashboard</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <p class="lead">
        	
          		<a href="/login" class="btn btn-lg btn-secondary">Add new vet</a>

        </p>
      </main>

@elseif (auth()->user()->type == 'PRACTICE_VET')
      <main role="main" class="inner cover">
        <h1 class="cover-heading">Practice Vet dashboard</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <p class="lead">
        	
          		<a href="/login" class="btn btn-lg btn-secondary">Create a practice</a>

        </p>
      </main>

@endif
@endsection