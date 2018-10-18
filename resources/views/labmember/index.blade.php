@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body" id="card-div">
                        <table class="table text-center">
                            <tbody>
                                <tr>
                                    <th class="card-header text-center border-top-0"><h4>Id</h4></th>
                                    <th class="card-header text-center border-top-0"><h4>Member name</h4></th>
                                    <th class="card-header text-center border-top-0"><h4>Created at</h4></th>
                                    <th class="card-header text-center border-top-0"><h4>Status</h4></th>
                                </tr>
                                @foreach ($members as $member)
                                <tr>
                                    <th class="text-capitalize border-bottom-1">{{ $member->id }}</th>
                                    <th class="text-capitalize border-bottom-1">
                                        <a href="{{ route('members.show', $member->id)  }}">{{ $member->name }}</a>
                                    </th>
                                    <th class="text-capitalize border-bottom-1">{{ $member->created_at }}</th>
                                    <th class="text-capitalize border-bottom-1">{{ $member->status }}</th>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
