@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center"><h4>Result # {{ $result->id }}</h4></div>
                    <div class="card-body" id="card-div">
                        <table class="table text-center">
                            <tbody>
                            <tr>
                                <th class="text-capitalize border-top-0">Herd</th>
                                <td class="border-top-0">{{ $result->herd_number }}</td>
                            </tr>
                            <tr>
                                <th class="text-capitalize">Date of arrival</th>
                                <td class=""> {{ $result->date_of_arrival}}</td>
                            </tr>
                            <tr>
                                <th class="text-capitalize">Date of test</th>
                                <td class="">{{ $result->date_of_test}} </td>
                            </tr>
                            <tr>
                                <th class="text-capitalize">Animal ID</th>
                                <td class="">{{ $result->animal_id}}</td>

                            </tr>
                            <tr>
                                <th class="text-capitalize">Lab code</th>
                                <td class="">{{ $result->lab_code}}</td>
                            </tr>
                            <tr>
                                <th class="text-capitalize">Test name</th>
                                <td class="">{{ $result->test_name}}</td>
                            </tr>
                            <tr>
                                <th class="text-capitalize">Farmer name</th>
                                <td class="">{{ $result->farmer_name}}</td>
                            </tr>
                            <tr>
                                <th class="text-capitalize">Type of samples</th>
                                <td class="">{{ $result->type_of_samples}}</td>
                            </tr>
                            <tr>
                                <th class="text-capitalize">Reading</th>
                                <td class=""> {{ $result->reading}}</td>
                            </tr>
                            <tr>
                                <th class="text-capitalize">Interpretation</th>
                                <td class="">{{ $result->interpretation}}</td>
                            </tr>

                            <tr>
                                <th class="text-capitalize">Vet comment</th>
                                <td class="" style="max-width: 150px;">{{ $result->vet_comment}}</td>
                            </tr>
                            <tr>
                                <th class="text-capitalize">Vet indicator</th>
                                <td class="" style="max-width: 150px;">{{ $result->vet_indicator}}</td>
                            </tr>

                            <tr>
                                <th class="text-capitalize">Practice name</th>
                                <td class="">{{ $result->practice_name}}</td>
                            </tr>
                            <tr>
                                <th class="text-capitalize">Status</th>
                                <td class="">{{ $result->status}}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if ($result->status === \App\Models\LabResult::UNPROCESSED)
                @include ('labresults.process')
            @endif
        </div>
    </div>
@endsection
