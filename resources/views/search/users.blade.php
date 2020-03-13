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
        <a href="/profile/{{ Auth::user()->username }}"> <p>{{ Auth::user()->username }}</p>
        <img src="{{ asset(Auth::user()->image) }}" class="w3-circle" height="55" width="55" alt="Avatar">
        </a>
      </div>

      <!-- search pepople by Interests section -->
      <div class="w3-margin">
        <h4 class="">ابحث عن اشخاص</h4>
        <p>ابحث حسب الاهتمامات</p>
        <p>
          <?php
            $classes = ['success','primary','warning','danger'];
            $i = 0;
          ?>
          @foreach($mvp_type as $type)
            <a href="{{ route('search.users',['can_work_on' => $type->slug]) }}" class="badge badge-<?php echo $classes[$i] ?> btn"> {{ $type->name }} </a>
            <?php
              if(isset($classes[$i+1])){
                  $i++;
              }else $i = 0;
            ?>
          @endforeach
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
            	<div class="card" style="width: 100%;">
    			  		<ul class="list-group list-group-flush">
    			            @if($results->count())
    			              @foreach($results as $result)
    			                  <li class="list-group-item bg-light w3-margin text-right searchResults">
    			                  	<div class="w3-right searchResults_image">
    				                  		<img src="{{ asset($result->user->image) }}">
    			                  	</div>

                              <div class="searchResults_name">
      			                  	<p><a href="/profile/{{ $result->user->username }}" class="w3-text-black">{{ $result->user->name }}</a></p>
                              </div>

    				                  <div class="searchResults_location">
                                <p>{{ $result->user->location }}</p>
    			                  	</div>

                              <div class="w3-margin w3-clear searchResults_rating">
                                @for($i = 0; $i< $result->rating; $i++)
                                <i class="fa fa-star w3-text-amber"></i>
                                @endfor
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
       </div>


      <script src="{{ asset('assets/js/script.js') }}"></script>
<!-- Footer -->
@include('layouts.footer')
