<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion " id="accordionSidebar">

  <!-- Sidebar - Brand -->

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="{{ route('dashboard.index') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span class="text-right">لوحة التحكم</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-folder"></i>
      <span>جداول الموقع</span>
    </a>
    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header text-right"> جداول الموقع </h6>
        <a class="collapse-item text-right" href="{{ route('dashboard.users') }}"> جدول المستخدمين </a>
        <a class="collapse-item text-right" href="{{ route('dashboard.mvp') }}">جدول المشاريع </a>
        <a class="collapse-item text-right" href="{{  route('dashboard.status') }}">جدول الاستفسارات</a>
        <a class="collapse-item text-right" href="{{  route('dashboard.tickets') }}">جدول التذاكر</a>
        <a class="collapse-item text-right" href="{{  route('dashboard.articles') }}">جدول المقالات</a>
        <a class="collapse-item text-right" href="{{  route('dashboard.category') }}">جدول تصنيف المقالات</a>
        <a class="collapse-item text-right" href="{{  route('dashboard.mvp_type') }}">جدول تصنيف المشاريع</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard.publish_article') }}">
      <i class="fas fa-fw fa-credit-card"></i>
      <span class="text-right"> نشر مقال جديد  </span>
    </a>

    <a class="nav-link" href="{{ route('dashboard.addCategory') }}">
      <i class="fas fa-fw fa-cogs"></i>
      <span class="text-right"> اضافة تصنيف للمقالات </span>
    </a>

    <a class="nav-link" href="{{ route('dashboard.add_mvp_type') }}">
      <i class="fas fa-fw fa-cogs"></i>
      <span class="text-right"> اضافة تصنيف للمشاريع </span>
    </a>

    <a class="nav-link" href="{{ route('dashboard.add_user') }}">
      <i class="fas fa-fw fa-cogs"></i>
      <span class="text-right"> اضافة مستحدم جديد </span>
    </a>



  </li>


  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->
