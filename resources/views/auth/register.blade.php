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
        <div class="row w3-card-4 w3-margin w3-padding-16" style="padding-bottom: 80px!important">
            <div class="col-md-6">
                <img src="{{ asset('site/images/undraw/register.png') }}" class="signimg">
            </div>
            <div class="col-md-6 signup">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <h1 class="text-secondary text-right">انشاء حساب جديد</h1>
                    <p class="text-secondary">لديك حساب  ? &nbsp;
                        <a class="text-primary" href="/login">تسجيل دخول</a>
                    </p>

                    <div id="register">
                      <register-app></register-app>
                    </div>

                    <button type="submit" class="btn custom-bg w3-right">انشاء حساب</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
