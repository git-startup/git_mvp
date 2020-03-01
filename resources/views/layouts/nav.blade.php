<nav class="w3-bar w3-black">
  <a href="javascript:void(0)" onclick="open_main_nav()" class="w3-large w3-hide-large w3-bar-item w3-right w3-hide-medium" ><i class="fa fa-bars w3-text-white"></i></a>

  <a href="javascript:void(0)" onclick="user_avatar_menu()" class="w3-bar-item w3-button w3-hover-dark-grey">

    <img src="{{ asset( Auth::user()->image )}}" style="width: 25px;height: 25px;" class="w3-circle"></a>

  <div id="main_nav_links" class="w3-hide-small">

    <div id="notification">
      <notification-app></notification-app>
    </div>


    <a href="{{ route('mvp.add') }}" class="w3-bar-item w3-hover-dark-grey w3-button w3-right w3-mobile w3-border-top"><i class="fa fa-code"></i> اضف مشروع</a>

    <a href="{{ route('mvp.list') }}" class="w3-bar-item w3-hover-dark-grey w3-button w3-right w3-mobile w3-border-top"><i class="fa fa-code-fork"></i>  المشاريع</a>

    <a href="{{ route('social.index') }}"class="w3-bar-item w3-hover-dark-grey w3-right w3-button w3-mobile w3-border-top"><i class="fa fa-lightbulb-o"></i> استفسار جديد </a>

    <a href="{{ route('articles.list') }}"class="w3-bar-item w3-hover-dark-grey w3-right w3-button w3-mobile w3-border-top"><i class="fa fa-link"></i>  المقالات </a>

  </div>
</nav>

<!-- User Avatar Menu -->
<div class="w3-dropdown-content w3-border-top w3-black w3-border-bottom w3-bar-block notification_content" id="drop_content_profile" style="left: 0px">
    <a href="/profile/{{ Auth::user()->id }}" class="w3-bar-item w3-hover-dark-grey w3-center w3-button"> الملف الشخصي   </a>
      <a href="{{ route('logout') }}" style="text-decoration: none;"
          onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();" class="w3-bar-item w3-center w3-button w3-hover-dark-grey">تسجيل خروج</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
      </form>
</div>


@include('layouts.alerts')
