@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hello, {{ \Auth::user()->name }}</div>

                    <div class="card-body">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </div>
                    
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">Dashboard</div>


                    <div class="card-body text-center">
                        <a href="/practice/create/vet" class="btn btn-md btn-secondary">Add new vet</a>
                        <hr>
                        <a href="/labresults/index" class="btn btn-md btn-secondary">See results</a>
                    </div>
                    
            </div>
        </div>

    </div>
</div>

@endsection
