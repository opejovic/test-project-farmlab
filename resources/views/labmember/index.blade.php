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
                                    <th class="card-header text-center border-top-0">Id</th>
                                    <th class="card-header text-center border-top-0">Member name</th>
                                    <th class="card-header text-center border-top-0">Created at</th>
                                    <th class="card-header text-center border-top-0">Status</th>
                                </tr>
                                @foreach ($members as $member)
                                <tr>
                                    <td class="text-capitalize border-bottom-1">{{ $member->id }}</td>
                                    <td class="text-capitalize border-bottom-1">
                                        <a href="{{ route('members.show', $member->id)  }}">{{ $member->name }}</a>
                                    </td>
                                    <td class="text-capitalize border-bottom-1">{{ $member->created_at }}</td>
                                    <td class="text-capitalize border-bottom-1">{{ $member->status }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="card-footer">{{ $members->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
