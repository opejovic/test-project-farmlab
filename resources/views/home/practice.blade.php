@extends('layouts.app')

@section('navigation')
@section('navigation')
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="img-circle" src="images/{{ $user->name }}.jpg" />
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">            
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{ $user->name }}</strong>
                            </span> <span class="text-muted text-xs block">{{ __('Practice admin') }}<b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="#">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    FL+
                </div>
            </li>
        </ul>

    </div>
</nav>

@endsection
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hello, {{ auth()->user()->name }}</div>

                    <div class="card-body">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </div>
                    
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">Dashboard</div>


                    <div class="card-body text-center">
                        <a href="{{ route('vets.create') }}" class="btn btn-md btn-secondary">Add new vet</a><hr>
                        <a href="{{ route('vets.index') }}" class="btn btn-md btn-secondary">See vets</a><hr>
                        <a href="{{ route('labresults.index') }}" class="btn btn-md btn-secondary">See results</a>
                    </div>
                    
            </div>
        </div>

    </div>
</div>

@endsection
