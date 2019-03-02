@extends('layouts.app')

@section ('pageTitle')
    Results
@endsection

@section ('content')

 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Lab Results</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li>
                    <strong>
                        <a href="{{ route('labresults.index', $practice->id) }}">Lab Results</a>
                    </strong>
                </li>
            </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>All Lab Results</h5>
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
                                <th>Hash id</th>
                                <th>Herd</th>
                                <th>Date Of Test</th>
                                <th>Animal ID</th>
                                <th>Lab Code</th>
                                <th>Test Name</th>
                                <th>Reading</th>
                                <th>Farmer Name</th>
                                <th>Practice Name</th>
                                <th>Vet</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($labResults as $result)
                            <tr>
                                <td>{{ $result->id }}</td>
                                <td>{{ $result->hash_id }}</td>
                                <td>{{ $result->herd_number}}</td>
                                <td>{{ $result->date_of_test}}</td>
                                <td>{{ $result->animal_id}}</td>
                                <td>{{ $result->lab_code}}</td>
                                <td>{{ $result->test_name}}</td>
                                <td>{{ $result->reading}}</td>
                                <td>{{ $result->farmer_name}}</td>
                                <td>{{ $result->practice_name}}</td>
                                <td>{{ $result->vet->name }}</td>
                                <td>
                                <a href="{{ route('labresults.show', [$practice->id, $result->hash_id]) }}">
                                    <span class="label label-{{ $result->isProcessed() ? 'primary' : 'warning' }}">
                                        {{ $result->status }}
                                    </span>
                                </a>
                                </td>
                            </tr>
                            @endforeach
                            <tfoot>
                                <th>#</th>
                                <th>Hash id</th>
                                <th>Herd</th>
                                <th>Date Of Test</th>
                                <th>Animal ID</th>
                                <th>Lab Code</th>
                                <th>Test Name</th>
                                <th>Reading</th>
                                <th>Farmer Name</th>
                                <th>Practice Name</th>
                                <th>Vet</th>
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