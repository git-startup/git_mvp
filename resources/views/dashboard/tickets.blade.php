 @include('dashboard/layout/header')

  <body class="skin-blue sidebar-mini"  dir="rtl">
    <div class="wrapper">

      <header class="main-header">

      @include('dashboard/layout/aside')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
        <!-- Content Header (Page header) -->


        @include('dashboard/layout/alert')

        <!-- Main content -->
        <section class="content">
          <div class="row">

            <div class="col-lg-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">ادارة التذاكر</h3>
                </div><!-- /.box-header -->
                <div class="box-body" style="overflow-x: scroll!important;">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-right">الاسم</th>
                        <th class="text-right">رقم الهاتف </th>
                        <th class="text-right">الغرض</th>
                        <th class="text-right">الرسالة</th>
                        <th class="text-right">الاعدادت</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($tickets as $ticket)
                         <tr>
                          <td>{{ $ticket->user->name }}</td>
                          <td>{{ $ticket->user->phone }}</td>
                          <td>{{ $ticket->subject }}</td>
                          <td>{{ $ticket->content }}</td>
                          <td>
                            <form action="{{ route('dashboard.tickets') }}" method="get">
                              <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                              @if($ticket->is_closed == 0)
                                <input type="submit" name="close_ticket" value="اغلاق التذكرة" class="col-lg-12 btn btn-sm btn-warning">
                              @endif
                              <input type="submit"  name="delete_ticket" value="حذف الاستفسار" class="col-lg-12 btn btn-sm btn-danger" style="margin-top: 5px;">
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

          </div><!-- /.row -->
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