@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Upload new file</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('file.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="input-group md-8">

                                <div class="custom-file">
                                    <input type="file" name="csv_file" class="custom-file-input" id="csv_file">
                                    <label class="custom-file-label" for="csv_file">Choose file</label>
                                </div>

                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit" id="csv_file">Upload
                                    </button>
                                </div>

                            </div>

                            {{-- Display the name of the file in the input form --}}
                            <script type="application/javascript">
                                $('input[type="file"]').change(function (e) {
                                    var fileName = e.target.files[0].name;
                                    $('.custom-file-label').html(fileName);
                                });
                            </script>
                        </form>
                    </div>
                </div>
            </div>
            @include ('layouts.errors')
        </div>
    </div>

@endsection
