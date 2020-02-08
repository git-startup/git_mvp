<!DOCTYPE html>
<html>
<head>
    <title>Upload Multiple Images using dropzone.js and Laravel</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/dropzone.css') }}">

</head>
<body>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form multiple action="{{ route('dropzone.store') }}" method="post" class="dropzone" id="image-upload" enctype="multipart/form-data">
              @csrf
            <div>
                <h3> اضغط على الصندوق لتحميل صور العقار </h3>
            </div>
          </form>
        </div>
    </div>
</div>


<!-- dropzone -->
<script src="{{ asset('assets/vendor/js/dropzone-jquery-plugin.js') }}"></script>
<script src="{{ asset('assets/vendor/js/dropzone.js') }}"></script>

<script type="text/javascript">
        Dropzone.options.imageUpload = {
            maxFilesize         :       1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif"
        };
</script>
</body>
</html>
