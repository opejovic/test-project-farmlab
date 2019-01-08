@extends('layouts.app')

@section('pageTitle')
    Add Member
@endsection

@section ('content')
<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Add New Team Member</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li>
                    <a>Team Members</a>
                </li>
                <li>
                    <strong>Add New</strong>
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

                        <div class="ibox-content">
                            <form method="POST" action="{{ route('members.store') }}" class="form-horizontal">
                                @csrf
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-10"><input name="name" type="text" class="form-control" id="name" value="{{ old('name') }}" required>
                                    @if ($errors->has('name'))
                                        <label class="control-label">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </label>
                                    @endif
                                    </div>

                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10"><input name="email" type="email" class="form-control" id="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <label class="control-label">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </label>
                                    @endif
                                    </div>
                                </div>
            
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white" onclick="goBack()">
                                            Go back
                                        </button>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript">
    function goBack() {
        window.history.back();
    }
</script>
@endsection