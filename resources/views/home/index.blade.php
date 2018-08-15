@extends ('layouts.master')

@section ('content')


      <main role="main" class="inner cover">
        <h1 class="cover-heading">Welcome to FarmLab</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <p class="lead">
        @if (! Auth::check())	
          		<a href="/login" class="btn btn-lg btn-secondary">Log in</a>
        @elseif (auth()->user()->type === App\User::ADMIN)
              <a href="/farmlab/create" class="btn btn-lg btn-secondary">Admin dashboard</a>
        @elseif (auth()->user()->type === App\User::FARMLABMEMBER)
              <a href="/farmlab/create" class="btn btn-lg btn-secondary">Create a practice</a>
        @elseif (auth()->user()->type === App\User::PRACTICEADMIN)
              <a href="/practice/create" class="btn btn-lg btn-secondary">Add new vet</a>
        @elseif (auth()->user()->type === App\User::VET)
              <a href="/login" class="btn btn-lg btn-secondary">Create a practice</a>
        @endif      

        </p>
      </main>

@endsection