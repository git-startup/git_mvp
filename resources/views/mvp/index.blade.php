@include('layouts.header')
<body>
  <body class="w3-light-grey">

  <!-- Navigation Bar -->
  @include('layouts.nav')
  <!-- Header -->

    <section class="container">
        <div class="w3-white mvp-single">
            <div class="row">
              <div class="col-md-10">
                  <h1 class="text-right w3-margin-bottom">{{ $mvp->name }}</h1>
              </div>
                <div class="col-md-2">
                    <a href="{{ $mvp->mvp_link }}" class="btn" id="mvp_btn">
                        <i class="fa fa-chevron-circle-down"></i> رابط التحميل
                    </a>
                </div>
            </div>

            <hr>
            <div class="">
                <div class="text-right">
                    <p class="user_text lead">{{ $mvp->description }}</p>
                </div>
                <hr>
                <div class="text-right">
                    <p class="lead user_text">{{ $mvp->dev_tools }}</p>
                </div>
              </div>

            <div class="row">
              @if($mvp->files->count() == 0)
                <div class="">
                  <button type="button" onclick="document.getElementById('mvp_files_model').style.display='block'" class="w3-btn w3-card-4 w3-light-grey"> تحميل ملفات المشروع </button>
                </div>
              @else
                <div class="">
                  <button type="button" onclick="document.getElementById('mvp_features_file_model').style.display='block'" class="w3-btn w3-card-4 w3-light-grey"> تحميل فيتشر جديدة </button>
                </div>
              @endif

              @if($mvp->user_id == Auth::user()->id)
                <div id="mvp_files_model" class="w3-modal"> <!-- to upload mvp files -->
                  <div class="w3-modal-content brnda-card-4 w3-animate-zoom" style="max-width:880px">
                    <div class="brnda-card">
                      <header class="w3-container w3-padding brnda-card"><i class="glyphicon glyphicon-upload"></i>
                          <h6 class="text-right"><i class="fa fa-file"></i> اضغط في المساحة الفارغة لرفع ملفات المشروع </h6>
                          <span onclick="document.getElementById('mvp_files_model').style.display='none'" class="w3-btn w3-display-topleft">×</span>
                      </header>
                      <div class="container text-right">
                        <div id="mvp_msg"></div>
                        <div class="w3-section">
                          <div class="dropzone dz-clickable" id="mvp_myDrop">
                            <div class="dz-default dz-message" data-dz-message="">
                            </div>
                          </div>
                          <br>
                          <footer class="w3-margin-right">
                            <a href="#" class="w3-button w3-white w3-border w3-border-gray w3-round w3-text-gray w3-hover-light-gray w3-hover-text-gray" id="upload_mvp_files" style="padding: 7px 15px"><i class="fa fa-check-square-o  w3-margin-left-8  w3-text-gray"></i> موافق</a>
                            <button type="button" onclick="document.getElementById('mvp_files_model').style.display='none'"
                              class="w3-button w3-border w3-hover-light-gray w3-text-gray w3-round" style="padding: 7px 15px;"><i class="fa fa-arrow-right"></i> إلغاء</button>
                          </footer>
                          <br>
                        </div>
                      </div>
                    </div>
                  </div>
              </div><!-- end mvp files model-->

              <!-- to upload mvp features files -->
              <div id="mvp_features_file_model" class="w3-modal">
                <div class="w3-modal-content brnda-card-4 w3-animate-zoom" style="max-width:880px">
                  <div class="brnda-card">
                    <header class="w3-container w3-padding brnda-card"><i class="glyphicon glyphicon-upload"></i>
                        <h6 class="text-right"><i class="fa fa-file"></i> اضغط في المساحة الفارغة لرفع ملفات الفيتشر </h6>
                        <span onclick="document.getElementById('mvp_features_file_model').style.display='none'" class="w3-btn w3-display-topleft">×</span>
                    </header>
                    <div class="container text-right">
                      <div id="feature_msg"></div>
                      <div class="w3-section">
                        <div class="dropzone dz-clickable" id="feature_myDrop">
                          <div class="dz-default dz-message" data-dz-message="">
                          </div>
                        </div>
                        <br>
                        <footer class="w3-margin-right">
                          <a href="#" class="w3-button w3-white w3-border w3-border-gray w3-round w3-text-gray w3-hover-light-gray w3-hover-text-gray" id="upload_mvp_features_files" style="padding: 7px 15px"><i class="fa fa-check-square-o  w3-margin-left-8  w3-text-gray"></i> موافق</a>
                          <button type="button" onclick="document.getElementById('mvp_features_file_model').style.display='none'"
                            class="w3-button w3-border w3-hover-light-gray w3-text-gray w3-round" style="padding: 7px 15px;"><i class="fa fa-arrow-right"></i> إلغاء</button>
                        </footer>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
            </div><!-- mvp features model-->
            @endif
          </div>
        </div>
    </section>

    <br><br><br><br><hr>


  @include('layouts.footer')

  <script src="{{ asset('assets/js/mvp.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/script.js') }}"></script>

  <script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
      showDivs(slideIndex += n);
    }

    function showDivs(n) {
      var i;
      var x = document.getElementsByClassName("mySlides");
      if (n > x.length) {slideIndex = 1}
      if (n < 1) {slideIndex = x.length}
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      x[slideIndex-1].style.display = "block";
    }
  </script>

  <!-- dropzone -->
  <script src="{{ asset('assets/vendor/js/dropzone/dropzone.js') }}"></script>
  <script src="{{ asset('assets/js/mvp.js') }}"></script>
  <script src="{{ asset('assets/js/feature.js') }}"></script>

</body>

</html>
