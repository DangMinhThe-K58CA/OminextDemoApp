<!DOCTYPE html>
<?php
$img = DB::table('fileentries')->where('id', '=', Auth::user()->imageId)->get();
            if (sizeof($img) != 0) {
                $img = $img[0];
                if (Storage::disk('s3')->has($img->filename)) {
                    $imgData = base64_encode(Storage::disk('s3')->get($img->filename));
                } else {
                    $imgData = "";
                }
            } else {
                $imgData = "";
            }
?>
<?php
    $_SESSION['KCFINDER'] = array(
    'disabled' => false
    );
?>
<html lang="en">
<head>
    <title>Cộng tác viên</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src = "libs/jquery/jquery-2.0.2.min.js"></script>
    <script type="text/javascript" src = "libs/jquery/jquery.validate.min.js"></script>
    <link rel="stylesheet" type="text/css" href="libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="libs/bootstrap/assets/css/font-awesome.css">
    <script type="text/javascript" src = "libs/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="libs/bootstrap/css/smartadmin-production.css">
    <style type="text/css">
        body {
            overflow-y: scroll;
        }
        /*style here*/
        .dropdown-submenu>.dropdown-menu {
            /*top: 0;*/
            /*left: 100%;*/
            /*margin-top: -6px;
            margin-left: -1px;*/
            -webkit-border-radius: 0 6px 6px 6px;
            -moz-border-radius: 0 6px 6px;
            border-radius: 0 6px 6px 6px;
        }

        .dropdown-submenu:click>.dropdown-menu {
            display: block;
        }

        .dropdown-submenu>a:after {
            display: block;
            content: " ";
            float: right;
            width: 0;
            height: 0;
            border-color: transparent;
            border-style: solid;
            border-width: 5px 0 5px 5px;
            border-left-color: #ccc;
            margin-top: 5px;
            margin-right: -10px;
        }

        .dropdown-submenu:click>a:after {
            border-left-color: #fff;
        }

        .dropdown-submenu.pull-left {
            float: none;
        }

        .dropdown-submenu.pull-left>.dropdown-menu {
            /*left: -100%;
            margin-left: 10px;*/
            -webkit-border-radius: 6px 0 6px 6px;
            -moz-border-radius: 6px 0 6px 6px;
            border-radius: 6px 0 6px 6px;
        }
    </style>
</head>
<body>
    <div class="col-sm-12">
        @section('header')
            <div class="col-sm-12" style="background-color:#009933;">
                <div class="col-sm-2 col-sm-offset-1">
                    <a style="color:white;" href = "/"><h1>Vuivui.vn</h1></a>
                </div>
                <div class="col-sm-2 col-sm-offset-7">
                    <!--  -->
                            <div class="dropdown" style="margin-top:1%;">
                                <a role="button" data-toggle="dropdown" class="btn" data-target="#">
                                   <img class="img-circle" alt="Cinque Terre" src= "data:image/jpeg;base64,{{$imgData}}" width="40px" height="40px"><p style="color:white;">{{' '. Auth::user()->name . ' '}}</p><span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                    <li><a href="#" onclick = "window.location.href = '/partnerProfile'"><i class="fa fa-info-circle" style="font-size:20px;color:green;"></i>   Thông tin</a></li>
                                    <li><a href="#" onclick = "window.location.href = '/partnerLogout'"><i class="fa fa-sign-out" style="font-size:20px;color:red;"></i>   Đăng xuất</a></li>
                                    <li class="divider"></li>
                                </ul>
                            </div>
                    <!--  -->
                </div>
               
            </div>
        @show
        <div class="col-sm-12"><hr/></div>
        @show
        @section('leftNav')
            <div class="col-sm-2">
                <div class="dropdown">
                    <a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-success" data-target="#" href="/page.html" style="font-size:120%;">----  Chọn tác vụ  ----<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        <li><a href="#" onclick="window.location.href = 'showNewsListOfPartner'">Danh sách bài đăng</a></li>
                        <li><a href="#" onclick="window.location.href = 'makeNews'">Đăng bài</a></li>
                        <li class="divider"></li>
                    </ul>
                </div>
            </div>
        @show
        <div class="col-sm-10 col-sm-offset-right-0 container">
            @yield('content')
        </div>

        @section('footer')
          <!--   <div class="col-sm-12" style="background-color:#486a6a; position:absolute;bottom:-25%;">
                <p>Footer</p>
            </div> -->
        @show
    </div>
</body>
</html>