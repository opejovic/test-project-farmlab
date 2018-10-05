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
                                <tr>
                                    <th class="text-capitalize border-bottom-1">{{ $member->id }}</th>
                                    <th class="text-capitalize border-bottom-1">{{ $member->name }}</th>
                                    <th class="text-capitalize border-bottom-1">{{ $member->created_at }}</th>
                                    <th class="text-capitalize border-bottom-1">{{ $member->status }}</th>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                       <form action="{{ route('members.destroy', $member->id) }}" method="POST">
                           @csrf
                           @method('DELETE')

                           <button type="submit" class="btn btn-link">Delete</button>
                       </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
