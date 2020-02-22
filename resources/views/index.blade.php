@include ('layouts.header')

<body dir="">

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
                <li><a class="nav-item nav-link" href="#community"> اخر المقالات  </a></li>
                <li><a class="nav-item nav-link" href="#services">مشاريع مميزة</a></li>
                <li><a class="nav-item nav-link" onclick="open_add_project()" href="#">ابدء مشروعك معنا</a></li>
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
            <div class="w3-model-content" style="width: 60%;margin: 0 20%">
              <div class="section-top text-center w3-text-white wow bounceIn" data-wow-duration="1s" data-wow-delay=".5s" data-wow-offset="10" data-wow-iteration="1">
                <h1 class="w3-xxlarge">Git Startup</h1>
                <p class="w3-xxlarge">دعم تفني لفكرتك الناشئة</p>
              </div>
              <div class="">
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
    <div class="container">
      <div class="carousel-slider owl-carousel text-center">
          <div class="single-slide">
              <div class="w3-container w3-card w3-border w3-black">
                  <h5 class="w3-margin w3-large">Lorem ipsum dolor sit amet,</h4>
                  <span class="fa fa-code w3-xxlarge custom-color"></span>
                  <p>
                      Lorem ipsum dolor sit amet, has ei ipsum scaevola deseruisse am sea facilisis.
                  </p>
              </div>
          </div>
          <div class="single-slide">
              <div class="w3-container w3-white w3-card w3-border w3-black">
                  <h5 class="w3-margin w3-large">Lorem ipsum dolor sit amet,</h4>
                  <span class="fa fa-feed w3-xxlarge custom-color"></span>
                  <p>
                      Lorem ipsum dolor sit amet, has ei ipsum scaevola deseruisse am sea facilisis.
                  </p>
              </div>
          </div>
          <div class="single-slide">
              <div class="w3-container w3-white w3-card w3-border w3-black">
                  <h5 class="w3-margin w3-large">Lorem ipsum dolor sit amet,</h4>
                  <span class="fa fa-smile-o w3-xxlarge custom-color"></span>
                  <p>
                      Lorem ipsum dolor sit amet, has ei ipsum scaevola deseruisse am sea facilisis.
                  </p>
              </div>
          </div>
      </div>
    </div>
    <!-- end owl-carousel slider section -->

    <!-- about-us Section -->
    <section class="container our-community" id="community" dir="rtl">
        <div class="row text-right">
            <div class="col-md-6">
                <div class="w3-margin">
                    <p class="w3-large">
                        اننا في قيت استارتب نسعى لتكوين مجتمع تقني قادر على مجابهة التحديات التي تواجه ريادة الاعمال
                        انشئ حسابك لتتمكن من الانضمام لمجتمعنا
                    حيث نعمل على اقامة ورش ودورات تربط بين ريادة الاعمال وتقنية المعلومات من اجل تطوير منتجات قادرة على تلبية احتياجات العملاء المتغيرة
                    </p>
                    <div class="w3-hide-small">
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
                <a href="#">
                    <div class="w3-padding-16">
                    <img src="site/images/works/2.jpg" alt="" class="img-fluid">
                    <p class="w3-large w3-margin-top">Lorem ipsum dolor sit amet, has ei ipsum</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 wow bounceInLeft" data-wow-duration="1s" data-wow-delay=".5s">
                <a href="#">
                    <div class="w3-padding-16">
                    <img src="site/images/works/4.jpg" alt="" class="img-fluid">
                    <p class="w3-large w3-margin-top">Lorem ipsum dolor sit amet, has ei ipsum</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 wow bounceInLeft" data-wow-duration="1.5s" data-wow-delay=".5s">
                <a href="#">
                    <div class="w3-padding-16">
                    <img src="site/images/works/6.jpg" alt="" class="img-fluid">
                    <p class="w3-large w3-margin-top">Lorem ipsum dolor sit amet, has ei ipsum</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 wow bounceInLeft" data-wow-duration="2s" data-wow-delay=".5s">
                <a href="#">
                    <div class="w3-padding-16">
                    <img src="site/images/works/5.jpg" alt="" class="img-fluid">
                    <p class="w3-large w3-margin-top">Lorem ipsum dolor sit amet, has ei ipsum</p>
                    </div>
                </a>
            </div>
        </div>
    </section>
    <!-- end last projects section -->

    <!-- call to action section -->
    <section class="container w3-opacity w3-padding w3-card call-action">
        <div class="row">
            <div class="col-md-8">
                <div class="w3-padding">
                    <h3>Special price in very limited times</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="w3-padding">
                    <a href="#" class="btn custom-bg w3-xlarge">Call Action</a>
                </div>
            </div>
        </div>
    </section>
    <!-- end call to action -->

    <!-- our articals sction -->
    <section class="container our-articals text-center">
        <h1 class="w3-margin">اخر المقالات</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="w3-border">
                    <img src="site/images/articals/img1.jpg" width="100%" height="100%">
                    <p class="w3-padding">Lorem ipsum dolor sit amet, has ei ipsum scaevola deseruisse am sea facilisis.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="w3-border">
                    <img src="site/images/articals/img2.jpg" width="100%" height="100%">
                    <p class="w3-padding">Lorem ipsum dolor sit amet, has ei ipsum scaevola deseruisse am sea facilisis.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="w3-border">
                    <img src="site/images/articals/img3.jpg" width="100%" height="100%">
                    <p class="w3-padding">Lorem ipsum dolor sit amet, has ei ipsum scaevola deseruisse am sea facilisis.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- end our articals section -->


    <!-- footer section -->
    <section>
        <footer class="footer w3-large" id="contact">
            <div class="row">
              <div class="col-lg-12 text-right">
                <p class="w3-margin">
                    <?php echo date('Y') ?> جميع الحقوق محفوظة لدى   قيت استارتب
                </p>
              </div>
            </div>
          </div>
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
