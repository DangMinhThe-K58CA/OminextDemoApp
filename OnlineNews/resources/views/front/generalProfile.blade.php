@extends('layouts.generalMaster')

@section('header')
	@parent
@endsection

@section('leftNav')
	@parent
@endsection


@section('content')
<!--  -->
<script type="text/javascript" src = "libs/angularjs/angular.min.js"></script>
<script type="text/javascript" src = "app/js/personalPage.model.js"></script>
<style type="text/css">
	#cateName1 {
		background-color: #0000cc;
	}
	#cateName2 {
		background-color: #cc0000;
	}
	#cateName3 {
		background-color: #009933;
	}
	#cateName4 {
		background-color: #0066ff;
	}
	#cateName5 {
		background-color: #ff751a;
	}
	#cateName6 {
		background-color: #00cc00;
	}
	#cateName7 {
		background-color: #3399ff;
	}
	#cateName8 {
		background-color: #ffa31a;
	}
	#cateName9 {
		background-color: #00ff00;
	}
	#cateName10 {
		background-color: #66ccff;
	}
	#cateName11 {
		background-color: #ffe066;
	}
	#cateName12 {
		background-color: #66ff99;
	}
</style>
<div class="col-sm-12 col-sm-offset-0" ng-app = "personalPageApp">
	<div  id = "newsField" class="col-sm-12 col-sm-offset-0 hidden ng-scope" style="margin-top: 0%;margin-bottom: 0%;" ng-controller = "newsController">
		<!-- news controller -->
		<div id = "news" class="col-sm-10 col-sm-offset-1">
		<div class="col-sm-1 col-sm-offset-11">
			<a href="javascript:void(0);" ng-click = "cancelReading();">
				<i class="fa fa-times-circle-o" style="font-size:48px;color:red"></i>
			</a>
		</div>
			<div class="col-sm-12">
				<div class="col-sm-12">
					<p style = "font-weight:Bold; font-size:150%; color:#000099;" ng-bind = "news.title"></p>
				</div>
				
			</div>
			<!-- <div class="col-sm-10 col-sm-offset-1">
			</div>
			<div class="col-sm-12 col-sm-offset-1" align="center" id = 'description'>
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
		<div class="col-sm-1">
			
		</div>
		<a type="hidden" id = "clickBindingNews" ng-click = "init()"></a>
		<!--  end news controller-->
	</div>
	<div class="col-sm-12">
	<div class="col-xs-12 col-sm-8">
		<!-- hottest news -->
		<div id = "mainContent" class="col-sm-12 col-sm-offset-0" ng-controller = "hottestBookmarkController">
			<div id = "detailCategories" class="col-sm-12">
				<!-- <div class = "titileContent" class="col-sm-12">
					<p>Cập nhật tin tức mới nhất trên toàn thế giới</p>
				</div> -->
				<div ng-repeat = "news in hottestList">
					<div class="col-sm-6 detailCate">
						<div class="col-sm-12">
							<!-- <div class="col-sm-1">
								<a href = "javascript:void(0);" style="font-size:24px;color:#1aff1a;" ng-click = "stickToBookmark(news.id);"><i class="fa fa-bookmark"></i></a>
							</div> -->
							<div class="col-sm-12">
								<a href="javascript:void(0);" ng-bind= "news.title" ng-click = "readNews(news);"></a>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="col-sm-2">
								<a>
									<img ng-src="/templateEditor/kcfinder/upload/images/{$news.imagesList[0].name $}" width="90px" height="110px" style="padding-bottom: 10%;"></img>
								</a>
							</div>
							<div class="col-sm-8 col-sm-offset-2">
								<p style="font-size: 85%" ng-bind = "news.shortDescription"></p>
								<div class="col-sm-12 col-sm-offset-right-1" align="right">
									<p ng-bind = "news.updated_at" style="font-style: italic;color: #990000;font-size: 75%;"></p>
								</div>
							</div>
						</div>
					</div>
				</div>
					
				</div>
				<a type="hidden" id="hottestNewsClickBinding" ng-click = "init()"></a>
			</div>
		</div>
		<!-- end hottest news -->
		<!-- Category Controller -->
		<div class="col-sm-4 col-sm-offset-0" id = "categoriesList" ng-controller = "categoryController" >
			<div class="col-xs-12 col-sm-12 col-md-12" ng-repeat = "cate in catesData" >
	            <div class="panel panel-primary pricing-big" ng-model = "cate" ng-if = "cate.bookmarks.length != 0">
	                <div class="panel-heading" id = "cateName{$ cate.cateId $}">
	                    <h2 class="panel-title">
	                        {$ cate.cateName $}</h2>
	                </div>
	                <div class="panel-body no-padding text-align-center" >
	                    
						<div class="price-features" style="background-color: #f0f5f5;">
							<ul class="list-unstyled text-left" ng-repeat = "news in cate.bookmarks" ng-if = "news.order <= cate.index">

					          <li>
					          	<a href="javascript:void(0);" ng-click = "readNews(news.newsId);">
					          		<i class="fa fa-check text-success" ng-if = "news.state == 1"></i>
					          		<i class="fa fa-asterisk" ng-if = "news.state == 0" style = "font-size:24px;color:#ff3300;" ></i>
					          		<strong>{$ news.title $}</strong>
					          	</a>
					          	<a href="javascript:void(0);" ng-click = "deleteNewsFromBookmark(news.newsId);"><i class="fa fa-trash" style = "font-size:24px;color:#476b6b;" ></i></a>
					          </li>
					        </ul>
					        <div ng-if = "cate.bookmarks.length == 0" style="margin-top:15%;">
		                		<a href="javascript:void(0);" ng-click = "addNews(cate.cateId);"><i class="fa fa-plus-circle" style="font-size:68px;color:#800000"></i></a>
		                	</div>
						</div>
	                </div>
	                <div class="text-align-center" style="background-color: #d2e0e0;">
	                	<div ng-if = "cate.index < cate.bookmarks.length">
	                		<a href="javascript:void(0);" ng-click = "showMoreNews(cate.cateId);"><i>...còn nữa...</i></a>
	                	</div>
	                	<div ng-if = "cate.index > 3">
	                		<a href="javascript:void(0);" ng-click = "hideLessNews(cate.cateId);"><i>...thu gọn...</i></a>
	                	</div>
	                	<div ng-if = "cate.bookmarks.length == 0">
	                		<a href="javascript:void(0);" ng-click = "addNews(cate.cateId);"><i>...thêm mới...</i></a>
	                	</div>
	                </div>
	            </div>
	        </div>
	        <input id = "categoryClickBinding" class= "hidden" ng-click = "init()"/>
		</div>
		<!-- End category list div -->
	</div>
	
	</div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
    	$('#categoryClickBinding').click();
    	$('#hottestNewsClickBinding').click();
    });
</script>
@endsection