@include('layouts.header')
<body>
  <body class="w3-light-grey">

  <!-- Navigation Bar -->
  @include('layouts.nav')
  <!-- Header -->

    <section class="container">
        <div class="w3-white mvp-single">
            <div class="row">
              <div class="col-md-12">
                <h1 class="text-right w3-text-blue w3-margin-bottom"> <a href="{{ $mvp->mvp_link }}"> {{ $mvp->name }} </a> </h1>
                <div id="carousel_{{ $mvp->id }}" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    <?php $count = 0 ?>
                    @foreach($mvp->images as $image)
                    <?php if($count == 0) : ?>
                      <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('site/mvp/images/'.$image->url)  }}"  alt="صور المشروع">
                      </div>
                    <?php else : ?>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('site/mvp/images/'.$image->url)  }}"  alt="صور المشروع">
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
            </div>

            <div class="text-right">
              <div class="">
                <h3>وصف المشروع</h3>
                <p class="user_text lead">{{ $mvp->description }}</p>
              </div>

              <div class="w3-margin-top">
                <h3>الادوات المستخدمة في التطوير</h3>
                <p class="lead user_text">{{ $mvp->dev_tools }}</p>
              </div>

              @if($mvp->features)
                @foreach($mvp->features as $feature)
                  @if($feature->username == Auth::user()->username)
                    <div class="w3-margin-top">
                      <h3>ملفات المشروع</h3>
                      <div>
                        <div class="w3-light-grey w3-padding w3-card">
                          <h4>{{ $feature->name }} <a href="/{{ $feature->url }}"> <i class="fa fa-download w3-text-blue"></i>  </a> </h4>
                          <p class="user_text">{{ $feature->description }}</p>
                        </div>
                      </div>
                    </div>
                  @endif
                @endforeach
              @endif
            </div>

            <div class="row">
              @if($mvp->user_id == Auth::user()->id)
                @if($mvp->images->count() == 0)
                  <div class="w3-margin">
                    <button type="button" onclick="document.getElementById('mvp_files_model').style.display='block'" class="w3-btn w3-card-4 w3-light-grey"> تحميل صور للمشروع </button>
                  </div>
                @endif

                <div class="w3-margin">
                  <button type="button" onclick="document.getElementById('mvp_features_file_model').style.display='block'" class="w3-btn w3-card-4 w3-light-grey">  اضافة ملف للمشروع  </button>
                </div>

              @endif

              @if($mvp->user_id == Auth::user()->id)
                <div id="mvp_files_model" class="w3-modal"> <!-- to upload mvp files -->
                  <div class="w3-modal-content brnda-card-4 w3-animate-zoom" style="max-width:880px">
                    <div class="brnda-card">
                      <header class="w3-container w3-padding brnda-card"><i class="glyphicon glyphicon-upload"></i>
                          <h6 class="text-right"><i class="fa fa-image"></i> اضغط على المساحة الفارغة لتحميل صور المشروع </h6>
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
                            <button class="btn btn-success w3-round" id="upload_mvp_images" style="padding: 7px"><i class="fa fa-upload"></i> تحميل </button>
                            <button type="button" onclick="document.getElementById('mvp_files_model').style.display='none'"
                              class="btn btn-danger w3-round" style="padding: 7px;"><i class="fa fa-arrow-right"></i> إلغاء</button>
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
                  <div class="w3-card w3-padding">
                    <div class="container text-right">
                      <div class="w3-section">
                        <form id="add_feature_form" action="{{ route('mvp.store') }}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="form-grop">
                            <label for="name">اسم توضيحي</label>
                            <input type="text" name="name" id="name" class="form-control">
                          </div>
                          <div class="form-grop w3-margin-top">
                            <label for="name"> حصر الوصول للملف لمستخدم واحد - اختياري </label>
                            <input list="users" name="username" class="form-control">
                            <datalist id="users">
                              @foreach($users as $user)
                                <option value="{{ $user->username }}">
                              @endforeach
                            </datalist>
                          </div>
                          <div class="form-group w3-margin-top">
                            <label for="description">وصف عام </label>
                            <textarea name="description" id="description" rows="8" cols="80" class="form-control"></textarea>
                          </div>
                          <div class="form-group w3-margin-top">
                            <label for="file">ارفاق ملف</label>
                            <input type="file" name="file" id="file" class="form-control">
                          </div>
                          <input type="hidden" name="mvp_id" value="{{ $mvp->id }}">
                        </form>
                        <br>
                        <footer class="w3-margin-right">
                          <button type="submit" form="add_feature_form" class="btn btn-success w3-round"  style="padding: 7px"><i class="fa fa-check"></i> موافق</button>
                          <button type="button"  onclick="document.getElementById('mvp_features_file_model').style.display='none'"
                            class="btn btn-danger w3-round" style="padding: 7px;"><i class="fa fa-arrow-right"></i> إلغاء</button>
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
  <script src="{{ asset('assets/js/feature.js') }}"></script>

  <script>
    //Dropzone script
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("div#mvp_myDrop",
        {
            paramName: "images", // The name that will be used to transfer the file
            addRemoveLinks: true,
            uploadMultiple: true,
            autoProcessQueue: false,
            parallelUploads: 20,
            maxFilesize: 10, // MB
            acceptedFiles: ".png, .jpeg, .jpg, .gif, .zip, .pdf",
            url: "http://localhost:8000/mvp/images/upload?mvp_id={{ $mvp->id }}",
        });
    /* Add Files Script*/
    myDropzone.on("success", function(file, images){
        //$("#msg").html(images);
        setTimeout(function(){window.location.href="http://localhost:8000/mvp/{{ $mvp->slug }}"},800);
       //$("#msg").html('<div class="alert alert-success">تم تحميل الصور بنجاح</div>');
      //document.getElementById('msg').style.display = 'block';
    });
    myDropzone.on("error", function (data) {
        $("#mvp_msg").html('<div class="alert alert-danger">حصل خطأ اثناء التحميل الرجاء اعادة المحاولة في وقت لاحق</div>');
    });
    myDropzone.on("complete", function(file) {
        myDropzone.removeFile(file);
    });
    $("#upload_mvp_images").on("click",function (){
        myDropzone.processQueue();
    });


    function open_add_project() {
      var mvp = document.getElementById("add_mvp");
      if (mvp.style.display === 'block') {
          mvp.style.display = 'none';
          //overlayBg.style.display = "none";
      } else {
          mvp.style.display = 'block';
          //overlayBg.style.display = "block";
      }
    }

    function close_add_project() {
        mvp.style.display = "none";
        //overlayBg.style.display = "none";
    }
  </script>
</body>

</html>
