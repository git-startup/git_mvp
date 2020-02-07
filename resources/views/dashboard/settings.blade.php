@include('dashboard/layout/header')

  <body class="skin-blue sidebar-mini" dir="rtl">
    <div class="wrapper">

      <header class="main-header">
        

      @include('dashboard/layout/aside')
      

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      
      @include('dashboard/layout/alert')

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-lg-2"></div>
            <!--  column -->
            <div class="col-lg-8">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"> تعديل اعدادات الموقع  </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('dashboard.settings') }}" method="post" enctype="multipart/form-data" >
                  @csrf
                  <div class="box-body">
                    <div class="form-group">
                      <label >اسم الموقع</label>
                      <input type="text" class="form-control" value="{{ $settings->name }}" name="site_name">
                      @if ($errors->has('name'))
                        <span class="alert-danger">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  <div class="box-footer">
                    <input type="hidden" name="id" value="{{ $settings->id }}">
                    <input type="submit" name="btn_setting" class="btn btn-primary" value="تحديث">
                  </div>
                </form>
              </div><!-- /.box -->
            </div><!--/.col (left) -->

            <div class="col-lg-2"></div>

          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Git Startup</b> 
        </div>
        <strong>Copyright &copy; <?php echo date('Y') ?> <a href="#">Git Startup</a>.</strong> All rights reserved.
      </footer>

    
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('dashboard/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- Bootstrap 3.3.4 -->
    <script src="{{ asset('dashboard/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('dashboard/plugins/fastclick/fastclick.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dashboard/dist/js/app.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('dashboard/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('dashboard/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{ asset('dashboard/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="{{ asset('dashboard/plugins/chartjs/Chart.min.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dashboard/dist/js/pages/dashboard2.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dashboard/dist/js/demo.js') }}"></script>
  </body>
</html>