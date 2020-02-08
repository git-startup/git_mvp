 @include('layouts.header')

  <body class="w3-light-grey">

	<!-- Navigation Bar -->
	@include('layouts.nav')

	<br><br>

	<div class="container text-center">
	  <div class="row">
	  	<div id="add_mvp" class="col-md-12 w3-white w3-padding">
			<add_mvp-app :user="{{ Auth::user() }}"></add_mvp-app>
		</div>
	  </div>
	</div>

 
<script src="{{ asset('assets/js/profile.js') }}"></script>
<script src="{{ asset('assets/js/mvp.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

<!-- dropzone -->
<script src="{{ asset('assets/vendor/js/dropzone-jquery-plugin.js') }}"></script>
<script src="{{ asset('assets/vendor/js/dropzone.js') }}"></script>

<script type="text/javascript">
        Dropzone.options.imageUpload = {
            maxFilesize         :       1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif"
        };
</script>


<!-- Footer -->
@include('layouts.footer')
