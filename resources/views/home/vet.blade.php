@extends('layouts.app')

@section('pageTitle')
    Home
@endsection

@section ('content')

 <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Home</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
    @if ($labresult->unprocessed > 0)
        <h5>You have {{ $labresult->count_unprocessed }} unprocessed results</h5>
    @else
        <h5>You have {{ $labresult->whereNotNull('processed_at')->count() }} processed results</h5>
    @endif
        </div>
    </div>
        <div class="wrapper wrapper-content animated fadeInRight text-center">
            <div class="row">
                <div class="col-lg-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Lab Results Assigned To This Account</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables" id="example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date Of Test</th>
                                <th>Test Name</th>
                                <th>Farmer Name</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($resultsByStatus as $result)
                            <tr>
                                <td>{{ $result->id }}</td>
                                <td>{{ $result->date_of_test}}</td>
                                <td>{{ $result->test_name}}</td>
                                <td>{{ $result->farmer_name}}</td>
                                <td>
                                <a href="{{ route('labresults.show', $result->id) }}">
                                    <span class="label label-{{ $result->isProcessed() ? 'primary' : 'warning' }}">
                                        {{ $result->status }}
                                    </span>
                                </a>
                                </td>
                            </tr>
                            @endforeach
                            <tfoot>
                                <th>#</th>
                                <th>Date Of Test</th>
                                <th>Test Name</th>
                                <th>Farmer Name</th>
                                <th>Status</th>
                            </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            </div>
        </div>


@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('.dataTables').DataTable({
                pageLength: 25,
                responsive: true,
                stateSave: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Lab Results for Example Practice / Date'},
                    {extend: 'pdf', title: 'Lab Results for Example Practice / Date'},

                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                        }
                    }
                ]

            });

        });

    </script>
@endsection