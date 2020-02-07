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
                  <h3 class="box-title">تحديث بيانات المقالة</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('dashboard.published_articles') }}" method="post" enctype="multipart/form-data" >
                  @csrf
                  <div class="box-body">
                    <div class="form-group">
                      <label >عنوان المقالة</label>
                      <input type="text" class="form-control" value="{{ $article->heading }}" name="heading">
                      @if ($errors->has('heading'))
                        <span class="alert-danger">{{ $errors->first('heading') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label >العنوان الفرعي</label>
                      <input type="text" class="form-control" value="{{ $article->sub_heading }}" name="sub_heading" >
                      @if ($errors->has('sub_heading'))
                        <span class="alert-danger">{{ $errors->first('sub_heading') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label >اسم الاستخدام للمقالة</label>
                      <input type="text" class="form-control" value="{{ $article->slug }}" name="slug" >
                      @if ($errors->has('slug'))
                        <span class="alert-danger">{{ $errors->first('slug') }}</span>
                      @endif
                    </div>

                    <div class="form-group">
                      <label >المحتوى الرئيسي للمقالة</label>
                      <textarea dir="auto" class="form-control" name="content"> {{ $article->content }} </textarea>
                      @if ($errors->has('content'))
                        <span class="alert-danger">{{ $errors->first('content') }}</span>
                      @endif
                    </div>

                    <div class="form-group">
                      <label >المحتوى الفرعي للمقالة</label>
                      <textarea dir="auto" class="form-control" name="bottom_content"> {{ $article->bottom_content }} </textarea>
                      @if ($errors->has('bottom_content'))
                        <span class="alert-danger">{{ $errors->first('bottom_content') }}</span>
                      @endif
                    </div>

                    <div class="form-group">
                      <label >الصورة الرئيسية للمقالة</label>
                      <input type="file" class="form-control" value="{{ $article->image }}" name="image">
                      @if ($errors->has('image'))
                        <span class="alert-danger">{{ $errors->first('image') }}</span>
                      @endif
                    </div>

                    <div class="form-group">
                      <label >الصورة الفرعية للمقالة</label>
                      <input type="file" class="form-control" value="{{ $article->bottom_image }}" name="bottom_image">
                      @if ($errors->has('bottom_image'))
                        <span class="alert-danger">{{ $errors->first('bottom_image') }}</span>
                      @endif
                    </div>

                    <div class="form-group">
                      <label >الصورة الفرعية للمقالة</label>
                      <select name="language" class="form-control">
                        <option value="ar">عربي</option>
                        <option value="en">انجليزي</option>
                      </select>
                      @if ($errors->has('language'))
                        <span class="alert-danger">{{ $errors->first('language') }}</span>
                      @endif
                    </div>

                    <div class="box-footer">
                      <input type="hidden" name="id" value="{{ $article->id }}">
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
          <b>gitstartup</b>
        </div>
        <strong>Copyright &copy; <?php echo date('Y') ?> <a href="#">Git Startup</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.4 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
  </body>
</html>
