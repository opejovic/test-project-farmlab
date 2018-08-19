@extends ('layouts.master')


@section ('content')

<form method="POST" action="/file/upload" class="form-signin" enctype="multipart/form-data">
	@csrf
	<fieldset class="form-group">
		<label for="csv_file">File input</label>
		<input name="csv_file" type="file" class="form-control-file" id="csv_file" required>
	</fieldset>
	
	<fieldset class="form-group">
		<button type="submit" class="btn btn-primary">Upload</button>
	</fieldset>

	@include ('layouts.errors')
</form>

@endsection