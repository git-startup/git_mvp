 @include('layouts.header')

  <body class="w3-light-grey">

	<!-- Navigation Bar -->
	@include('layouts.nav')

	<br><br>

	<div class="container text-center">
	  <div class="row">
	  	<div id="add_mvp" class="col-md-12 w3-white w3-padding">
        <form action="/mvp/add" method="post" enctype="multipart/form-data">
          @csrf
			    <add_mvp-app :user="{{ Auth::user() }}" :users="{{ $users }}"></add_mvp-app>
       </form>
		</div>
	  </div>
	</div>


<script src="{{ asset('assets/js/profile.js') }}"></script>
<script src="{{ asset('assets/js/mvp.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

<!-- Footer -->
@include('layouts.footer')
