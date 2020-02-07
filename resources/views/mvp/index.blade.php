@include('layouts.header')
<body>
  <body class="w3-light-grey">

  <!-- Navigation Bar -->
  @include('layouts.nav')
  <!-- Header --> 

    <section class="container">  
        <div class="w3-white mvp-single"> 
            <div class="row">
                <div class="col-md-2">
                    <a href="{{ $mvp->mvp_file }}" class="btn custom-bg" id="mvp_btn"> 
                        <i class="fa fa-chevron-circle-down"></i> تحميل
                    </a>    
                </div>
                <div class="col-md-10">
                    <h1 class="text-right">{{ $mvp->name }}</h1>
                </div>
            </div>
            <hr>
            <div class="">
                <img src="{{ asset($mvp->image_one) }}" class="article-main-img" width="100%"> 
            </div>
            <hr>
            <div class="">
                <div class="text-right">
                    <p class="user_text lead">{{ $mvp->description }}</p> 
                    <h2>
                        <a class="btn custom-bg" href="{{ $mvp->how_to_use_file }}"> 
                            <i class="fa fa-chevron-circle-down"></i>  ملف كيفية الاستخدام

                        </a>
                    </h2> 
                </div>
                <hr>
                <div class="row"> 
                    <div class="col-md-6">
                        <img src="{{ asset($mvp->image_two) }}" class="article-main-img" width="100%"> 
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset($mvp->image_three) }}" class="article-main-img" width="100%"> 
                    </div> 
                </div>
                <hr>               
                <div class="text-right">
                    <p class="lead user_text">{{ $mvp->dev_tools }}</p> 
                </div> 
            </div> 
        </div>
    </section> 
            
    <br><br><br><br><hr>


@include('layouts.footer')

<script src="{{ asset('assets/js/mvp.js') }}"></script>
<script src="{{ asset('assets/vendor/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

</body>

</html>