@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add new practice</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('practice.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label text-md-right">Practice name</label>
                                <div class="col-md-6">
                                    <input name="name" type="text" class="form-control" id="name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="admin_name" class="col-sm-4 col-form-label text-md-right">Practice admin
                                    name</label>
                                <div class="col-md-6">
                                    <input name="admin_name" type="text" class="form-control" id="admin_name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">Practice admin
                                    email</label>
                                <div class="col-md-6">
                                    <input name="email" type="email" class="form-control" id="email" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input name="password" type="password" class="form-control" id="password" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password_confirmation" class="col-sm-4 col-form-label text-md-right">Password
                                    confirmation</label>
                                <div class="col-md-6">
                                    <input name="password_confirmation" type="password" class="form-control"
                                           id="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add practice
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            @include ('layouts.errors')
        </div>
@endsection
