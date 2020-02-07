 @include('dashboard/layout/header')

  <body class="skin-blue sidebar-mini"  dir="rtl">
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

            <div class="col-lg-12">
              <div class="box">
                <div class="box-body" style="overflow-x: scroll!important;">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-right">عنوان المقالة</th>
                        <th class="text-right">صورة المقالة</th>
                        <th class="text-right">اسم الاستخدام</th>
                        <th class="text-right">التصنيف</th>
                        <th class="text-right">الاعدادات</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($articles as $article)
                         <tr>
                          <td>{{ $article->heading }}</td>
                          <td><img src="{{ asset($article->image) }}" width="100" height="100"></td>
                          <td>{{ $article->slug }}</td>
                          <td>{{ $article->category->name }}</td>
                          <td>
                            <form action="{{ route('dashboard.published_articles') }}" method="post">
                              @csrf
                              <input type="hidden" name="article_id" value="{{ $article->id }}">
                              <input type="submit" name="delete_article" value="حذف المقال" class="col-lg-12 btn btn-sm btn-danger">
                              @if($article->is_published == 0)
                                <input type="submit" name="publish_btn" value="نشر" class="col-lg-12 btn btn-sm btn-success" style="margin-top: 10px;">
                              @elseif($article->is_published == 1)
                                <input type="submit" name="dis_publish_btn" value="اخفاء" class="col-lg-12 btn btn-sm btn-warning" style="margin-top: 10px;">
                              @endif
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
