@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add new vet</div>

                	<div class="card-body">
						<form method="POST" action="/practice/create/vet">
							@csrf
	                 
							<div class="form-group row">
								<label for="name" class="col-sm-4 col-form-label text-md-right">Username</label>
								<div class="col-md-6">
								<input name="name" type="text" class="form-control" id="name" required>
								</div>
							</div>

							<div class="form-group row">
								<label for="name" class="col-sm-4 col-form-label text-md-right">E-Mail Adress</label>
								<div class="col-md-6">
								<input name="email" type="email" class="form-control" id="email" required>
								</div>
							</div>	

							<div class="form-group row">
								<label for="name" class="col-sm-4 col-form-label text-md-right">Password</label>
								<div class="col-md-6">
								<input name="password" type="password" class="form-control" id="password" required>
								</div>
							</div>	

							<div class="form-group row">
								<label for="name" class="col-sm-4 col-form-label text-md-right">Password confirmation</label>
								<div class="col-md-6">
								<input name="password_confirmation" type="password" class="form-control" id="password_confirmation" required>
								</div>
							</div>	

	                        <div class="form-group row mb-0">
	                            <div class="col-md-8 offset-md-4">
	                                <button type="submit" class="btn btn-primary">
	                                    Add vet
	                                </button>
	                        </div>


							@include ('layouts.errors')
						</form>
					</div>
   				</div>
            </div>
        </div>
    </div>

@endsection
