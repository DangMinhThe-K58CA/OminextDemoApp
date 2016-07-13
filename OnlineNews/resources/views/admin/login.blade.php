<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}" /> -->
    <script type="text/javascript" src = "libs/jquery/jquery-2.0.2.min.js"></script>
    <script type="text/javascript" src = "libs/jquery/jquery.validate.min.js"></script>
    <link rel="stylesheet" type="text/css" href="libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="libs/bootstrap/assets/css/font-awesome.css">
    <script type="text/javascript" src = "libs/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="libs/bootstrap/css/smartadmin-production.css">
</head>
<body>
<div id="main" role="main">
<!-- MAIN CONTENT -->
<div id="content" class="col-sm-6 col-sm-offset-1 container">
    <div class="row">
        <div class="login-box">
            <div class="well no-padding">
                <form id="loginForm" class="smart-form client-form" novalidate="novalidate" method="POST" action="/adminLoginProcessing">
                    {{ csrf_field() }}

                    <header>
                        Đăng nhập hệ thống
                    </header>
                     @if (session('error'))
                      <div class="alert alert-warning">
                        {{ session('error') }}
                      </div>
                    @endif
                    <fieldset>
                        <p class="alert alert-warning" id="login-fail" style="display: none">
                            <i class="fa fa-warning fa-fw fa-lg"></i><strong>Cảnh báo!</strong> 
                            Tên đăng nhập và mật khẩu không đúng
                        </p>
                        <section>
                            <label class="label">E-mail</label>
                            <label class="input"> <i class="icon-append fa fa-user"></i>
                                <input type="email" name="email">
                                <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Nhập Email</b></label>
                        </section>

                        <section>
                            <label class="label">Mật khẩu</label>
                            <label class="input"> <i class="icon-append fa fa-lock"></i>
                                <input type="password" name="password">
                                <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Nhập mật khẩu</b> </label>
                        </section>
                    </fieldset>
                    <footer>
                        <input type = "button" class="btn btn-danger" onclick="window.location.href = '/adminLogin'" value = "Hủy"/>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            Đăng nhập
                        </button>
                    </footer>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $(function() {
      var formValidate = $("#loginForm").validate({
        // Rules for form validation
        rules : {
        email : {
          required : true,
          email: true,
        },
        password : {
          required : true,
          minlength : 3,
          maxlength : 20,
        },
      },

      // Messages for form validation
      messages : {
        email : {
          required: 'Vui lòng nhập email !',
          email : 'Vui lòng nhập email đúng định dạng (abc@gmail.com)!'
        },
        password : {
          minlength: 'Mật khẩu chứa ít nhất 3 kí tự !',
          required : 'Nhập mật khẩu người dùng (chứa ít nhất 3 kí tự) !',
        },
      },

        // Do not change code below
        errorPlacement : function(error, element) {
          error.insertAfter(element.parent());
        }
      });
    });
  </script>
</body>
</html>