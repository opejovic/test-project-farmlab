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
                                    <th class="card-header text-center border-top-0"><h4>Vet name</h4></th>
                                    <th class="card-header text-center border-top-0"><h4>Created at</h4></th>
                                    <th class="card-header text-center border-top-0"><h4>Status</h4></th>
                                </tr>
                                <tr>
                                    <th class="text-capitalize border-bottom-1">{{ $vet->id }}</th>
                                    <th class="text-capitalize border-bottom-1">{{ $vet->name }}</th>
                                    <th class="text-capitalize border-bottom-1">{{ $vet->created_at }}</th>
                                    <th class="text-capitalize border-bottom-1">{{ $vet->status }}</th>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                       <form action="{{ route('vets.destroy', $vet->id) }}" method="POST">
                           @csrf
                           @method('DELETE')

                            <button type="submit" onclick="return confirm('Are you sure you want to remove this user?')" class="btn btn-danger">
                                Delete
                            </button>
                       </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
