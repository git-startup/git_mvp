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
                    <ul class="list-group list-group-flush" id="work_accept">
                        @if($requests->count())
                          @foreach($requests as $user)
                              <li class="list-group-item bg-light w3-margin text-right">
                                <div class="w3-right">
                                    <img src="{{ asset($user->image) }}" style="width: 80px; height: 80px;">
                                </div>
                                <span class=""><a href="/profile/{{ $user->id }}" class="w3-text-blue" style="margin-right: 10px;">{{ $user->name }}</a></span>

                                <p class="">{{ $user->location }}</p>
                                <div class="w3-left" style="margin-top: 10px;">
                                    @if(Auth::user()->hasWorkRequestRecived($user))
                                      <button onclick="document.getElementById('agreement_{{ $user->id }}').style.display = 'block'"  class="w3-button w3-white w3-border w3-border-gray w3-round w3-text-gray w3-hover-light-gray w3-hover-text-gray" style="padding: 7px 15px">
                                        <i class="fa fa-file-text-o w3-margin-left-8 w3-text-gray"></i> عرض نص الاتفاق </button>
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

                              <!-- work request agreement model -->
                              <div id="agreement_{{ $user->id }}" class="w3-modal" style="display: none;">
                                  <div class="w3-modal-content brnda-card-4 w3-animate-zoom">
                                      <header class="w3-container w3-border-bottom">
                                          <h6 class="w3-right-align"><i class="fa fa-tags w3-margin-left-8"></i>  نص الاتفاق </h6>
                                          <span onclick="document.getElementById('agreement_{{ $user->id }}').style.display='none'" class="w3-btn w3-display-topleft">×</span>
                                      </header>
                                        <div class="w3-container w3-section">
                                            <p class="w3-center user_text"> {{ $user->agreement }} </p>
                                        </div>
                                        <footer class="w3-container ">
                                            <div class="w3-section w3-right">
                                                <work_accept-app :user_id="{{ $user->id }}"></work_accept-app>
                                            </div>
                                        </footer>
                                  </div>
                              </div>
                              <!-- end work agreement model -->
                              <br>
                          @endforeach
                        @endif

                        @if($requests_pending->count())
                          @foreach($requests_pending as $user)
                          <li class="list-group-item">
                              <p class="alert alert-info"> في انتظار  {{ $user->getname() }} ليوافق على طلب العمل </p>   </p>
                            </li>
                          @endforeach
                        @endif

                        @if(!$requests_pending->count() and !$requests->count())
                          <li class="list-group-item">
                            <p class="alert alert-info"> لاتوجد طلبات عمل لعرضها حاليا </p>   </p>
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
