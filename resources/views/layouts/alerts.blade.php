@if (Session::has('info'))
	<div class="alert alert-info w3-center" role="alert">
		{{Session::get('info')}}
	</div>
@endif

<!--@if (Session::has('info'))
    
	<script>
		// ES6 Modules or TypeScript
		import Swal from 'sweetalert2'

		// CommonJS
		const Swal = require('sweetalert2')

		Swal.fire({
		  position: 'top-end',
		  icon: 'success',
		  title: 'Your work has been saved',
		  showConfirmButton: false,
		  timer: 1500
		})

	</script>
@endif
-->

