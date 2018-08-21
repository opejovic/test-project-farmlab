@extends ('layouts.master')

@section ('content')

      <main role="main" class="inner cover">
        <h1 class="cover-heading">Welcome to FarmLab</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <p class="lead">
          
        @if (! Auth::check())	
          		<a href="/login" class="btn btn-lg btn-secondary">Log in</a>

        @elseif (auth()->user()->type === App\User::ADMIN)
              <a href="/farmlab/create" class="btn btn-lg btn-secondary">Add new lab member</a>

        @elseif (auth()->user()->type === App\User::FARMLABMEMBER)
              <a href="/farmlab/create" class="btn btn-lg btn-secondary">Create practice</a>
              <a href="/file/upload" class="btn btn-lg btn-secondary">Upload result</a>
              {{-- <a href="/labresults/process" class="btn btn-lg btn-secondary">Process the result</a> --}}

        @elseif (auth()->user()->type === App\User::PRACTICEADMIN)
              <a href="/practice/create/vet" class="btn btn-lg btn-secondary">Add new vet</a>
              <a href="/labresults/index" class="btn btn-lg btn-secondary">See results</a>

        @elseif (auth()->user()->type === App\User::VET)
              <a href="/labresults/index" class="btn btn-lg btn-secondary">See results</a> 
        @endif      
        </p>
      </main>

@endsection