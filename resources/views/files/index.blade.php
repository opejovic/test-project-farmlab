@extends('layouts.app')

@section ('pageTitle')
    Files
@endsection

@section ('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>File manager</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li>
                <strong>
                    <a href="{{ route('files.index' )}}">Files</a>
                </strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
    <div class="wrapper wrapper-content animated fadeIn">
        
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">

                        <form method="POST" action="{{ route('files.store') }}" class="dropzone" id="dropzoneForm">
                            @csrf
                            <div class="fallback">
                                <input type="file" name="file" id="file">
                            </div>
                        </form>
                    </div>
                        
                </div>
            <div class="ibox">
                    <div class="ibox-title">
                        <h5>All uploaded files</h5>
                        <div class="ibox-tools">

                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row m-b-sm m-t-sm">
                            <div class="col-md-1">
                                <button type="button" id="loading-example-btn" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
                            </div>
                            <div class="col-md-11">
                                <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                            </div>
                        </div>

                        <div class="project-list">

                            <table class="table table-hover">
                                <tbody>
                                @foreach ($files as $file)
                                <tr>
                                    <td class="project-status">
                                        <span class="label label-primary">Active</span>
                                    </td>
                                    <td class="project-title">
                                        <h4><i class="fa fa-file fa-lg"></i><a href="project_detail.html"> {{ $file->name }}</a></h4>
                                    </td>
                                    <td>
                                        <small>Uploaded: {{ $file->uploaded_at }}</small>
                                        <br/>
                                        <small>Uploader: {{ $file->uploader_name }}</small>
                                    </td>
                                    <td class="project-people">
                                        <small>{{ $file->file_path }}</small>
                                    </td>
                                    <td class="project-actions">
                                        <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                        <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                                </div>
                                    <div class="text-center">
                                        {{ $files->links() }}
                                    </div>
                                </div>                            
                        </div>
                    </div>
            </div>
        </div>

@endsection

@section ('scripts')
    @include ('files.script')
@endsection


