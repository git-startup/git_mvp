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
          <a href="{{ route('search.users',['user_interest' => 'investors']) }}" class="badge badge-success btn"> مستثمر </a>
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
                        @if($requests->count())
                          @foreach($requests as $user )
                              <li class="list-group-item w3-light-grey text-right">
                                <div class="w3-right">
                                    <img src="{{ asset($user->image) }}" style="width: 80px; height: 80px;">
                                </div>

                                <p style="position: relative; top: 40px;"><a href="/profile/{{ $user->id }}" class="w3-text-black" style="margin-right: 10px;">{{ $user->name }}</a></p>
                                <p class="w3-text-black">{{ $user->location }}</p>


                                <div class="w3-left" id="work_accept">
                                    @if(Auth::user()->hasWorkRequestPending($user)) 
                                        <p>Wetting for {{ $user->getname() }} to accept your Request .</p>
                                    @elseif(Auth::user()->hasWorkRequestRecived($user)) 
                                        <work_accept-app :user_id="{{ $user->id }}"></work_accept-app>
                                    @elseif(Auth::user()->isWorkWith($user))
                                        <p>You and {{ $user->getname() }} are worker</p>
                                        
                                        <form action="/workers/delete/{{ $user->id }}" method="post">
                                            <input type="submit" value="Delete Worker" />
                                            <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                                        </form>
                                    @else
                                        <a href="/workers/add/{{ $user->id}}" class="btn btn-primary">add as worker</a>
                                    @endif
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


<script src="{{ asset('assets/js/mvp.js') }}"></script>
<script src="{{ asset('assets/vendor/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

<!-- Footer -->
@include('layouts.footer')
