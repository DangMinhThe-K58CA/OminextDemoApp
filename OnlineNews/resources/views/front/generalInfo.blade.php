@extends('layouts.generalMaster')

@section('header')
	@parent
@endsection
<!-- 
@section('leftNav')
	@parent
@endsection
 -->

@section('content')
<div class="col-sm-10 col-sm-offset-1">
	<section class="panel">
     @if (session('error'))
      <div class="alert alert-warning">
        {{ session('error') }}
      </div>
    @endif
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
      <header class="panel-heading tab-bg-info">
          <ul class="nav nav-tabs">
              <li class="active">
                  <a data-toggle="tab" href="#profile">
                      <i class="icon-user"></i>
                      Thông tin
                  </a>
              </li>
              <li class="">
                  <a data-toggle="tab" href="#edit-profile">
                      <i class="icon-envelope"></i>
                      Thay đổi thông tin
                  </a>
              </li>
               <li class="">
                  <a data-toggle="tab" href="#change-password">
                      <i class="icon-envelope"></i>
                      Đổi mật khẩu
                  </a>
              </li>
          </ul>
      </header>
      <div class="panel-body">
          <div class="tab-content">
              <!-- profile -->
              <div id="profile" class="col-sm-12 tab-pane active">
                <section class="panel">
                	<div class="col-sm-12"><br/></div>
                  <div class="col-sm-12 bio-graph-heading">
                            {{Auth::user()->sortDescription}}
                  </div>
                  <div class="col-sm-12"><br/></div>
                  <div class="col-sm-4">
                  	<img src= "data:image/jpeg;base64,{{$imgData}}" width="300px" height="400px" />
                  </div>
                  <div class="col-sm-7 col-sm-offset-1 panel-body bio-graph-info">
                      <h1 style="color:#000066">Thông tin</h1>
                      <div class="row">
                          <div class="bio-row">
                              <p><span>Họ và tên </span>: {{Auth::user()->name}} </p>
                          </div>
                          <div class="bio-row">
                              <p><span>Email </span>: {{Auth::user()->email}} </p>
                          </div>
                          <div class="bio-row">
                              <p><span>Ngày sinh </span>: {{Auth::user()->dateOfBirth}} </p>
                          </div>
                          <div class="bio-row">
                              <p><span>Giới tính </span>: {{Auth::user()->gender}} </p>
                          </div>
                          <div class="bio-row">
                              <p><span>Quê quán </span>: {{Auth::user()->homeTown}} </p>
                          </div>
                          <div class="bio-row">
                              <p><span>Điện thoại liên hệ </span>: {{Auth::user()->phone}}</p>
                          </div>
                          <div class="bio-row">
                              <p><span>Sở thích </span>:  {{Auth::user()->hobbies}}</p>
                          </div>
                      </div>
                  </div>
                </section>
                  <section>
                      <div class="row">                                              
                      </div>
                  </section>
              </div>
              <!-- edit-profile -->
              <div id="edit-profile" class="tab-pane">
                <section class="panel">                                          
                      <div class="panel-body bio-graph-info">
                          <h1> Thông tin cá nhân</h1>
                          <form class="form-horizontal" role="form" method="POST" action="/changeGeneralProfile">
                          		
                          	{{ csrf_field() }}
                              <div class="form-group">
                                  <label class="col-lg-2 control-label">Họ và tên</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" name = "name" id="name" placeholder="{{Auth::user()->name}}">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-lg-2 control-label">Email</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" id="email" name="email" placeholder="{{Auth::user()->email}}" disabled="disabled">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-lg-2 control-label">Mô tả ngắn</label>
                                  <div class="col-lg-10">
                                      <textarea name="sortDescription" id="sortDescription" class="form-control" cols="30" rows="5">{{Auth::user()->sortDescription}}</textarea>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-lg-2 control-label">Quê quán</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" id="homeTown" name="homeTown" placeholder="{{Auth::user()->homeTown}}">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-lg-2 control-label">Ngày sinh</label>
                                  <div class="col-lg-6">
                                      <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" placeholder="{{Auth::user()->dateOfBirth}}">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-lg-2 control-label">Phone</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" id="phone" name = "phone" placeholder="{{Auth::user()->phone}}">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-primary">Lưu</button>
	                                    <!-- <script type="text/javascript">
	                                    	function change() {
	                                    		var tmpVal = $('#phone').val();
	                                    		alert(tmpVal);
	                                    	}
	                                    </script> -->
                                    <button type="button" class="btn btn-danger" onclick="location.reload();">Hủy</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </section>
              </div>
              <!-- Change password -->
               <div id="change-password" class="tab-pane">
                    <div id="main" role="main">
                <!-- MAIN CONTENT -->
                <div id="content" class="container col-sm-10">
                  <div class="jarviswidget jarviswidget-sortable" role="widget">
                    <header role="heading"></header>
                    <div role="content">
                      <div class="dt-wrapper" id="DtWrapper">
                        <div class="widget-body no-pediting">
                          <form id="changingPasswordForm" action="/changeGeneralPassword" class="smart-form" novalidate="novalidate" method="POST">
                            <fieldset class="changingPasswordField">
                            {!! csrf_field() !!}
                              <section>
                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                  <input type="password" id="currentPassword" name="currentPassword" placeholder="Mật khẩu hiện tại">
                                  <b class="tooltip tooltip-bottom-right">Nhập mật khẩu ( ít nhất 3 kí tự)</b> </label>
                              </section>
                              <section>
                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                  <input type="password" id="newPassword" name="newPassword" placeholder="Mật khẩu mới">
                                  <b class="tooltip tooltip-bottom-right">Nhập mật khẩu ( ít nhất 3 kí tự)</b> </label>
                              </section>

                              <section>
                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                  <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Xác nhận mật khẩu mới">
                                  <b class="tooltip tooltip-bottom-right">Nhập lại mật khẩu mới</b> </label>
                              </section>
                            </fieldset>
                            <footer id="footerPopup" class="changingPasswordField"> 
                              <input type="button" style="font-family: arial;" id="cancelButton" class="btn btn-danger" onclick = "location.reload();" value="Hủy">
                              <button type="submit" id="saveButton" class="btn btn-primary">
                                <strong>Lưu lại</strong>
                              </button>
                            </footer>
                            <input type="hidden" name="id" value="4">
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <script type="text/javascript">
                $(function() {
                  var formValidate = $("#changingPasswordForm").validate({
                    // Rules for form validation
                    rules : {
                    currentPassword : {
                      required : true,
                      minlength : 3,
                      maxlength : 20
                    },
                    newPassword : {
                      required : true,
                      minlength : 3,
                      maxlength : 20,
                    },
                    confirmPassword : {
                      required : true,
                      equalTo : '#newPassword'
                    }
                  },

                  // Messages for form validation
                  messages : {
                    currentPassword : {
                      minlength: 'Mật khẩu chứa ít nhất 3 kí tự',
                      required : 'Nhập mật khẩu người dùng (chứa ít nhất 3 kí tự) !'
                    },
                    newPassword : {
                      minlength: 'Mật khẩu chứa ít nhất 3 kí tự',
                      required : 'Nhập mật khẩu người dùng (chứa ít nhất 3 kí tự) !',
                    },
                    confirmPassword : {
                      required : 'Vui lòng nhập lại mật khẩu !',
                      equalTo : 'Vui lòng nhập mật khẩu trùng với mật khẩu bên trên !'
                    }
                  },

                    // Do not change code below
                    errorPlacement : function(error, element) {
                      error.insertAfter(element.parent());
                    }
                  });
                });
              </script>

              </div>
              <!-- End of Change password -->
          </div>
      </div>
  </section>
</div>
@endsection
<script type="text/javascript">
    
</script>