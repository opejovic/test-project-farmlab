@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            @if ($resultsByStatus->where('status', 'UNPROCESSED')->count() > 0)
                <h5>You have {{ $resultsByStatus->where('status', 'UNPROCESSED')->count() }} unprocessed results</h5>
            @else
                <h5>You have {{ $resultsByStatus->where('status', 'PROCESSED')->count() }} processed results</h5>
            @endif

        </div>
        <hr>
        <div class="row justify-content-center">

            <table id="myTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date of test</th>
                        <th>Test name</th>
                        <th>Farmer Name</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($resultsByStatus as $result)
                    <tr>
                        <td>
                            <a href="{{ route('labresults.show', $result->id) }}">{{ $result->id }}</a>
                        </td>
                        <td>{{ $result->date_of_test}}</td>
                        <td>{{ $result->test_name}}</td>
                        <td>{{ $result->farmer_name}}</td>
                        <td>
                            <a href="{{ route('labresults.show', $result->id) }}">{{ $result->status }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
@endsection
