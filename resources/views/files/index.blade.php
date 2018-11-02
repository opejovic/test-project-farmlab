@extends('layouts.app')

@section ('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>File manager</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>
                <a>Forms</a>
            </li>
            <li class="active">
                <strong>File upload</strong>
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
                            @include ('layouts.errors')
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
                                        <small>Uploader: {{ $file->uploaderName() }}</small>
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
    <script>
        Dropzone.options.dropzoneForm = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            dictDefaultMessage: "<strong>Drop files here or click to upload. </strong></br> (Only CSV files can be uploaded.)",
            // parallelUploads: 5,
            // chunking: true,
            acceptedFiles: '.csv',
            // autoProcessQueue: false,
            // autoQueue: false,
            init: function() {
            this.on("success", function(file) {  
                swal({
                    title: "Success!",
                    text: "Uploaded Sucessfully",
                    icon: "success",
                    type: "success",
                    button: "Dismiss.",
                    });                
                });
            },
            error: function(file, response) {
            if($.type(response) === 400)
                var message = response; //dropzone sends it's own error messages in string
            else
                var message = response.message;
            file.previewElement.classList.add("dz-error");
            _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i];
                _results.push(node.textContent = message);
            }
            return _results;
            }   

        };
    </script>
@endsection


