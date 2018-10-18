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
                                    <th class="card-header text-center border-top-0">Id</th>
                                    <th class="card-header text-center border-top-0">Practice name</th>
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
                        <table class="table table-hover text-center">
                            <tbody>
                                    <tr>
                                        <th class="card-header text-center border-top-0">Id</th>
                                        <th class="card-header text-center border-top-0">Name</th>
                                        <th class="card-header text-center border-top-0">Role</th>
                                    </tr>
                                @foreach ($vets as $vet)
                                    <tr>
                                        <td class="text-capitalize border-bottom-1">{{ $vet->id }}</td>
                                        <td class="text-capitalize border-bottom-1">{{ $vet->name }}</td>
                                        <td class="text-capitalize border-bottom-1">{{ $vet->type }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="card-footer">{{ $vets->links() }}</div>                  
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
