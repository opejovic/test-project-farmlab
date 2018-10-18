@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body" id="card-div">
                        <table class="table table-hover text-center">
                            <tbody>
                                <tr>
                                    <th class="card-header text-center border-top-0">Id</th>
                                    <th class="card-header text-center border-top-0">Practice name</th>
                                    <th class="card-header text-center border-top-0">Created at</th>
                                </tr>
                                @foreach ($practices as $practice)
                                <tr>
                                    <td class="text-capitalize border-bottom-1">{{ $practice->id }}</td>
                                    <td class="text-capitalize border-bottom-1">
                                        <a href="{{ route('practice.show', $practice->id)  }}">{{ $practice->name }}</a>
                                    </td>
                                    <td class="text-capitalize border-bottom-1">{{ $practice->created_at }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="card-footer">{{ $practices->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
