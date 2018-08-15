@extends ('layouts.master')


@section ('content')

<h1>Add new FarmLab member</h1>
<form class="form-signin" method="POST" action="/farmlab/create/user">
	@csrf

	<fieldset class="form-group">
		<label for="name">Username</label>
		<input name="name" type="text" class="form-control" id="name">
	</fieldset>	

	<fieldset class="form-group">
		<label for="email">Email address</label>
		<input name="email" type="email" class="form-control" id="email">
	</fieldset>

	<fieldset class="form-group">
		<label for="password">Password</label>
		<input name="password" type="password" class="form-control" id="password">
	</fieldset>

	<fieldset class="form-group">
		<label for="type">User type</label>
		<select name="type" class="form-control" id="type">
			<option value="FARM_LAB_TEAM_MEMBER">FarmLab team member</option>
		</select>
	</fieldset>

	<fieldset class="form-group">
		<label for="status">Status</label>
		<input name="status" type="text" class="form-control" id="status">
	</fieldset>	

	
	<button type="submit" class="btn btn-primary">Add member</button>
</form>

@endsection