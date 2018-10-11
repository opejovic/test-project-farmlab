@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body" id="card-div">
                        <table class="table text-center">
                            <tbody>
                                <tr>
                                    <th class="card-header text-center border-top-0"><h4>Id</h4></th>
                                    <th class="card-header text-center border-top-0"><h4>Practice name</h4></th>
                                </tr>
                                <tr>
                                    <th class="text-capitalize border-bottom-1">{{ $practice->id }}</th>
                                    <th class="text-capitalize border-bottom-1">{{ $practice->name }}</th>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body" id="card-div">
                        <table class="table text-center">
                            <tbody>
                                    <tr>
                                        <th class="card-header text-center border-top-0"><h4>Id</h4></th>
                                        <th class="card-header text-center border-top-0"><h4>Name</h4></th>
                                        <th class="card-header text-center border-top-0"><h4>Role</h4></th>
                                    </tr>
                                @foreach ($practice->vets as $vet)
                                    <tr>
                                        <th class="text-capitalize border-bottom-1">{{ $vet->id }}</th>
                                        <th class="text-capitalize border-bottom-1">{{ $vet->name }}</th>
                                        <th class="text-capitalize border-bottom-1">{{ $vet->type }}</th>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>                              
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
