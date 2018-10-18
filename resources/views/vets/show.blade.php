@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body" id="card-div">
                        <table class="table text-center">
                            <tbody>
                                <tr>
                                    <th class="card-header text-center border-top-0">Id</th>
                                    <th class="card-header text-center border-top-0">Vet name</th>
                                    <th class="card-header text-center border-top-0">Created at</th>
                                    <th class="card-header text-center border-top-0">Status</th>
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
                  <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Results belonging to {{ $vet->name }}</div>

                    <table class="table table-hover table-sm">
                        <thead class="thead-labresult">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date of test</th>
                            <th scope="col">Test name</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>

                        @foreach ($results as $result)
                            <tbody>

                            <tr>
                                <th scope="row">
                                    <a href="{{ route('labresults.show', $result->id) }}">{{ $result->id }}</a>
                                </th>
                                <td>{{ $result->date_of_test}}</td>
                                <td>{{ $result->test_name}}</td>
                                <td>
                                    <a href="{{ route('labresults.show', $result->id) }}">{{ $result->status }}</a>
                                </td>
                            </tr>

                            </tbody>
                        @endforeach

                    </table>
                    <div class="card-footer">{{ $results->links() }}</div>
                </div>
            </div>

        </div>
    </div>
@endsection
