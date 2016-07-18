<!DOCTYPE html>
<html>
<?php
if (Auth::check()) {
	$img = DB::table('fileentries')->where('id', '=', Auth::user()->imageId)->get();
    if (sizeof($img) != 0) {
        $img = $img[0];
        if (Storage::disk('s3')->has($img->filename)) {
            $imgData = base64_encode(Storage::disk('s3')->get($img->filename));
        }
        else {
            $imgData = "";
        }
    }
}

?>
<head>
    <title>Online News</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
    <script type="text/javascript" src = "libs/jquery/jquery-2.0.2.min.js"></script>
    <script type="text/javascript" src = "libs/jquery/jquery.validate.min.js"></script>
    <link rel="stylesheet" type="text/css" href="libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="libs/bootstrap/assets/css/font-awesome.css">
    <script type="text/javascript" src = "libs/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="libs/bootstrap/css/smartadmin-production.css">
    <link rel="stylesheet" type="text/css" href="app/css/index.css">
    <script type="text/javascript" src = "libs/angularjs/angular.min.js"></script>
    <script type="text/javascript" src = "app/js/home.model.js"></script>

    <style type="text/css">
    	body {
            overflow-y: scroll;
        }
    </style>
</head>
<body>
	<div id = "homePage" class="row" ng-app= "homeApp">
		<!-- header -->
		 <div class="col-sm-12" style="background-color:#00cc00;">
                <div class="col-sm-2 col-sm-offset-1">
                    <a style="color:white;" href = "/"><h1>Vuivui.vn</h1></a>
                </div>
               
                
                @if (Auth::check())
                <div class="col-sm-2 col-sm-offset-7">
                    <!--  -->
                    <div class="dropdown" style="margin-top:1%;">
                        <a role="button" data-toggle="dropdown" class="btn" data-target="#">
                           <img class="img-circle" alt="Cinque Terre" src= "data:image/jpeg;base64,{{$imgData}}" width="40px" height="40px">{{' '. Auth::user()->name . ' '}}<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                            <li><a href="#" onclick = "window.location.href = '/generalProfile'"><i class="fa fa-info-circle" style="font-size:20px;color:green;"></i>   Trang cá nhân</a></li>
                            <li><a href="#" onclick = "window.location.href = '/generalLogout'"><i class="fa fa-sign-out" style="font-size:20px;color:red;"></i>   Đăng xuất</a></li>
                            <li class="divider"></li>
                        </ul>
                    </div>
                    <!--  -->
                </div>
                @else
                <div class="col-sm-6 col-sm-offset-3">
                	
                    <div class="col-sm-3 col-sm-offset-1">
		                <a class="btn" style="background-color:#00cc00;color:white;font-size:120%;" onclick="showLoginForm();">
		                    Đăng nhập
		                </a>
		            </div>
		            <div class="col-sm-4">
		                <a class="btn" style="background-color:#00cc00;color:white;font-size:120%;" href="/register" target = "__blank">
		                    Đăng ký
		                </a>
		            </div>
		             @if (session('error'))
                      <div class="alert alert-warning col-sm-8">
                        {{ session('error') }}
                      </div>
                    @endif
                </div>
                @endif
            </div>
		<!-- end of header -->
		<!-- js for hide and show -->
		<!-- end -->
		<!-- signup form -->
		<!-- end of signupForm -->
		<div class="col-sm-11">
			<div id="loginField" class="col-sm-4 col-sm-offset-8 container">
			    <div class="row">
			        <div class="login-box">
			            <div class="well no-padding">
			                <form id="loginForm" class="smart-form client-form" novalidate="novalidate" method="POST" action="/generalLoginProcessing">
			                    {{ csrf_field() }}
			                    <fieldset>
			                        <section>
			                            <label class="input"> <i class="icon-append fa fa-user"></i>
			                                <input type="email" name="email">
			                                <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Nhập Email</b></label>
			                        </section>

			                        <section>
			                            <label class="input"> <i class="icon-append fa fa-lock"></i>
			                                <input type="password" name="password">
			                                <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Nhập mật khẩu</b> </label>
			                        </section>
			                    </fieldset>
			                    <footer>
			                        <input type = "button" class="btn btn-danger" onclick="hideLoginForm();" value = "Hủy"/>
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
		<div id = "bodyField" class="col-sm-11 col-md-offset-0">
			<!-- Left nav -->
			<div id = "leftNav" class="col-sm-2 col-sm-offset-0 ng-scope" ng-controller = "categoryController" >
				<div id = "catesField" class="col-sm-12">
					<hr/>
					<p style="color:white;font-weight:500;border-bottom: 1px solid white;text-align: center;font-size: 200%">Danh mục</p>
					<div class="categoryList" ng-repeat = "cate in categoriesList" ng-if = "cate.id != 13">
						<a ng-bind = "cate.name" ng-href = "javacript:void(0)" ng-click = "loadCategory(cate.id, cate.name)"></a>
						<div><br/></div>
					</div>
					<a type = "hidden" id = "cateClickBinding" ng-click = "init()"></a>
					<hr/>
				</div>
				<!-- <div class="col-sm-10">
					<div style="margin-top: 15%;padding: 1%;" align="center">
						<a href="http://vinhomesgardenia.vn/" target="_blank"><img src= {% static "OnlineNews/apps/galaries/images/adsLeft.png" %} height="110%" width="140%" /></a>
					</div>
				</div> -->
			</div>
			<!-- End of left nav -->
			
			<div class="col-sm-10">
				<!-- news controller -->
				<div  id = "newsField" class="col-sm-12 col-sm-offset-0 hidden ng-scope" style="margin-top: 0%;margin-bottom: 0%;" ng-controller = "newsController">
					<div id = "news">
						<div class="col-sm-12">
							<div class="col-sm-1">
								<a href = "javascript:void(0);" style="font-size:24px;color:#1aff1a;" ng-click = "stickToBookmark(news.id);"><i class="fa fa-bookmark"></i></a>
							</div>
							<div class="col-sm-11">
								<p style = "font-weight:Bold; font-size:150%; color:#000099;" ng-bind = "news.title"></p>
							</div>
						</div>
						<!-- <div class="col-sm-10 col-sm-offset-1">
							<div class="col-sm-10 col-sm-offset-1" align="center">
								<img ng-src="templateEditor/kcfinder/upload/images/{$news.imagesList[0].name$}" width="80%" height="80%" style="padding-bottom: 5%;"></img>
							</div>
						</div>
						<div class="col-sm-12 col-sm-offset-1" align="center" id = "description">
							<p style = "color:#991f00"><i>Ảnh minh họa: {$ news.shortDescription $}</i></p>
						</div> -->
						<div class="col-sm-12 col-sm-offset-right-0" id = "newsContent">
						</div>
						<div class="col-sm-12 col-sm-offset-right-0" align="right">
							<p ng-bind = "news.Date" style="font-style: italic;color: #990000;"></p>
							<p style="font-style: italic;color: #0000b3;">( Theo TinVit.com )</p>
						</div>
						<div id="facebookPlugin" class="col-sm-12">
							<!-- ok facebook -->
							<script>
							  window.fbAsyncInit = function() {
							    FB.init({
							      appId      : '230730343946192',
							      xfbml      : true,
							      version    : 'v2.6'
							    });
							  };

							  (function(d, s, id){
							     var js, fjs = d.getElementsByTagName(s)[0];
							     if (d.getElementById(id)) {return;}
							     js = d.createElement(s); js.id = id;
							     js.src = "//connect.facebook.net/en_US/sdk.js";
							     fjs.parentNode.insertBefore(js, fjs);
							   }(document, 'script', 'facebook-jssdk'));
							</script>
							<div class="col-sm-12">
							<div
								  class="fb-like"
								  data-share="true"
								  data-width="450"
								  data-show-faces="true">
								</div>
							</div>
							<div id="fb-root" class="col-sm-12"></div>
							<script>(function(d, s, id) {
							  var js, fjs = d.getElementsByTagName(s)[0];
							  if (d.getElementById(id)) return;
							  js = d.createElement(s); js.id = id;
							  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6&appId=230730343946192";
							  fjs.parentNode.insertBefore(js, fjs);
							}(document, 'script', 'facebook-jssdk'));</script>
							<div class="fb-comments" data-numposts="5"></div>
						</div>
					</div>
					<a type="hidden" id = "clickBindingNews" ng-click = "init()"></a>
				</div>
				<!--  end news controller-->
				<!-- newsList of cate controller -->
				<div  id = "newsListOfCate" class="col-sm-12 col-sm-offset-0 hidden ng-scope" style="margin-top: 0%;margin-bottom: 0%;" ng-controller = "newsOfCateController">
					<div id = "newsOfCate">
						<div class = "titileContent" class="col-sm-12">
							<p ng-bind = "curCateNews.name"></p>
						</div>
						<div class="col-sm-12" ng-if = "activeNewsList.length == 0" align="center"><p><---Trống---></p></div>
						<div ng-repeat = "news in activeNewsList">
							<div class="col-sm-6 detailCate">
								<div class="col-sm-12">
									<div class="col-sm-1">
										<a href = "javascript:void(0);" style="font-size:24px;color:#1aff1a;" ng-click = "stickToBookmark(news.id);"><i class="fa fa-bookmark"></i></a>
									</div>
									<div class="col-sm-11">
										<a href="javascript:void(0);" ng-bind= "news.title" ng-click = "loadNews(news);"></a>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="col-sm-2">
										<a>
											<img ng-src="templateEditor/kcfinder/upload/images/{$news.imagesList[0].name $}" width="80px" height="90px" style="padding-bottom: 10%;"></img>
										</a>
									</div>
									<div class="col-sm-9 col-sm-offset-1">
										<p style="font-size: 85%" ng-bind = "news.shortDescription"></p>
										<div class="col-sm-12 col-sm-offset-right-1" align="right">
											<p ng-bind = "news.updated_at" style="font-style: italic;color: #990000;font-size: 75%;"></p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="container col-sm-12" align="left">
						  <ul class="pagination" id = "pagesList" ng-if = "pageIndexsList.length > 0">
						  	<li ng-if = "curState == 1"><a style="background-color: #b3cccc;"><< trở lại</a></li>
						  	<li ng-if = "curState > 1"><a href="javascript:void(0);" ng-click = "getPageByIndex(curState - 1);"><< trở lại</a></li>
						    <li id = "page{$ idx $}" ng-repeat = "idx in pageIndexsList" ng-if = "idx == 1" class="active"><a href="javascript:void(0);" ng-click = "getPageByIndex(idx);">{$ idx $}</a></li>
						    <li id = "page{$ idx $}" ng-repeat = "idx in pageIndexsList" ng-if = "idx != 1"><a href="javascript:void(0);" ng-click = "getPageByIndex(idx);">{$ idx $}</a></li>
						    <li ng-if = "curState < pageIndexsList.length"><a href="javascript:void(0);" ng-click = "getPageByIndex(curState + 1);">tiếp >></a></li>
						    <li ng-if = "curState == pageIndexsList.length"><a style="background-color: #b3cccc;">tiếp >></a></li>
						  </ul>
						</div>
					</div>
					<a type="hidden" id = "clickBindingNewsListOfCate" ng-click = "init()"></a>
				</div>
				<!-- end newsList of cate controller -->
				<div class="col-sm-12">
					<!-- hottest news -->
					<div id = "mainContent" class="col-sm-12 col-sm-offset-0" ng-controller = "hottestNewsController">
						<div id = "detailCategories" class="col-sm-12">
							<div class = "titileContent" class="col-sm-12">
								<p>Cập nhật tin tức mới nhất trên toàn thế giới</p>
							</div>
							<div ng-repeat = "news in hottestList">
								<div class="col-sm-6 detailCate">
									<div class="col-sm-12">
										<div class="col-sm-1">
											<a href = "javascript:void(0);" style="font-size:24px;color:#1aff1a;" ng-click = "stickToBookmark(news.id);"><i class="fa fa-bookmark"></i></a>
										</div>
										<div class="col-sm-11">
											<a href="javascript:void(0);" ng-bind= "news.title" ng-click = "loadNews(news);"></a>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="col-sm-2">
											<a>
												<img ng-src="/templateEditor/kcfinder/upload/images/{$news.imagesList[0].name $}" width="80px" height="90px" style="padding-bottom: 10%;"></img>
											</a>
										</div>
										<div class="col-sm-9 col-sm-offset-1">
											<p style="font-size: 85%" ng-bind = "news.shortDescription"></p>
											<div class="col-sm-12 col-sm-offset-right-1" align="right">
												<p ng-bind = "news.updated_at" style="font-style: italic;color: #990000;font-size: 75%;"></p>
											</div>
										</div>
									</div>
								</div>
								<div ng-if = "news.order == 6">
									<a href="http://marvel.com/movies/movie/219/captain_america_civil_war" target="_blank">
										<img src= "templateEditor/kcfinder/upload/images/film.gif" alt="film.gif" width="100%" height="200px" style="margin-top: 1%;margin-bottom: 1%;padding: 0;">
									</a>
								</div>
							</div>
								
							</div>
							<a type="hidden" id="hottestNewsClickBinding" ng-click = "init()"></a>
						</div>
					</div>
					<!-- end hottest news -->
				</div>
			<!-- wearther controller -->
			<!--end wearther controller -->
		</div>

		<div id = "footerField" class="col-sm-12">
			<div class="col-sm-1 col-sm-offset-3">
				<!-- <img src= {% static "OnlineNews/apps/galaries/images/favicon.ico" %} width="50px" height="50px"> -->
			</div>
			<div class="col-sm-8" style="margin-top: 1%;">
				<p>@ Copyright: Dang Minh The - Ominext</p>
			</div>
		</div>
	</div>
</body>
</html>
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
	$("#document").ready(function () {
		$("#cateClickBinding").click();
		$("#hottestNewsClickBinding").click();
		$("#clickBindingWeartherNews").click();
		$('#loginField').hide();
		$('#signupField').hide();
	});
	function showLoginForm() {
		$('#loginField').show(400);
	}
	function hideLoginForm() {
		$('#loginField').hide(100);
	}
</script>