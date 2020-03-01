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
          <img src="{{ asset(Auth::user()->image) }}" class="w3-circle" height="55" width="55" alt="{{ Auth::user()->name }}">
        </a>
      </div>
      <!-- search pepople by Interests section -->
      <div class="w3-margin">
        <h4 class="">ابحث عن اشخاص</h4>
        <p>ابحث حسب الاهتمامات</p>
        <p>
          <a href="{{ route('search.users',['user_interest' => 'web-developer']) }}" class="badge badge-warning btn">مطور ويب</a>
          <a href="{{ route('search.users',['user_interest' => 'graphic-designer']) }}" class="badge badge-success btn">مصمم </a>
          <a href="{{ route('search.users',['user_interest' => 'mobile-app-developer']) }}" class="badge badge-warning btn"> مطور تطبيقات </a>
          <a href="{{ route('search.users',['user_interest' => 'marketer']) }}" class="badge badge-danger btn">مسوق </a>
          <a href="{{ route('search.users',['user_interest' => 'investors']) }}" class="badge badge-success btn"> رائد اعمال </a>
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
