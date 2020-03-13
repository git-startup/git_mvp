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

      <div class="row">
        <div class="col-lg-12">
            <div class="w3-container w3-white w3-padding">
                <div class="card" style="width: 100%;">
                    <ul class="list-group list-group-flush" id="work_accept">
                        @if($requests->count())
                          @foreach($requests as $request)
                              <li class="list-group-item bg-light w3-margin text-right">
                                <div class="w3-right">
                                    <img src="{{ asset($request->user->image) }}" style="width: 80px; height: 80px;">
                                </div>
                                <span class=""><a href="/profile/{{ $request->user->id }}" class="w3-text-blue" style="margin-right: 10px;">{{ $request->user->name }}</a></span>

                                <p class="">{{ $request->user->location }}</p>
                                <div class="w3-left" style="margin-top: 10px;">
                                  <button onclick="document.getElementById('agreement_{{ $request->user->id }}').style.display = 'block'"  class="w3-button w3-white w3-border w3-border-gray w3-round w3-text-gray w3-hover-light-gray w3-hover-text-gray" style="padding: 7px 15px">
                                        <i class="fa fa-file-text-o w3-margin-left-8 w3-text-gray"></i> عرض نص الاتفاق </button>
                                </div>
                              </li>

                              <!-- work request agreement model -->
                              <div id="agreement_{{ $request->user->id }}" class="w3-modal" style="display: none;">
                                  <div class="w3-modal-content brnda-card-4 w3-animate-zoom">
                                      <header class="w3-container w3-border-bottom">
                                          <h6 class="w3-right-align"><i class="fa fa-lightbulb-o w3-margin-left-8"></i>  {{ $request->work_title }}  </h6>
                                          <span onclick="document.getElementById('agreement_{{ $request->user->id }}').style.display='none'" class="w3-btn w3-display-topleft">×</span>
                                      </header>
                                        <div class="w3-container w3-section">
                                            <p class="w3-right-align user_text"> {{ $request->agreement }} </p>
                                        </div>
                                        <footer class="w3-container ">
                                            <div class="w3-section w3-right">
                                                <work_accept-app :work_id="{{ $request->id }}"></work_accept-app>
                                            </div>
                                        </footer>
                                  </div>
                              </div>
                              <!-- end work agreement model -->
                              <br>
                          @endforeach
                        @endif

                        @if($requests_pending->count())
                          @foreach($requests_pending as $request)
                            <li class="list-group-item w3-right-align">
                              <p class="">{{ $request->work_title }}</p>
                              <p class="w3-text-blue"> <a href="{{ route('profile.index',['user_id' => $request->worker_id]) }}"> مستقبل الطلب </a> </p>
                              <form  action="{{ route('workers.delete') }}" method="post">
                                @csrf
                                <input type="hidden" name="work_id" value="{{ $request->id }}">
                                <button type="submit" class="btn btn-danger w3-right" name="delete_worker"> <i class="fa fa-times-circle"></i> </button>
                              </form>

                              <!-- edit work request -->
                              <button type="button" onclick="document.getElementById('edit_work_request_{{ $request->id }}').style.display='block'" class="btn btn-primary w3-margin-right"> <i class="fa fa-edit"></i> </button>
                              <div id="edit_work_request_{{ $request->id }}" class="w3-modal" style="display: none;">
                                  <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="padding: 20px;">
                                    <form id="edit_work_request_form_{{ $request->id }}" action="{{ route('workers.edit') }}" method="post">
                                      @csrf
                                      <div class="w3-padding-16 row">
                                        <div class="form-group{{ $errors->has('work_title') ? ' alert alert-danger' : '' }} col-md-6">
                                          <input type="text"  name="work_title" value="{{ $request->work_title }}" class="form-control">
                                          @if ($errors->has('work_title'))
                                            <span class="help-block">{{ $errors->first('work_title') }}</span>
                                          @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('sallery') ? ' alert alert-danger' : '' }} col-md-6">
                                          <input type="number" name="sallery" value="{{ $request->sallery }}" class="form-control">
                                          @if ($errors->has('sallery'))
                                            <span class="help-block">{{ $errors->first('sallery') }}</span>
                                          @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('start_of_agreement') ? ' alert alert-danger' : '' }} col-md-6">
                                          <input type="text" name="start_of_agreement" value="{{ $request->start_of_agreement }}" class="form-control">
                                          @if ($errors->has('start_of_agreement'))
                                            <span class="help-block">{{ $errors->first('start_of_agreement') }}</span>
                                          @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('end_of_agreement') ? ' alert alert-danger' : '' }} col-md-6">
                                          <input type="text" name="end_of_agreement" value="{{ $request->end_of_agreement }}" class="form-control">
                                          @if ($errors->has('end_of_agreement'))
                                            <span class="help-block">{{ $errors->first('end_of_agreement') }}</span>
                                          @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('agreement') ? ' alert alert-danger' : '' }} col-md-12">
                                          <textarea name="agreement" class="form-control" rows="8" cols="80">{{ $request->agreement }}</textarea>
                                          @if ($errors->has('agreement'))
                                            <span class="help-block">{{ $errors->first('agreement') }}</span>
                                          @endif
                                        </div>
                                        <input type="hidden" name="work_id" value="{{ $request->id }}">
                                        <footer class="w3-container" dir="rtl" style="margin-right: 15px">
                                            <div class="w3-section w3-right">
                                                <button tabindex="1" title="ارسال" type="submit" form="edit_work_request_form_{{ $request->id }}" class="btn btn-primary w3-round" style="padding: 7px 15px">
                                                    <i class="fa fa-save w3-margin-left-8"></i><span> حفظ </span></span></button>
                                                <span tabindex="2" title="إلغاء" onclick="document.getElementById('edit_work_request_{{ $request->id }}').style.display='none'"  class="btn w3-light-grey w3-round" style="padding: 7px 15px;">
                                                    <i class="fa fa-times w3-margin-left-8"></i><span>إلغاء</span></span></button>
                                            </div>
                                        </footer>
                                    </form>
                                  </div>
                              </div>
                              <!-- end edit work request model -->
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
