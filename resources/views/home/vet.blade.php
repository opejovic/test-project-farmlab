{{-- tmp --}}

@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hello, {{ \Auth::user()->name }}</div>

                     <div class="card-body">
                            <a href="/labresults/index" class="btn btn-md btn-secondary">See results</a>
                      </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
