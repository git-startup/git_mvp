@include('layouts.header')
<body>
  <body class="w3-light-grey">

  <!-- Navigation Bar -->
  @include('layouts.nav')
  <!-- Header -->

  <header class="content-intro">
    <div class="container">
      <br>
      <img src="{{ asset('site/images/undraw/articale_cover.png') }}" width="100%">
    </div>
  </header>

 
  <section class="articles-showcase">
    <div class="container">

      <section class="search-box">
          <h1 class="text-center">ابحث عن مقالة</h1>
          <form action="" method="get">
              <div class="form-group text-center">
                  <input id="search" type="search" name="query" class="form-control text-right" placeholder="ابحث عن مقالة">
                  <input type="submit" value="بحث" class="btn w3-black">
              </div>
          </form>
      </section>

      <hr>
      <div class="row articles">
        @foreach($articles as $article)
        <div class="col-md-4">
          <div class="article-hold w3-card text-center">
            <a href="/article/{{ $article->slug }}">
              <img src="{{ asset($article->image) }}" width="100%" class="w3-padding">
              <h2 class="w3-margin-top w3-padding">{{ $article->heading }}</h2>
            </a>
          </div>
        </div>
        @endforeach
      </div>
      <br>

    </div>

  </section>


@include('layouts.footer')

<script src="{{ asset('assets/js/mvp.js') }}"></script>
<script src="{{ asset('assets/vendor/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

</body>

</html>
