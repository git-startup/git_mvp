@include('dashboard/layout/header')
  <body class="skin-blue sidebar-mini" dir="rtl">
    <div class="wrapper">

      <header class="main-header">

      @include('dashboard/layout/aside')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <br>
        @include('dashboard/layout/alert')

        <!-- Main content -->
        <section class="content">
          <div class="row"> 

            <div class="col-lg-12">
              <div class="box">
                <div class="box-body" style="overflow-x: scroll;">
                  <table id="example1" class="table table-bordered table-striped"> 
                    <br>
                    <thead>
                      <tr>
                        <th class="text-right">اسم المستخدم  </th>
                        <th class="text-right">الايميل</th>
                        <th class="text-right">رقم الهاتف</th>
                        <th class="text-right">الاهتمامات</th>
                        <th class="text-right">الموقع</th>
                        <th class="text-right">اعدادات</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($users as $user)
                         <tr>
                          <td><a href="/profile/{{ $user->id }}">{{ $user->name }}</a></td>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->phone }}</td>
                          <td>{{ $user->user_interest }}</td>
                          <td>{{ $user->location }}</td>
                          <td>
                            <form action="{{ route('dashboard.users') }}" method="post">
                              <input type="hidden" name="user_id" value="{{ $user->id }}">
                              @if($user->is_disable == 0)
                                <input type="submit" name="btn_disable" value="تعطيل حساب المستخدم" class="col-lg-12 btn btn-sm btn-warning">
                              @elseif($user->is_disable == 1)
                                <input type="submit" name="btn_able" value="تفعيل حساب المستخدم" class="col-lg-12 btn btn-sm btn-success">
                              @endif
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
    <script src="{{ asset('dashboard/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- Bootstrap 3.3.4 -->
    <script src="{{ asset('dashboard/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('dashboard/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('dashboard/plugins/fastclick/fastclick.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dashboard/dist/js/app.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dashboard/dist/js/demo.js') }}"></script>
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
