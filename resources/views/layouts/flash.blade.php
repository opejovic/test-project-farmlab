@if (session()->has('message'))
    <script type="text/javascript">
	    swal({
	        title: "{{ session('message.title') }}",
	        text: "{{ session('message.text') }}",
	        type: "{{ session('message.type') }}",
	        confirmationText: false,
	        timer: 2000
	    });
	</script>
@endif 