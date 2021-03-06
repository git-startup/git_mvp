@include('dashboard/layouts/header')

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    @include('dashboard/layouts/aside')



    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">


      <!-- Main Content -->
      <div id="content">

        @include('dashboard/layouts/nav')


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800 text-right"> ادارة جدول المقالات   </h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary text-right"> جدول المقالات</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-right">
                      <th> عنوان المقالة </th>
                      <th>صورة المقالة</th>
                      <th>رابط المقالة</th>
                      <th> التصنيف </th>
                      <th>العمليات</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr class="text-right">
                      <th> عنوان المقالة </th>
                      <th>صورة المقالة</th>
                      <th>رابط المقالة</th>
                      <th> التصنيف </th>
                      <th>العمليات</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach($articles as $article)
                      <tr class="text-right">
                        <td><a href="/article/{{ $article->slug }}">{{ $article->heading }}</a></td>
                        <td>
                          <img src="{{ asset($article->image) }}" width="100" height="100" />
                        </td>
                        <td>{{ $article->slug }}</td>
                        <td>{{ $article->category->name }}</td>
                        <td>
                          <form action="{{ route('dashboard.articles') }}" method="post">
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            @csrf
                            <button class="w3-btn w3-card w3-round" name="btn_update" type="submit">
                              <i class="fa fa-wrench"></i>
                            </button> <hr style="visibility: hidden">
                            <button class="w3-btn btn-danger w3-round" name="delete_article" type="submit">
                              <i class="fa fa-times-circle"></i>
                            </button> <hr style="visibility: hidden">
                            @if($article->is_published == 0)
                              <button class="w3-btn btn-success w3-round" name="publish_btn" type="submit">
                                <i class="fa fa-check"></i>
                              </button>
                            @elseif($article->is_published == 1)
                              <button class="w3-btn btn-info w3-round" name="dis_publish_btn" type="submit">
                                <i class="fa fa-asterisk"></i>
                              </button>
                            @endif
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      @include('dashboard/layouts/footer')


  <!-- Bootstrap core JavaScript-->
  <script src="{{  asset('dashboard/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('dashboard/js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('dashboard/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('dashboard/js/demo/datatables-demo.js') }}"></script>

</body>

</html>
