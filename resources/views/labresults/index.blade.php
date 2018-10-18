@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @if ($allResults->count() > 0)

                <table id="myTable" class="table table-striped table-hover table-bordered" style="width:100%">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Herd</th>
                            <th>Date of test</th>
                            <th>Animal ID</th>
                            <th>Lab code</th>
                            <th>Test name</th>
                            <th>Reading</th>
                            <th>Farmer name</th>
                            <th>Practice name</th>
                            <th>Status</th>
                            <th>Vet</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($allResults as $result)
                        <tr>
                            <td>
                                <a href="{{ route('labresults.show', $result->id) }}">{{ $result->id }}</a>
                            </td>
                            <td>{{ $result->herd_number}}</td>
                            <td>{{ $result->date_of_test}}</td>
                            <td>{{ $result->animal_id}}</td>
                            <td>{{ $result->lab_code}}</td>
                            <td>{{ $result->test_name}}</td>
                            <td>{{ $result->reading}}</td>
                            <td>{{ $result->farmer_name}}</td>
                            <td>{{ $result->practice_name}}</td>
                            <td>{{ $result->status}}</td>
                            <td>{{ $result->vet->name }}</td>
                        </tr>
                         @endforeach
                    </tbody>

                </table>

            @else
                <div class="card-body">There are no new results.</div>
            @endif

        </div>
    </div>
@endsection
