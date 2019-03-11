@extends('layouts.app')

@section ('pageTitle')
    Home
@endsection

@section('content')
	<div class="col-lg-14">
	    <div class="ibox-content">

	        <div class="row">
	            <div class="col-md-6 text-center">
	                <h1 class="no-margins">{{ $user->practice->results->reject->isProcessed()->count() }}</h1>
	                <div class="font-bold text-warning"><small>Unprocessed results</small></div>
	            </div>
	            <div class="col-md-6 text-center">
	                <h1 class="no-margins"></h1>
	                <h1 class="no-margins">{{ $user->practice->results->filter->isProcessed()->count() }}</h1>
	                <div class="font-bold text-navy"><small>Processed results</small></div>
	            </div>
	        </div>

	    </div>
	</div>
@endsection
