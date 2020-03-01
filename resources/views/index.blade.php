@include ('layouts.header')

<body dir="rtl">

<!--  add project section shuld be hear -->


    <!-- Header area start   -->
    <header class="header-area">
      <nav class="navbar navbar-expand-lg navbar-light top-nav">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon custom-bg"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <hr class="">
              <ul class="navbar-nav ml-auto nav-links w3-right-align">
                <li><a class="nav-item nav-link w3-large" href="#community"> اخر المقالات  </a></li>
                <li><a class="nav-item nav-link w3-large" href="#services">مشاريع مميزة</a></li>
                <li><a class="nav-item nav-link w3-large" onclick="open_add_project()" href="#">ابدء مشروعك معنا</a></li>
              </ul>
          </div>
      </nav>
    </header>
    <!-- Header area End -->

    <!-- inrto start -->
    <section class="carousel-area">
      <div class="intro-content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="section-top text-center w3-text-white wow bounceIn" data-wow-duration="1s" data-wow-delay=".5s" data-wow-offset="10" data-wow-iteration="1">
                <h1 class="w3-xxlarge">gitstartup</h1>
                <p class="w3-xxlarge">دعم تفني لفكرتك الناشئة</p>
              </div>
              <div class="w3-padding">
                <form method="POST" action="{{ route('register') }}">
                  @csrf
                  <div id="home_register">
                    <home_register-app></home_register-app>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end intro section -->

    <!-- owl-carousel slider Start -->
    <section class="container" dir="ltr">
      <div class="carousel-slider owl-carousel text-center">
        <div class="single-slide w3-card-4">
            <div class="w3-container w3-border">
                <h5 class="w3-margin w3-large">فريق تقني متكامل لمساعدتك</h4>
                <span class="fa fa-code w3-xxlarge"></span>
                <p>
                  افضل المطورين والمصممين كلهم على استعداد كامل لتقديم يد المساعدة
                </p>
            </div>
        </div>
        <div class="single-slide w3-card-4">
            <div class="w3-container w3-card w3-border">
                <h5 class="w3-margin w3-large">فرص عمل وتشبيك للجميع</h4>
                <span class="fa fa-feed w3-xxlarge"></span>
                <p>
                  سجل دخولك للموقع لتتمكن من مشاركة افكارك وتستفيد من خدمات التشبيك والعمل
                </p>
            </div>
        </div>
        <div class="single-slide w3-card-4">
            <div class="w3-container w3-border">
                <h5 class="w3-margin w3-large">مجتمع تقني متفاعل لتطوير المجال</h4>
                <span class="fa fa-smile-o w3-xxlarge"></span>
                <p>
                  نحن نعمل جاهدين لتطوير مجتمع تقني قادر على تطوير حلول لمجابهة تحديات ريادة الاعمال
                </p>
            </div>
        </div>
      </div>
    </section>
    <!-- end owl-carousel slider section -->

    <!-- about-us Section -->
    <section class="container our-community" id="community" dir="rtl">
        <div class="row text-right">
            <div class="col-md-6">
                <div class="w3-margin">
                    <h1>ماذا تستفيد</h1>
                    <p class="w3-large">
                        اننا في قيت استارتب نسعى لتكوين مجتمع تقني قادر على مجابهة التحديات التي تواجه ريادة الاعمال
                        انشئ حسابك لتتمكن من الانضمام لمجتمعنا
                    </p>
                    <div class="">
                        <a href="{{ route('login') }}" class="btn custom-bg w3-margin w3-text-white">تسجيل دخول</a>
                        <a href="{{ route('register') }}" class="btn custom-bg w3-margin w3-text-white">انشاء حساب جديد</a>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="">
                    <img src="site/images/logo.png" width="100%">
                </div>
            </div>
        </div>
    </section>

    <!-- last projects section -->
    <section class="projects_portfolio text-center">
        <h1>اخر المشاريع</h1>
        <div class="row">
            <div class="col-md-3 wow bounceInLeft" data-wow-duration=".5s" data-wow-delay=".5s">
                <a href="#" class="w3-hover-text-grey" style="text-decoration: none">
                    <div class="w3-padding w3-margin w3-border">
                    <img src="site/images/works/2.jpg" alt="" class="img-fluid">
                    <p class="w3-large w3-margin-top">Lorem ipsum dolor sit amet</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 wow bounceInLeft" data-wow-duration="1s" data-wow-delay=".5s">
                <a href="#" class="w3-hover-text-grey" style="text-decoration: none">
                    <div class="w3-padding w3-margin w3-border">
                    <img src="site/images/works/4.jpg" alt="" class="img-fluid">
                    <p class="w3-large w3-margin-top">Lorem ipsum dolor sit amet</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 wow bounceInLeft" data-wow-duration="1.5s" data-wow-delay=".5s">
                <a href="#" class="w3-hover-text-grey" style="text-decoration: none">
                    <div class="w3-padding w3-margin w3-border">
                    <img src="site/images/works/6.jpg" alt="" class="img-fluid">
                    <p class="w3-large w3-margin-top">Lorem ipsum dolor sit amet</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 wow bounceInLeft" data-wow-duration="2s" data-wow-delay=".5s">
                <a href="#" class="w3-hover-text-grey" style="text-decoration: none">
                    <div class="w3-padding w3-margin w3-border">
                    <img src="site/images/works/5.jpg" alt="" class="img-fluid">
                    <p class="w3-large w3-margin-top">Lorem ipsum dolor sit amet</p>
                    </div>
                </a>
            </div>
        </div>
    </section>
    <!-- end last projects section -->

    <!-- call to action section -->
    <section class="container w3-padding w3-card call-action">
      <div class="w3-right">
          <div class="w3-padding">
              <h3> سجل دخولك الان وابدء العمل مع افضل المبرمجين </h3>
          </div>
      </div>
      <div class="">
          <div class="w3-padding">
              <a href="#" class="btn custom-bg w3-xlarge">تسجيل دخول جديد</a>
          </div>
      </div>
    </section>
    <!-- end call to action -->

    <!-- our articals sction -->
    <section class="container our-articals text-center">
        <h1 class="w3-margin">اخر المقالات</h1>
        <div class="row">
            <div class="col-md-4">
              <a href="#">
                <div class="w3-border w3-margin">
                    <img src="site/images/articals/img1.jpg" width="100%" height="100%">
                    <p class="w3-padding">Lorem ipsum dolor sit amet, has ei ipsum scaevola deseruisse am sea facilisis.</p>
                </div>
              </a>
            </div>
            <div class="col-md-4">
              <a href="#">
                <div class="w3-border w3-margin">
                    <img src="site/images/articals/img2.jpg" width="100%" height="100%">
                    <p class="w3-padding">Lorem ipsum dolor sit amet, has ei ipsum scaevola deseruisse am sea facilisis.</p>
                </div>
              </a>
            </div>
            <div class="col-md-4">
              <a href="#">
                <div class="w3-border w3-margin">
                    <img src="site/images/articals/img3.jpg" width="100%" height="100%">
                    <p class="w3-padding">Lorem ipsum dolor sit amet, has ei ipsum scaevola deseruisse am sea facilisis.</p>
                </div>
              </a>
            </div>
        </div>
    </section>
    <!-- end our articals section -->


    <!-- footer section -->
    <section>
        <footer class="w3-center w3-white w3-padding-32 w3-light-grey w3-opacity w3-margin-top" style="margin-top: 100px!important">
          <h5> تابع صفحاتنا على مواقع اتواصل الاجتماعي  </h5>
          <div class="w3-xlarge w3-padding-16">
            <i class="fa fa-facebook-official w3-hover-opacity"></i>
            <i class="fa fa-twitter w3-hover-opacity"></i>
            <i class="fa fa-linkedin w3-hover-opacity"></i>
          </div>
          <p>تم التطوير بواسطة <a href="#" target="_blank" class="w3-hover-text-black"> فريق git startup    </a></p>
        </footer>
    </section>
    <!-- end footer section -->



    <script src="{{ asset('assets/js/mvp.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/owl-carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/wow.min.js') }}"></script>
    <script>
        new WOW().init();
    </script>


</body>
</html>
