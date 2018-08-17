@extends ('layouts.master')


@section ('content')

<form method="POST" action="/file/upload" class="form-signin" enctype="multipart/form-data">
	@csrf
	<fieldset class="form-group">
		<label for="labresult">File input</label>
		<input name="labresult" type="file" class="form-control-file" id="labresult" required>
	</fieldset>
	
	<fieldset class="form-group">
		<button type="submit" class="btn btn-primary">Upload</button>
	</fieldset>

	@include ('layouts.errors')
</form>

@endsection