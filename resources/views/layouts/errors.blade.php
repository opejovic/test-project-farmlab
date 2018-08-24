@if ($errors->any())
	<div class="col-md-8">		
		<br>
			<span class="alert alert-danger">
					@foreach ($errors->all() as $error)
						{{ $error}}
					@endforeach                              
			</span>
	</div>
@endif

