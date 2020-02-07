@include('layouts.header')

<body class="w3-light-grey">

  <!-- Navigation Bar -->
  @include('layouts.nav')
  <!-- Header -->

<br><br>

<div class="container text-center">
  <div class="row"> 

     <!-- profile and other things -->
    <div class="col-md-3 card card-body bg-light" id="social_card" style="height: 400px!important;">
      <div class="w3-margin">
        <a href="/profile/{{ Auth::user()->id }}"> <p>{{ Auth::user()->username }}</p>
        <img src="{{ asset(Auth::user()->image) }}" class="w3-circle" height="55" width="55" alt="Avatar">
        </a>
      </div>
      
      <!-- search pepople by Interests section -->
      <div class="w3-margin">
        <h4 class="">ابحث عن مشروع</h4>
        <p>ابحث حسب نوع المشروع</p>
        <p>
          <a href="{{ route('mvp.search',['type' => 'web']) }}" class="badge badge-warning btn">
            موقع الكتروني
          </a>
          <a href="{{ route('mvp.search',['type' => 'design']) }}" class="badge badge-success btn">
          تصميم 
          </a>
          <a href="{{ route('mvp.search',['type' => 'app']) }}" class="badge badge-warning btn">
           تطبيق 
          </a>
          <a href="{{ route('mvp.search',['type' => 'system']) }}" class="badge badge-danger btn">
           نظام 
          </a>
        </p>
      </div>
      

    </div>

    <!-- to make margin -->
    <div class="col-md-1">
    </div>

    <div class="col-md-8">
 
      <div class="row">
      	<div class="col-lg-12">
      		<div class="w3-container w3-white w3-padding">
			  		<ul class="list-group list-group-flush">
			            @if($mvps->count())
			              @foreach($mvps as $mvp )
			                  <li class="list-group-item w3-light-grey text-right mvp-list">
			                  	<div class="w3-right">
				                  		<img src="{{ asset($mvp->image_one) }}" style="width: 80px; height: 80px;">
			                  	</div>

			                  	<p id="mvp-name">
                            <a href="/mvp/{{ $mvp->slug }}" class="w3-text-blue" style="margin-right: 10px;">{{ $mvp->name }}
                            </a>
                          </p>

				                 <div class="w3-left">
                            <p class="btn btn-warning btn-small w3-large">
                              {{ $mvp->price }} $ 
                            </p>
                            <!--<p>
                              <a href="/profile/{{ $mvp->user->id }}" class="w3-text-blue">
                                {{ $mvp->user->name }}
                              </a>
                            </p> -->
			                  	</div>
			                  </li>
			                  <br>
			              @endforeach
			            @else
			              <li class="list-group-item">
			                  <p class="alert alert-danger"> لا توجد نتائج لعرضها حاليا </p>
			                </li>
			            @endif
			          </ul>
	    	    </div>
      	</div>
      </div>
           
    </div>

  </div>
</div>


<!-- Footer -->
@include('layouts.footer')