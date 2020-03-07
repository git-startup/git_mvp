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
          <div class="card" style="width: 100%;">
            <ul class="list-group list-group-flush">
                  @if($mvps->count())
                    @foreach($mvps as $mvp)
                        <li class="list-group-item bg-light w3-card w3-margin text-right">
                          <div class="w3-right">
                            <p style="position: relative; top: 5px;"><a href="/mvp/{{ $mvp->slug }}" class="w3-text-black">{{ $mvp->name }}</a></p>
                              <div id="carousel_{{ $mvp->id }}" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                  <?php $count = 0 ?>
                                  @foreach($mvp->images as $image)
                                  <?php if($count == 0) : ?>
                                    <div class="carousel-item active">
                                      <img class="d-block w-100" src="{{ asset('site/mvp/images/'.$image->url)  }}" height="200px" alt="صور المشروع">
                                    </div>
                                  <?php else : ?>
                                    <div class="carousel-item">
                                      <img class="d-block w-100" src="{{ asset('site/mvp/images/'.$image->url)  }}" height="200px" alt="صور المشروع">
                                    </div>
                                  <?php endif; ?>
                                  <?php $count += 1 ?>
                                  @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carousel_{{ $mvp->id }}" role="button" data-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel_{{ $mvp->id }}" role="button" data-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span>
                                </a> <br>
                              </div>
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

      <script src="{{ asset('assets/vendor/js/jquery.min.js') }}"></script>

<!-- Footer -->
@include('layouts.footer')
