<!-- Logo -->
        <a href="index.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>G</b>S</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>جيت </b>استارتب</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->

      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ asset(Auth::user()->image) }}" class="" alt="User Image">
            </div>
            <div class="pull-right info">
              <h4>{{ Auth::user()->name }}</h4>
              <a href="#"><i class="fa fa-circle text-success"></i></a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <hr>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>جداول الموقع</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('dashboard.users') }}"><i class="fa fa-circle-o"></i> قائمة المستخدمين</a></li>
                <li><a href="{{ route('dashboard.mvp') }}"><i class="fa fa-th"></i> <span> قائمة المشاريع</span></a></li>
                <li><a href="{{ route('dashboard.status') }}"><i class="fa fa-th"></i> <span>تقرير عن منشورات المستخدمين</span></a></li>
                <li><a href="{{ route('dashboard.tickets') }}"><i class="fa fa-th"></i> <span>تذاكر المستخدمين</span></a></li>
                <li><a href="{{ route('dashboard.published_articles') }}"><i class="fa fa-th"></i> <span>المقالات في الموقع</span></a></li>
                <li><a href="{{ route('dashboard.category') }}"><i class="fa fa-th"></i> <span>قائمة التصنيفات</span></a></li>
              </ul>
            </li>

            <li>
              <a href="{{ route('dashboard.settings') }}"><i class="fa fa-circle-o"></i>اعدادت الموقع</a>
            </li>

            <li>
              <a href="{{ route('dashboard.publish_article') }}"><i class="fa fa-circle-o"></i>نشر مقالة</a>
            </li>

            <li>
              <a href="{{ route('dashboard.addCategory') }}"><i class="fa fa-circle-o"></i>اضافة تصنيف</a>
            </li>

            <li>
              <a href="{{ route('dashboard.register') }}"><i class="fa fa-user"></i> اضافة مطور  </a>
            </li>
            <hr>
            <li>
                <a href="{{ route('logout') }}" class="w3-bar-item w3-button w3-padding w3-right-align" style="text-decoration: none;" 
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();" class="w3-bar-item w3-center w3-button w3-hover-dark-grey">تسجيل خروج</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
            </li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>