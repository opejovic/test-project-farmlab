@extends('layouts.master')

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
                        <a href="{{ route('practice.create') }}" class="btn btn-md btn-secondary">Create new practice</a>
                           <hr>
                        <a href="{{ route('file.create') }}" class="btn btn-md btn-secondary">Upload new result</a>
                    </div>
                </div>
<br>
          <div class="card">
                <div class="card-header text-center">Your activity</div>
                    <div class="card-body text-center">
                        Lorem ipsum.
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
