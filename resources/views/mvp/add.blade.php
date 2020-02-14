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

<!-- Footer -->
@include('layouts.footer')
