@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lab Results</div>

                    <table class="table table-hover table-sm">
                        <thead class="thead-labresult">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date of test</th>
                            <th scope="col">Test name</th>
                            <th scope="col">

                                <div class="dropdown">
                                    <div class="btn dropdown-toggle" type="button" id="dropdownMenu2"
                                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Farmer Name
                                    </div>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach ($resultsByStatus as $result)
                                            <a class="dropdown-item"
                                               href="{{ route('labresults.index') }}">{{ $result->farmer_name }}</a>
                                        @endforeach
                                    </div>
                                </div>

                            </th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>

                        @foreach ($resultsByStatus as $result)
                            <tbody>

                            <tr>
                                <th scope="row">
                                    <a href="{{ route('labresults.show', $result->id) }}">{{ $result->id }}</a>
                                </th>
                                <td>{{ $result->date_of_test}}</td>
                                <td>{{ $result->test_name}}</td>
                                <td>{{ $result->farmer_name}}</td>
                                <td>
                                    <a href="{{ route('labresults.show', $result->id) }}">{{ $result->status }}</a>
                                </td>
                            </tr>

                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">Dashboard</div>


                    <div class="card-body text-center">
                        <a href="{{ route('labresults.index') }}" class="btn btn-md btn-secondary">See results</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
