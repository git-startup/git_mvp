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
            <!-- slider -->
            <div class="w3-display-container">
              @if($mvp->gallery->count())
                @foreach($mvp->gallery as $image)
                  <div class="w3-display-container w3-tooltip">
                      <img width="100%" class="mySlides" src="{{ asset('site/mvp/images/'.$image->url) }}" alt="mvp image" height="100%" width="100%">
                  </div>
                @endforeach
                <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
                <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
              @endif
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
              @if($mvp->user_id == Auth::user()->id)
                @if(!$mvp->gallery->count())
                <div class="container text-right">
                  <h4>صور المشروع </h4>
                  <div class="w3-panel w3-light-gray w3-leftbar w3-rightbar w3-border-black">
                    <div class="w3-padding-32">
                        <p>أقصى حجم مسموح به للصورة الواحدة هو <strong dir="ltr">5 MB</strong></p>
                        <p>أقصى عدد مسموح به من الصور للرفع في مرة واحدة هو 15 صورة</p>
                    </div>
                  </div>

                  <!-- confirm message model -->
                  <div id="msg" class="w3-modal">
                    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:480px">
                        <header class="w3-container brnda-card">
                            <h4 class="alert alert-success"> تم اضافة الصور بنجاح   </h4>
                        </header>
                        <footer class="w3-container ">
                          <div class="w3-margin-top w3-margin-bottom w3-right">
                              <input type="hidden" value="{{ $mvp->id }}" name="mvp_id" />
                              <a href="{{ route('mvp.index',['slug' => $mvp->slug]) }}" class="w3-btn w3-card w3-ripple w3-margin-left"><i class="fa fa-check-square"></i> موافق</a>
                          </div>
                        </footer>
                    </div>
                  </div>
                  <!-- end confirm message model -->

                  <div class="w3-section">
                    <div class="dropzone dz-clickable" id="myDrop">
                      <div class="dz-default dz-message" data-dz-message="">
                          <p class="w3-center"> <i class="fa fa-upload w3-large"></i> اضغط هنا لاختيار الصور  </p>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
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

<script>
    //Dropzone script
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("div#myDrop",
        {
            paramName: "files", // The name that will be used to transfer the file
            addRemoveLinks: true,
            uploadMultiple: true,
            autoProcessQueue: true,
            parallelUploads: 50,
            maxFilesize: 2, // MB
            acceptedFiles: ".png, .jpeg, .jpg, .gif",
            url: "http://localhost:8000/mvp/gallery?mvp_id={{ $mvp->id }}",
        });


    /* Add Files Script*/
    myDropzone.on("success", function(file, images){
        //$("#images").html(images);
        //setTimeout(function(){window.location.href="index.php"},800);
      // $("#msg").html('<div class="alert alert-success">تم تحميل الصور بنجاح</div>');
      document.getElementById('msg').style.display = 'block';
    });

    myDropzone.on("error", function (data) {
        $("#msg").html('<div class="alert alert-danger">حصل خطأ اثناء التحميل الرجاء اعادة المحاولة في وقت لاحق</div>');
    });

    myDropzone.on("complete", function(file) {
        myDropzone.removeFile(file);
    });

    $("#upload_images").on("click",function (){
        myDropzone.processQueue();
    });
</script>

</body>

</html>
