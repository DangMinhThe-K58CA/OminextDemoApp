<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src = "libs/jquery/jquery-2.0.2.min.js"></script>
    <script type="text/javascript" src = "libs/jquery/jquery.validate.min.js"></script>
    <link rel="stylesheet" type="text/css" href="libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="libs/bootstrap/assets/css/font-awesome.css">
    <script type="text/javascript" src = "libs/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="libs/bootstrap/css/smartadmin-production.css">
    <script type="text/javascript" src = "libs/jquery/jquery-ui-1.10.3.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="plugins/css/smartadmin-skins.css">
    <link rel="stylesheet" type="text/css" media="screen" href="plugins/css/demo.css">
    <style type="text/css">
        body {
            overflow-y: scroll;
        }
        .container{
             margin-top:20px;
        }
        .image-preview-input {
            position: relative;
            overflow: hidden;
            margin: 0px;    
            color: #333;
            background-color: #fff;
            border-color: #ccc;    
        }
        .image-preview-input input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }
        .image-preview-input-title {
            margin-left:2px;
        }
    </style>
</head>
<body>
    <div role="content" class="col-sm-6 col-sm-offset-3">
        <!-- <div>
            <p style="color:red;">{{$error}}</p>
        </div> -->
        <!-- widget content -->
        <div class="widget-body no-padding">
            
            <form class="smart-form" novalidate="novalidate" method="POST" action="/registerProcessing" id="registerForm" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <header>
                    Vui lòng đăng ký
                </header>
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
                <fieldset>
                    <section>
                        <label class="input"> <i class="icon-append fa fa-user"></i>
                            <input type="text" name="name" placeholder="Họ và tên">
                            <b class="tooltip tooltip-bottom-right">Vui lòng nhập tên</b> </label>
                    </section>
                    
                    
                    <section>
                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                            <input type="email" name="email" placeholder="Địa chỉ email">
                            <b class="tooltip tooltip-bottom-right">abcd@gmail.com</b> </label>
                    </section>

                    <section>
                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                            <input type="password" name="password" placeholder="Mật khẩu" id="password">
                            <b class="tooltip tooltip-bottom-right">ít nhất 3 kí tự</b> </label>
                    </section>

                    <section>
                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                            <input type="password" name="passwordConfirm" id = "passwordConfirm" placeholder="Nhập lại mật khẩu">
                            <b class="tooltip tooltip-bottom-right">Vui lòng nhập lại mật khẩu</b> </label>
                    </section>
                    
                </fieldset>

                <fieldset>                    
                    <div class="row">
                        <section class="col col-6">
                            <label class="select">
                                <select name="gender">
                                    <option value="nữ" selected="" disabled="">Giới tính</option>
                                    <option value="nữ">Nữ</option>
                                    <option value="nam">Nam</option>
                                </select> <i></i> </label>
                        </section>
                        <section class="col col-6">
                            <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                        <textarea rows="3" name="review" id="review" placeholder="Giới thiệu bản thân..."></textarea> 
                                    </label>
                        </section>
                    </div>
                    <div class="row">
                        <section class="col col-6">
                            <label>Ngày sinh:
                                <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" placeholder="Chọn ngày sinh">
                            </label>
                        </section>
                        <section class="col col-6">
                            <label class="textarea">                                   
                                        <textarea rows="3" name="hometown" id="hometown" placeholder="Quê bạn ở đâu ?"></textarea> 
                                    </label>
                        </section>
                        <section class="col col-6">
                            <label class="input">Số điện thoại:
                                <input type="text" class="form-control" id="phone" name = "phone" placeholder="Điện thoại liên lạc">
                        </section>
                        <section class="col col-6">
                            <label class="textarea">                                   
                                        <textarea rows="3" name="hobbies" id="hobbies" placeholder="Sở thích của bạn..."></textarea> 
                                    </label>
                        </section>
                        <section class="col col-12">
                            <div class="container">
                                <div class="row">    
                                    <div class="col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-1">  
                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="filefield"/>
                                        <!-- image-preview-filename input [CUT FROM HERE]-->
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </fieldset>
                <footer>
                    <input type="button" onclick = "location.reload();" value="Hủy" class="btn btn-danger">
                    <button type="submit" class="btn btn-primary">
                        Hoàn tất
                    </button>
                </footer>
            </form>                     
            
        </div>
        <!-- end widget content -->
        
    </div>
    <script type="text/javascript">
    $(document).on('click', '#close-preview', function(){ 
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
           $('.image-preview').popover('show');
        }, 
         function () {
           $('.image-preview').popover('hide');
        }
    );    
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse"); 
    }); 
    // Create the preview image
    $(".image-preview-input input:file").change(function (){     
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });      
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);            
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }        
        reader.readAsDataURL(file);
    });  
});
     $(function() {
      var formValidate = $("#registerForm").validate({
        // Rules for form validation
        rules : {
            username : {
              required : true,
                minlength : 2,
            },
            email : {
              required : true,
              email: true,
            },
            password : {
              required : true,
              minlength : 3,
              maxlength : 20,
            },
            review : {
                required : true,
              minlength : 5,
              maxlength : 1000,
            },
            passwordConfirm : {
              equalTo: '#password',
            },
            hometown : {
                required: true,
                minlength: 5,
                maxlength: 200,
            },
            hobbies : {
                required: true,
                minlength: 5,
                maxlength: 200,
            },
            dateOfBirth : {
                required : true,
            },
            phone : {
                required : true,
                minlength: 9,
                maxlength: 11,
            }
          },

      // Messages for form validation
          messages : {
             phone : {
                required : "Vui lòng nhập số điện thoại !",
                minlength: "Vui lòng nhập đúng số điện thoại",
                maxlength: "Vui lòng nhập đúng số điện thoại",
            },
            username: {
                required: 'Vui lòng nhập tên !',
                minlength: 'Tên sử dụng chứa ít nhất 2 kí tự !',
            },
            email : {
              required: 'Vui lòng nhập email !',
              email : 'Vui lòng nhập email đúng định dạng (abc@gmail.com)!'
            },
            password : {
              minlength: 'Mật khẩu chứa ít nhất 3 kí tự !',
              required : 'Nhập mật khẩu người dùng (chứa ít nhất 3 kí tự) !',
            },
            review : {
                minlength: 'Mô tả qua ít nhất 5 kí tự !',
              required : 'Vui lòng mô tả về bản thân !',
              maxlength:'Quá dài rồi !',
            },
            passwordConfirm : {
                equalTo: "Mật khẩu xác nhận phải trùng với mật khẩu !",
            },
            hometown : {
                required: 'Vui lòng nhập thông tin này !',
                minlength: 'Quá ngắn !',
                maxlength: 'Quá dài !',
            },
            hobbies : {
                required: 'Vui lòng nhập thông tin này !',
                minlength: 'Quá ngắn !',
                maxlength: 'Quá dài !',
            },
            dateOfBirth : {
                required: 'Vui lòng nhập thông tin này !',
            }
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
