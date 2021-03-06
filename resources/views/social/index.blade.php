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
          <img src="{{ asset(Auth::user()->image) }}" class="w3-circle" height="55" width="55" alt="{{ Auth::user()->name }}">
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
      <!-- post new status form -->
      <div id="social">
        <social-app></social-app>
      </div>
    </div>

  </div>
</div>

<script src="{{ asset('assets/js/mvp.js') }}"></script>
<script src="{{ asset('assets/vendor/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/comment.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

<br><br>
<!-- Footer -->

@include('layouts.footer')
