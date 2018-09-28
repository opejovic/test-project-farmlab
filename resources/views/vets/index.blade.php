@extends('layouts.master')

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
                                    <th class="card-header text-center border-top-0"><h4>Vet name</h4></th>
                                    <th class="card-header text-center border-top-0"><h4>Created at</h4></th>
                                    <th class="card-header text-center border-top-0"><h4>Status</h4></th>
                                </tr>
                                @foreach ($vets as $vet)
                                <tr>
                                    <th class="text-capitalize border-bottom-1">{{ $vet->id }}</th>
                                    <th class="text-capitalize border-bottom-1">
                                        <a href="{{ route('vet.show', $vet->id)  }}">{{ $vet->name }}</a>
                                    </th>
                                    <th class="text-capitalize border-bottom-1">{{ $vet->created_at }}</a></th>
                                    <th class="text-capitalize border-bottom-1">{{ $vet->status }}</a></th>
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
