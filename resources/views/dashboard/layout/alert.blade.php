@if (Session::has('info'))
	<div class="alert alert-info text-center" role="alert" style="width: 80%; margin: 0% 10%;">
		{{Session::get('info')}}
	</div>
@endif

@if (Session::has('alert'))
	<div class="alert alert-danger w3-center" role="alert" style="width: 60%; margin: 0% 20%;">
		{{Session::get('alert')}}
	</div>
@endif
