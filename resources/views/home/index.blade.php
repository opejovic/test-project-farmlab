@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome to FarmLab</div>

                    @if (! Auth::check())
                      <div class="card-body">
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                      </div>

                    @elseif (auth()->user()->type === App\User::ADMIN)
                      <div class="card-body">
                            <a href="/farmlab/create" class="btn btn-md btn-secondary">Add new lab member</a>
                      </div>

                    @elseif (auth()->user()->type === App\User::FARMLABMEMBER)
                      <div class="card-body">
    
                            <a href="/farmlab/create" class="btn btn-md btn-secondary">Create practice</a>
                            <a href="/file/upload" class="btn btn-md btn-secondary">Upload result</a>
                        
                          {{-- <a href="/labresults/process" class="btn btn-md btn-secondary">Process the result</a> --}}
       
                      </div>
                    @elseif (auth()->user()->type === App\User::PRACTICEADMIN)
                      <div class="card-body">
                            <a href="/practice/create/vet" class="btn btn-md btn-secondary">Add new vet</a>
                            <a href="/labresults/index" class="btn btn-md btn-secondary">See results</a>
                      </div>

                    @elseif (auth()->user()->type === App\User::VET)
                     <div class="card-body">
                            <a href="/labresults/index" class="btn btn-md btn-secondary">See results</a>
                      </div>
                    @endif                

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
