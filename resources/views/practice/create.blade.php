@extends('layouts.app')

@section('pageTitle')
    Add Practice
@endsection

@section ('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Create New Practice</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>
                <a>Practices</a>
            </li>
            <li>
                <strong>Create New Practice</strong>
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
                        <form method="POST" action="{{ route('practice.store') }}" class="form-horizontal">
                            @csrf
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Practice Name</label>

                                <div class="col-sm-10"> <input name="name" type="text" class="form-control" id="name" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                    <label class="control-label">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </label>
                                @endif
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group{{ $errors->has('admin_name') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Practice Admin Name</label>
                                <div class="col-sm-10">
                                    <input name="admin_name" type="text" class="form-control" id="admin_name" value="{{ old('admin_name') }}" required>
                                @if ($errors->has('admin_name'))
                                    <label class="control-label">
                                        <strong>{{ $errors->first('admin_name') }}</strong>
                                    </label>
                                @endif                                        
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}""><label class="col-sm-2 control-label">Practice Admin Email</label>
                                <div class="col-sm-10">
                                    <input name="email" type="email" class="form-control" id="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <label class="control-label">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </label>
                                @endif                                        
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Password</label>

                                <div class="col-sm-10"><input name="password" type="password" class="form-control" id="password" required>
                                @if ($errors->has('password'))
                                    <label class="control-label">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </label>
                                @endif
                                </div>
                            </div>                                
                            <div class="hr-line-dashed"></div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Password Confirmation</label>
                                <div class="col-sm-10">
                                    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" required>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-white" onclick="history.go(-1);">Cancel</button>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection