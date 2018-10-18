@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center"><h4>Result # {{ $labresult->id }}</h4></div>
                    <div class="card-body" id="card-div">
                        <table class="table text-center">
                            <tbody>
                            <tr>
                                <th class="text-capitalize border-top-0">Herd</th>
                                <td class="border-top-0">{{ $labresult->herd_number }}</td>
                            </tr>
                            <tr>
                                <th class="text-capitalize">Date of arrival</th>
                                <td class=""> {{ $labresult->date_of_arrival}}</td>
                            </tr>
                            <tr>
                                <th class="text-capitalize">Date of test</th>
                                <td class="">{{ $labresult->date_of_test}} </td>
                            </tr>
                            <tr>
                                <th class="text-capitalize">Animal ID</th>
                                <td class="">{{ $labresult->animal_id}}</td>

                            </tr>
                            <tr>
                                <th class="text-capitalize">Lab code</th>
                                <td class="">{{ $labresult->lab_code}}</td>
                            </tr>
                            <tr>
                                <th class="text-capitalize">Test name</th>
                                <td class="">{{ $labresult->test_name}}</td>
                            </tr>
                            <tr>
                                <th class="text-capitalize">Farmer name</th>
                                <td class="">{{ $labresult->farmer_name}}</td>
                            </tr>
                            <tr>
                                <th class="text-capitalize">Type of samples</th>
                                <td class="">{{ $labresult->type_of_samples}}</td>
                            </tr>
                            <tr>
                                <th class="text-capitalize">Reading</th>
                                <td class=""> {{ $labresult->reading}}</td>
                            </tr>
                            <tr>
                                <th class="text-capitalize">Interpretation</th>
                                <td class="">{{ $labresult->interpretation}}</td>
                            </tr>

                            <tr>
                                <th class="text-capitalize">Vet name</th>
                                <td class="" style="max-width: 150px;">{{ $labresult->vet->name}}</td>
                            </tr>

                            <tr>
                                <th class="text-capitalize">Vet comment</th>
                                <td class="" style="max-width: 150px;">{{ $labresult->vet_comment}}</td>
                            </tr>
                            <tr>
                                <th class="text-capitalize">Vet indicator</th>
                                <td class="" style="max-width: 150px;">{{ $labresult->vet_indicator}}</td>
                            </tr>

                            <tr>
                                <th class="text-capitalize">Practice name</th>
                                <td class="">{{ $labresult->practice_name}}</td>
                            </tr>
                            <tr>
                                <th class="text-capitalize">Status</th>
                                <td class="">{{ $labresult->status}}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if ($labresult->status === \App\Models\LabResult::UNPROCESSED && $labresult->vet_id === auth()->id())
                @include ('labresults.process')
            @endif
        </div>
    </div>
@endsection
