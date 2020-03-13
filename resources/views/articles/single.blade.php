@include('layouts.header')
<body>
  <body class="w3-light-grey">

  <!-- Navigation Bar -->
  @include('layouts.nav')
  <!-- Header -->

    <div class="container">
        <article class="single-article text-right">
            <h1>{{ $article->heading }}</h1>
            <img src="{{ asset($article->image) }}" width="100%" class="article-main-img">
            <div class="article-text">
                <p dir="auto" class="lead user_text">{{ $article->content }}</p>
            </div>
                <h2>{{ $article->sub_heading }}</h2>
                <hr>
                <img src="{{ asset($article->bottom_image) }}" class="article-main-img" width="50%">
                <div class="article-text">
                <p class="lead user_text">{{ $article->bottom_content }}</p>
            </div>
        </article>
        <br>
        <hr>
        <!-- comment section -->
        <section>
            <br>
            <div class="another-articles">
            <h2 class="text-right">مقالات مشابهة</h2>
            <div class="row">
                @if($related_articles->count())
                    @foreach($related_articles as $related_article)
                    <div class="col-md-4">
                        <div class="article-hold text-center w3-card">
                            <a href="/article/{{ $article->slug }}">
                                <img src="{{ asset($related_article->image) }}">
                                <h1>{{ $related_article->heading }}</h1>
                            </a>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-md-12 text-right alert alert-info">لا توجد مقالات مشابهة لعرضها حاليا</div>
                @endif
            </div>
        </div>
        </section>
    </div>

    <br><br><br><br><hr>


@include('layouts.footer')

<script src="{{ asset('assets/js/mvp.js') }}"></script>
<script src="{{ asset('assets/vendor/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

</body>

</html>
