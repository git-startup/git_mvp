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
                  <h3 class="box-title"> اضافة صنف جديد </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="login-box-body">
               
                  <form action="{{ route('dashboard.addCategory') }}" method="POST">
                    @csrf
                    <div class="form-group has-feedback">
                      <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus placeholder="name">
                      <span class="glyphicon glyphicon-user form-control-feedback"></span>
                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="form-group has-feedback">
                      <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') }}" required autofocus placeholder="slug">
                      <span class="glyphicon glyphicon-user form-control-feedback"></span>
                      @error('slug')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="form-group has-feedback">
                      <select name="parent_id" class="form-control">
                        <option value=""></option>
                      </select>
                      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                      @error('parent_id')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                 
                    <div class="box-footer">
                    <input type="submit" name="btn_category" class="btn btn-primary" value="اضافة">
                    </div>

                  </form>

                <!-- /.login-box-body -->
              </div><!-- /.box -->
            </div><!--/.col (left) -->

            <div class="co
            l-lg-2"></div>

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