<!DOCTYPE html>
<html lang="en">
<head>
    <title>Git Startup</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="قيت, استارتب, ربادة اعمال, دعم تقني, git, startup, gitstartup, قيت استارتب, تشبيك, مستثمرين, فكرة ناشئة, دعم تقني لفكرتك الناشئة, رواد الاعمال, مشروع ناشئ, تواصل مع مستثمرين, تواصل مع شركاء محتملين, ريادة اعمال السودان">
    <meta name="description" content="دعم تقني لفكرتك الناشئة">
    <meta name="author" content="Osama Mohammed">
    <link rel="stylesheet" href="assets/vendor/css/w3.css">
    <link rel="stylesheet" href="assets/vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/forms.css">

    <!-- Scripts -->
    <script src="{{ asset('assets/vendor/js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('site/images/undraw/login.png') }}" class="signimg">
                </div>
                <div class="col-md-6 fields">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <h1 class="text-secondary text-right">اهلا بك :)</h1>
                        <p class="text-">ليس لديك حساب? &nbsp;
                            <a class="text-primary" href="/register">انشاء حساب</a>
                        </p>

                        <div id="login">
                          <login-app></login-app>
                        </div>

                        <button type="submit" class="btn custom-bg w3-right">تسجيل دحول</button>
                    </form>
                </div>
            </div>
        </div>
    </body>

</html>
