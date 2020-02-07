 @include('admin.admin_layout.header')

  <body class="skin-blue sidebar-mini"  dir="rtl">
    <div class="wrapper">

      <header class="main-header">

      @include('admin.admin_layout.aside')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Git Startup
            <small>Admin Dashboard</small>
          </h1>
        </section>

        @include('admin.admin_layout.alert')

        <!-- Main content -->
        <section class="content">
          <div class="row">

            <div class="col-lg-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Report About Site Users</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>الرابط </th>
                        <th>الصورة</th>
                        <th>اعدادات</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($partners as $partner)
                         <tr>
                          <td>{{ $partner->link }}</td>
                          <td> <img src="{{ $partner->image }}" width="200" height="100"> </td>
                          <td>
                            <form action="{{ route('admin.partners') }}" method="get">
                              <input type="hidden" name="partner_id" value="{{ $partner->id }}">
                              <input type="submit" name="delete_partner" class="btn btn-danger" value="حذف الشريك">
                              {{ csrf_field() }}
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
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.4 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
  </body>
</html>
