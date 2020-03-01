@include('layouts.header')

<body class="w3-light-grey">

<!-- Navigation Bar -->
@include('layouts.nav')


<!-- Header -->
<div class="w3-display-container w3-white w3-content profile-user-info">
    <div class="w3-container w3-center" style="height:"800">
      <img src="{{ asset($profile->image) }}" style="border-radius: 50%" class="w3-image w3-margin w3-round-large" width="100" height="100">
      <h3>{{ $profile->name }}</h3>
    </div>

    <div class="w3-row-padding w3-center info-icon" style="margin:32px 0;">
      @if(!$profile->location)
        <div class="alert alert-info"><i class="fa fa-map-marker"></i> قم يتحديد موقعك </div>
      @else
        <div class=""><i class="fa fa-map-marker"></i> {{ $profile->location }} </div>
      @endif
      <div class=""><i class="fa fa-phone"></i> {{ $profile->phone }}</div>
      <div class=""><i class="fa fa-envelope-o"></i> {{ $profile->email }}</div>
    </div>
</div>

<div class="profile-link w3-hide-small">
  <div class="w3-hover-opacity w3-hover-light-gray">
    <a href="javascript:void(0)" class="tablink" onclick="openLink(event, 'info-tab');">الملف الشخصي</a>
  </div>

  @if(Auth::user()->id == $profile->id)
    <div class="w3-hover-opacity w3-hover-light-gray">
      <a href="javascript:void(0)" class="tablink" onclick="openLink(event, 'activity-tab');"> انشطتي </a>
    </div>

    <div class="w3-hover-opacity w3-hover-light-gray">
      <a href="javascript:void(0)" class="tablink" onclick="openLink(event, 'edit-tab');">تحديث البيانات الشخصية</a>
    </div>
  @else
    <div class="w3-hover-opacity w3-hover-light-gray">
      <a href="javascript:void(0)" class="tablink" onclick="openLink(event, 'contact-tab');">تواصل معي</a>
    </div>
  @endif
</div>

 <!-- on small screen -->

 <li id="bars" style="list-style-type: none;" class="w3-large w3-right w3-hide-large w3-hide-medium custom-color"><a href="javascript:void(0)" onclick="open_profile_menue()" ><i class="fa fa-bars"></i></a></li>

  <nav id="profile_menu" class="w3-hover-none w3-bar-block" style="display:none">
      <i class="fa fa-caret-up w3-xlarge"></i>
      <ul class="w3-bar w3-large mobile-menue">
          <li class="w3-right-align"><a href="javascript:void(0)" class="tablink" onclick="openLink(event, 'info-tab');">الملف الشخصي</a></li>
           @if(Auth::user()->id == $profile->id)
            <li class="w3-right-align"><a href="javascript:void(0)" class="tablink" onclick="openLink(event, 'activity-tab');"> انشطتي </a> </li>
            <li class="w3-right-align"><a href="javascript:void(0)" class="tablink" onclick="openLink(event, 'edit-tab');"> البيانات الشخصية</a></li>
          @else
          <li class="w3-right-align">
            <a href="javascript:void(0)" class="tablink" onclick="openLink(event, 'contact-tab');">تواصل معي</a>
          </li>
        @endif
      </ul>
  </nav>

<!-- Page content -->

<div class="w3-content" style="max-width:1100px;">

  <!-- user information section -->
  <div class="w3-padding-16 w3-right-align">

    <div id="info-tab" class="w3-margin-bottom myLink">

      <div class="container w3-white">
        <div class="row">
          <div class="col-sm-12">
            <h3 class="w3-margin-top"> الاهتمامات او مهارات العمل </h3>
            @if(!$profile->skills)
              <p class="w3-opacity alert alert-info">قم بتحديد اهتمامك </p>
            @else
              <p class="w3-opacity user_text w3-large">{{ $profile->skills }}</p>
            @endif
          </div>
        </div>
      </div>
      <br>

      <div class="container">
        <div class="row">
          <div class="col-sm-6 card card-body bg-light">
            <h3 class="w3-margin-right">{{ $profile->name }}</h3>
            @if(!$profile->description)
              <p class="w3-margin-right alert alert-info">قم باضافة نبذة عنك</p>
            @else
              <p class="w3-margin-right user_text">{{ $profile->description }}</p>
            @endif
          </div>

          <div class="col-sm-2"></div>

          <div class="col-sm-4">
            <!-- user avatar -->
            <img src="{{ asset($profile->image) }}" class="w3-image w3-greyscale" width="250" height="250">
          </div>
        </div>
      </div>
    </div>

    <!-- user mvp section -->
    <div id="activity-tab" class="w3-margin-bottom myLink">
      <div class="container text-center w3-white">
        <div class="row">
          <div class="col-md-6">
              <h3>مشاريعي</h3>
              @if($mvps->count())
                @foreach($mvps as $mvp)
                  <div class="w3-container w3-margin">
                    <div class="col-lg-12 w3-padding w3-light-grey">
                      <h3><a class="w3-text-blue" href="/mvp/edit/{{ $mvp->slug }}"> {{ $mvp->name }} <i class="fa fa-wrench"></i> </a></h3>
                      @if($mvp->report)
                        <div class="row w3-margin">
                          <hr>
                          <div class="col-md-6 w3-white">
                            <p class="w3-padding">تحميل  {{ $mvp->report->downloads }}</p>
                          </div>
                          <div class="col-md-6 w3-white">
                            <p class="w3-padding">مشاهدة  {{ $mvp->report->views }}</p>
                          </div>
                          <hr>
                        </div>
                      @endif
                      <form action="/profile/{{ $profile->id }}" method="post">
                        <input type="hidden" name="$request->mvp_id" value="{{ $mvp->id }}">
                        @csrf
                        <input type="submit" name="delete_mvp" class="btn btn-danger w3-margin-bottom" value="حذف">
                        @if($mvp->is_available == 1)
                          <input type="submit" name="not_available" class="btn btn-warning w3-margin-bottom" value="تعطيل المشروع">
                        @elseif($mvp->is_available == 0)
                          <input type="submit" name="is_available" class="btn btn-success w3-margin-bottom" value=" تفعيل المشروع ">
                        @endif
                      </form>
                    </div>
                  </div>
                @endforeach
                @else
                <div class="alert alert-info w3-margin-top">لم تقم باضافة مشروع بعد</div>
              @endif
          </div>

          <div class="col-md-6">
            <h3>منشوراتي</h3>
            @if($status->count())
              @foreach($status as $status)
              <div class="w3-container w3-margin">
                <div class="col-lg-12 w3-padding w3-light-grey">
                    <p class="user_text">{{ $status->body }}</p>
                    <form action="/profile/{{ $profile->id }}" method="post">
                      <input type="hidden" name="status_id" value="{{ $status->id }}">
                      {{ csrf_field() }}
                      <input type="submit" name="delete_status" class="btn btn-danger w3-margin-bottom" value="حذف">
                    </form>
                </div>
              </div>
              @endforeach
              @else
                <div class="alert alert-info w3-margin-top">لم تقم باضافة منشور بعد</div>
            @endif
          </div>

        </div>

      </div>

    </div>

    <!--  edit user information section -->
    <div id="edit-tab" class="w3-margin-bottom myLink">
      <div class="w3-white">
          <div class="w3-container">
            <h4 class="w3-margin-top">تحديث  بياناتك</h4>
            <form action="/profile/{{ $profile->id }}" method="post" enctype="multipart/form-data">
               @csrf

               <p class="form-group{{ $errors->has('name') ? ' alert alert-danger' : '' }}">
                <label for="name">اسم المستخدم</label>
                <input class="form-control w3-right-align w3-padding-16 w3-border" type="text" id="location" value="{{ $profile->name }}" name="name">
                @if ($errors->has('name'))
                  <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
              </p>

              <p class="form-group{{ $errors->has('location') ? ' alert alert-danger' : '' }}">
                <label for="location">مكان الاقامة</label>
                <input class="form-control w3-right-align w3-padding-16 w3-border" type="text" id="location" value="{{ $profile->location }}" name="location">
                @if ($errors->has('location'))
                  <span class="help-block">{{ $errors->first('location') }}</span>
                @endif
              </p>

              <p class="form-group{{ $errors->has('image') ? ' alert alert-danger' : '' }}">
                <label for="image">الصورة الشخصية</label>
                <input class="form-control w3-right-align w3-padding-16 w3-border" type="file" value="{{ $profile->image }}" id="image" name="image">
                @if ($errors->has('image'))
                  <span class="help-block">{{ $errors->first('image') }}</span>
                @endif
              </p>

              <p class="form-group{{ $errors->has('phone') ? ' alert alert-danger' : '' }}">
                <label for="phone">رقم الهاتف</label>
                <input class="form-control w3-right-align w3-padding-16 w3-border" type="text" id="phone" value="{{ $profile->phone }}" name="phone">
                @if ($errors->has('phone'))
                  <span class="help-block">{{ $errors->first('phone') }}</span>
                @endif
              </p>

              <p class="form-group{{ $errors->has('type') ? ' alert alert-danger' : '' }}">
                <label for="type">نوع الحساب</label>
                <select name="type" class="form-control">
                    <option value="business_owner">رائد اعمال</option>
                    <option value="developer">مبرمج \ مطور</option>
                </select>
                @if ($errors->has('type'))
                  <span class="help-block">{{ $errors->first('type') }}</span>
                @endif
              </p>

              <p class="form-group{{ $errors->has('skills') ? ' alert alert-danger' : '' }}">
                <label for="skills">الاهتمامات او مهارات العمل </label>
                <textarea rows="6" class="form-control w3-right-align w3-padding-16 w3-border" id="skills" name="skills">{{ $profile->skills }}</textarea>
                @if ($errors->has('skills'))
                  <span class="help-block">{{ $errors->first('skills') }}</span>
                @endif

              </p>

              <p class="form-group{{ $errors->has('description') ? ' alert alert-danger' : '' }}">
                <label for="description">نبذة مختصرة عنك</label>
                <textarea rows="6" class="form-control w3-right-align w3-padding-16 w3-border" id="description" name="description">{{ $profile->description }}</textarea>
                @if ($errors->has('description'))
                  <span class="help-block">{{ $errors->first('description') }}</span>
                @endif
              </p>


              <p><input type="submit" class="btn custom-bg w3-padding" name="btn_edit_profile" value="تحديث" /></p>
            </form>
          </div>
      </div>
    </div>

    <!--  contact me section -->
    <div id="contact-tab" class="w3-margin-bottom myLink">
      <div class="w3-white">
        @if(Auth::user()->isWorkWith($profile))
          <div class="w3-container">
            <h4 class="w3-margin-top">كيف اخدمك</h4>
            <form action="/profile/{{ $profile->id }}" method="post">
              @csrf
              <p>
                <textarea rows="6" name="message" class="form-control w3-margin-top w3-right-align w3-padding-16 w3-border" placeholder="اكتب الرسالة  هنا" required name="message"></textarea>
              </p>
              <input type="hidden" id="to" name="to" value="{{ $profile->id }}">
              <p>
                <input type="submit" class="btn custom-bg w3-padding" name="btn_contact" value="ارسال" />
              </p>
            </form>
          </div>
        @elseif(!Auth::user()->hasWorkRequestPending($profile))
          <div class="w3-container" id="work_request">
            <work_request-app :user="{{ $profile }}"></work_request-app>
          </div>
        @else
          <div class="alert alert-info">
            <p>في انتظار الموافقة على طلب العمل</p>
          </div>
        @endif
      </div>
    </div>

  </div>


<!-- End page content -->
</div>

<script src="{{ asset('assets/js/profile.js') }}"></script>
<script src="{{ asset('assets/js/mvp.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>


<!-- Footer -->
@include('layouts.footer')
