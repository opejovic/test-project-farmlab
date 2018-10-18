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
                                <tr>
                                    <td class="text-capitalize border-bottom-1">{{ $member->id }}</td>
                                    <td class="text-capitalize border-bottom-1">{{ $member->name }}</td>
                                    <td class="text-capitalize border-bottom-1">{{ $member->created_at }}</td>
                                    <td class="text-capitalize border-bottom-1">{{ $member->status }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                       <form action="{{ route('members.destroy', $member->id) }}" method="POST">
                           @csrf
                           @method('DELETE')

                           <button type="submit" onclick="return confirm('Are you sure you want to remove this user?')" class="btn btn-danger">Delete</button>
                       </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
