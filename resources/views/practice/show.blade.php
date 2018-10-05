@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body" id="card-div">
                        <table class="table text-center">
                            <tbody>
                                <tr>
                                    <th class="card-header text-center border-top-0"><h4>Id</h4></th>
                                    <th class="card-header text-center border-top-0"><h4>Practice name</h4></th>
                                    <th class="card-header text-center border-top-0"><h4>Created at</h4></th>
                                </tr>
                                <tr>
                                    <th class="text-capitalize border-bottom-1">{{ $practice->id }}</th>
                                    <th class="text-capitalize border-bottom-1">{{ $practice->name }}</th>
                                    <th class="text-capitalize border-bottom-1">{{ $practice->created_at }}</th>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
