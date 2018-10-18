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
                                    <td class="card-header text-center border-top-0">Id</td>
                                    <td class="card-header text-center border-top-0">Vet name</td>
                                    <td class="card-header text-center border-top-0">Created at</td>
                                    <td class="card-header text-center border-top-0">Status</td>
                                </tr>
                                @foreach ($vets as $vet)
                                <tr>
                                    <td class="text-capitalize border-bottom-1">{{ $vet->id }}</td>
                                    <td class="text-capitalize border-bottom-1">
                                        <a href="{{ route('vets.show', $vet->id)  }}">{{ $vet->name }}</a>
                                    </td>
                                    <td class="text-capitalize border-bottom-1">{{ $vet->created_at }}</td>
                                    <td class="text-capitalize border-bottom-1">{{ $vet->status }}</td>
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
