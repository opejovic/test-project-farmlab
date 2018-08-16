@extends ('layouts.master')


@section ('content')

<h1>Add new FarmLab member</h1>
<form class="form-signin" method="POST" action="/farmlab/create/user">
	@csrf

	<fieldset class="form-group">
		<label for="name">Username</label>
		<input name="name" type="text" class="form-control" id="name" required>
	</fieldset>	

	<fieldset class="form-group">
		<label for="email">Email address</label>
		<input name="email" type="email" class="form-control" id="email" required>
	</fieldset>

	<fieldset class="form-group">
		<label for="password">Password</label>
		<input name="password" type="password" class="form-control" id="password" required>
	</fieldset>

	<fieldset class="form-group">
		<label for="password_confirmation">Password confirmation</label>
		<input name="password_confirmation" type="password" class="form-control" id="password_confirmation" required>
	</fieldset>	

	<fieldset class="form-group">
		<button type="submit" class="btn btn-primary">Add member</button>
	</fieldset>

	@include ('layouts.errors')
</form>

@endsection