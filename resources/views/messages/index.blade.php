@include('layouts.header')

<body class="w3-light-grey">

<!-- Navigation Bar -->
@include('layouts.nav')


<br><br>
<div class="container w3-margin-top">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header w3-right-align">
                قائمة الاتصال الخاصة بك     <i class="fa fa-bars w3-button w3-xlarge w3-margin-left w3-margin-top" onclick="open_contacts_list()"></i>
                </div>

                <div class="card-body" id="app">
                    <chat-app :user="{{ Auth::user() }}"></chat-app>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/mail.js') }}"></script>
<script src="{{ asset('assets/vendor/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>


<!-- Footer -->
@include('layouts.footer')
