@extends('layouts.app')

@section ('pageTitle')
    Team
@endsection

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">

        <div class="col-lg-11">
            <h2>Team</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home')}}">Home</a>
                </li>
                <li class="active">
                    <strong>Team Members</strong>
                </li>                
                <li class="active">
                    <a data-toggle="modal" data-target="#myModal" id="open">Add new member</a>
                     <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content animated bounceInRight">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <i class="fa fa-user modal-icon"></i>
                                <h4 class="modal-title">Add new team member</h4>
                                <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                            </div>
                            <div class="modal-body">
                            <form role="form" method="POST" action="{{ route('members.store') }}" id="form" novalidate="novalidate">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-6">
                                    <input name="name" type="text" class="form-control" id="name" required="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                    <input name="email" type="email" class="form-control" id="email" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input name="password" type="password" class="form-control" id="password" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password_confirmation" class="col-sm-4 col-form-label text-md-right">Password
                                    confirmation</label>
                                <div class="col-md-6">
                                    <input name="password_confirmation" type="password" class="form-control"
                                           id="password_confirmation" required>
                                </div>
                            </div>
                        
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal">Dismiss</button>
                                <button type="submit" id="ajaxSubmit" class="btn btn-primary">Submit</button>
                            </div>
                            @include ('layouts.errors')
                            </form>
                            
                        </div>
                    </div>
                </div>

            </li>
        </ol>
        </div>

    </div>
        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            @foreach ($members as $member)
            <div class="col-lg-3">
                <div class="contact-box center-version">

                <a href="{{ route('members.show', $member->id) }}">

                    <img alt="image" class="img-circle" src="images/profiles/{{ $member->id }}.jpg">


                    <h3 class="m-b-xs"><strong>{{ $member->name }}</strong></h3>

                    <div class="font-bold">{{ __('Team Member') }}</div>
                    <address class="m-t-md">
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>

                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                        <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                        @if ($member->status === \App\Models\User::VERIFIED)
                            <a class="btn btn-xs btn-primary">
                        @else
                            <a class="btn btn-xs btn-warning">
                        @endif 
                            {{ ucfirst(strtolower(str_replace('_', ' ', $member->status)))  }}</a>
                    </div>
                </div>
            </div>
            </div>
                @endforeach

        </div>
            <div class="text-center">
                {{ $members->links() }}
            </div>
        </div>

@if(Session::has('errors'))
<script>
$(document).ready(function(){
    $('#myModal').modal({show: true});
}
</script>
@endif
@endsection