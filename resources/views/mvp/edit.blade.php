 @include('layouts.header')

  <body class="w3-light-grey">

	<!-- Navigation Bar -->
	@include('layouts.nav')

	<br><br>

	<div class="container text-center">
	  <div class="row">
	  	<div id="edit_mvp" class="col-md-12 w3-white w3-padding">
			<form action="/mvp/edit/{{ $mvp->slug }}" method="post" enctype="multipart/form-data">
				@csrf
	            <div class="w3-right-align">
	                <div>
	                    <h4 class="w3-margin-top w3-margin-bottom">ابدأ مشروعك معنا الان</h4> <hr>
	                </div>
	                <div class="add_project_Slides">
	                    <div class="form-group{{ $errors->has('name') ? ' alert alert-danger' : '' }}">
	                        <label>اسم المشروع</label>
                            <input class="form-control w3-border w3-margin-bottom w3-right-align" type="text" name="name" value="{{ $mvp->name }}">
                            @if ($errors->has('name'))
			                  <span class="help-block">{{ $errors->first('name') }}</span>
			                @endif
	                    </div>
	                    <div class="form-group">
	                        <label>نوع المشروع</label>
	                        <select class="form-control w3-border w3-margin-bottom w3-right-align" name="type">
	                            <option value="web">موقع الكتروني </option>
	                            <option value="app">تطبيق هاتف </option>
	                            <option value="system">نظام</option>
	                            <option value="design">تصميم</option>
	                        </select>
	                    </div>
	                    <div class="form-group{{ $errors->has('description') ? ' alert alert-danger' : '' }}">
	                        <label> وصف عام عن المشروع  </label>
                            <textarea rows="8" class="form-control w3-border w3-right-align" name="description" >
                            	{{ $mvp->description }}
                            </textarea>
                            @if ($errors->has('description'))
			                  <span class="help-block">{{ $errors->first('description') }}</span>
			                @endif
	                    </div>
	                </div>
                  
	                <div class="add_project_Slides">
	                    <div class="form-group{{ $errors->has('dev_tools') ? ' alert alert-danger' : '' }}">
	                        <label> الادوات المستخدمة في التطوير </label>
                            <textarea rows="8" class="form-control w3-border w3-margin-bottom w3-right-align" name="dev_tools" >
                            	{{ $mvp->dev_tools }}
                            </textarea>
                            @if ($errors->has('dev_tools'))
			                  <span class="help-block">{{ $errors->first('dev_tools') }}</span>
			                @endif
                    	</div>

                    	<input type="hidden" name="mvp_id" value="{{ $mvp->id }}">

	                    <input type="submit" class="w3-button custom-bg w3-hover-black w3-section w3-padding w3-right w3-hover-black" name="btn_edit_mvp" value="تعديل المشروع">
	                </div>

	            </div>
	        </form>
		</div>
	  </div>
	</div>

<script src="{{ asset('assets/vendor/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/js/jquery.nicefileinput.min.js') }}"></script>

<script type="text/javascript">
/* <![CDATA[ */
$(document).ready(function(){
	// your code...
	$("input[type=file]").nicefileinput();
});
/* ]]> */
</script>

<script src="{{ asset('assets/js/profile.js') }}"></script>
<script src="{{ asset('assets/js/mvp.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>


<!-- Footer -->
@include('layouts.footer')
