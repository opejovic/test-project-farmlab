@extends ('layouts.master')


@section ('content')

<h1>Add new Practice</h1>
<form class="form-signin" method="POST" action="/farmlab/create/user">
	@csrf

	<fieldset class="form-group">
		<label for="pname">Practice name</label>
		<input name="pname" type="text" class="form-control" id="pname">
	</fieldset>	

	<fieldset class="form-group">
		<label for="type">User type</label>
		<select name="type" class="form-control" id="type">
			<option value="PRACTICE_ADMIN">Practice Admin</option>
		</select>
	</fieldset>

	<fieldset class="form-group">
		<label for="name">Practice admin name</label>
		<input name="name" type="text" class="form-control" id="name">
	</fieldset>	

	<fieldset class="form-group">
		<label for="email">Practice admin email</label>
		<input name="email" type="email" class="form-control" id="email">
	</fieldset>	

	<fieldset class="form-group">
		<label for="password">Practice admin password</label>
		<input name="password" type="password" class="form-control" id="password">
	</fieldset>

	<fieldset class="form-group">
		<label for="status">Practice admin status</label>
		<input name="status" type="text" class="form-control" id="status">
	</fieldset>	
	
	<button type="submit" class="btn btn-primary">Add practice</button>
</form>

@endsection