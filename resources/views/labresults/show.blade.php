@extends('layouts.app')

@section ('pageTitle')
    Result # {{ $labresult->id }}
@endsection

@section ('content')

           <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-8">
                    <h2>Lab Results</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('labresults.show', $labresult->id) }}">
                                <strong>Lab result # {{ $labresult->id }}</strong>
                            </a>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-4">
                    <div class="title-action">
                        @if ($labresult->status === \App\Models\LabResult::UNPROCESSED && $labresult->vet_id === auth()->id())
                            @include ('labresults.modalProcess')
                        @elseif ($labresult->isProcessed())
                            <a href="invoice_print.html" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print Result </a>
                        @endif
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content p-xl">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5>Practice:</h5>
                                    <address>
                                        <strong>{{ $labresult->practiceName }}</strong><br>
                                        106 Jorg Avenu, 600/10<br>
                                        Chicago, VT 32456<br>
                                        <abbr title="Phone">P:</abbr> (123) 601-4590
                                    </address>
                                </div>

                                <div class="col-sm-6 text-right">
                                    <h2>Result No.</h2>
                                    <h2 class="text-navy">{{ $labresult->id }}</h2>
                                    <span>Farmer:</span>
                                    <address>
                                        <strong>{{ $labresult->farmer_name }}</strong><br>
                                        112 Street Avenu, 1080<br>
                                        Miami, CT 445611<br>
                                        <abbr title="Phone">P:</abbr> (120) 9000-4321
                                    </address>
                                    <p>
                                        <span><strong>Date of Arrival:</strong> {{ $labresult->date_of_arrival }}</span><br/>
                                        <span><strong>Date of Test:</strong> {{ $labresult->date_of_test }}</span>
                                    </p>
                                </div>
                            </div>

                            <div class="table-responsive m-t">
                                <table class="table invoice-table">
                                    <thead>

                                        <tr>
                                            <th class="text-capitalize">Item List</th>
                                            <th class="text-capitalize">Herd</th>
                                            <th class="text-capitalize">Animal ID</th>
                                            <th class="text-capitalize">Lab code</th>
                                            <th class="text-capitalize">Test name</th>
                                            <th class="text-capitalize">Type of samples</th>
                                            <th class="text-capitalize">Reading</th>
                                            <th class="text-capitalize">Interpretation</th>
                                            <th class="text-capitalize">Vet Name</th>
                                            <th class="text-capitalize">Status</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <th class="">{{ __('Description') }}</th>
                                            <td class="">{{ $labresult->herd_number }}</td>
                                            <td class="">{{ $labresult->animal_id}}</td>
                                            <td class="">{{ $labresult->lab_code}}</td>
                                            <td class="">{{ $labresult->test_name}}</td>
                                            <td class="">{{ $labresult->type_of_samples}}</td>
                                            <td class=""> {{ $labresult->reading}}</td>
                                            <td class="">{{ $labresult->interpretation}}</td>
                                            <td class="">{{ $labresult->vet->name}}</td>
                                            <td class="">{{ $labresult->status}}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                            <div class="well m-t"><strong>Vet Comment:</strong>
                                {{ $labresult->vet_comment}}
                            </div>                            

                            <div class="well m-t"><strong>Vet Indicator:</strong>
                                {{ $labresult->vet_indicator}}
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <br />
@endsection

@section ('scripts')
    @if ($errors->any())
        <script type="text/javascript">
            $('#myLabresultModal').modal('show');
        </script>
    @endif
@endsection