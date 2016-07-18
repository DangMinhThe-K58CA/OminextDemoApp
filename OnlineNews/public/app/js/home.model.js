var app = angular.module("homeApp", []).config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('{$');
    $interpolateProvider.endSymbol('$}');
});

app.factory('appService', function () {
	var factory = {};
	factory.stickToBookmark = function (newsId) {
		$.ajax({
			url: '/front/addToBookmark',
			type: "GET",
			data: {newsId: newsId},
			success: function (jsonData) {
				alert(jsonData);
			}
		});
	}
	return factory;
});

app.controller("categoryController", ['$scope', '$rootScope', 'appService',function($scope, $rootScope, appService) {
	$scope.curCateNews = {};
	$scope.categoriesList = []
	$scope.init = function () {
		$.ajax({
			url: "/front/getCategories",
			type: "GET",
			success: function (jsonData) {
				// alert(jsonData);
				$scope.categoriesList = JSON.parse(jsonData);
				// for (var i = 0; i < $scope.categoriesList.length; i ++) {
				// 	var idTmp = $scope.categoriesList[i]["pk"];
				// 	$scope.categoriesList[i] = $scope.categoriesList[i]["fields"];
				// 	$scope.categoriesList[i].id = idTmp;
				// }
				$scope.$apply();
			}
		});
	}
	$scope.loadCategory = function(cateId, cateName) {		
		$('#newsField').addClass("hidden");
		$.ajax({
			url: "/front/getNewsOfCate",
			type: "GET",
			data: {jsonData: cateId},
			success: function (jsonData) {
				$("#clickBindingNewsListOfCate").click();
				$rootScope.$broadcast("passNewsListOfCate", {cateName: cateName, newsData: jsonData});
				$("#newsListOfCate").removeClass('hidden');
		 	}
		});
	}
	$scope.stickToBookmark = function (newsId) {
		return appService.stickToBookmark(newsId);
	}
}]);


app.controller("hottestNewsController", ['$scope', '$rootScope', 'appService',function($scope, $rootScope, appService) {
	$scope.hottestList = [];
	$scope.init = function() {
		$.ajax({
			url: "/front/getHottestList",
			type: "GET",
			success: function(jsonData) {
				// alert(jsonData);
				$scope.hottestList = JSON.parse(jsonData);
				for(var i = 0; i < $scope.hottestList.length; i ++) {
					$scope.hottestList[i].order = i + 1;
					$scope.hottestList[i].shortDescription = $scope.hottestList[i].shortDescription.slice(0,200) + " ...";
				}
				$scope.$applyAsync();
			}
		});
	}
	$scope.loadNews = function (news) {
		$scope.$applyAsync(function () {
			$rootScope.$broadcast("passNewsFromCate", news);
			$('#newsField').removeClass("hidden");
			$('#newsOfCate').addClass("hidden");
		});
	}
	$scope.stickToBookmark = function (newsId) {
		return appService.stickToBookmark(newsId);
	}
}]);


app.controller("newsOfCateController", ['$scope','$rootScope', 'appService', function($scope, $rootScope, appService) {
	$scope.init = function () {
		$("#pagesList").children().removeClass("active");
		$("#page1").addClass('active');
		$scope.curState = 1;
		$scope.activeNewsList = [];
		$('#newsOfCate').removeClass("hidden");
		$rootScope.$on("passNewsListOfCate", function(event, data) {
			$scope.curCateNews = {};
			$scope.curCateNews.newsList = [];
			$scope.numOfNewsInEachPage = 8;
			$scope.pageIndexsList = [];
			$scope.curCateNews.name = data.cateName;
			$scope.curCateNews.newsList = JSON.parse(data.newsData);
			for(var i = 0; i < $scope.curCateNews.newsList.length; i ++) {
				// var idTmp = $scope.curCateNews.newsList[i]["pk"];
				// $scope.curCateNews.newsList[i] = $scope.curCateNews.newsList[i]["fields"];
				// $scope.curCateNews.newsList[i].id = idTmp;
				//alert(JSON.stringify($scope.curCateNews.newsList[i].imagesList[0]));
				//alert($scope.curCateNews.newsList[i].imagesList[0].name);
				$scope.curCateNews.newsList[i].order = i + 1;
				$scope.curCateNews.newsList[i].shortDescription = $scope.curCateNews.newsList[i].shortDescription.slice(0,200) + " ...";
				if (i == ($scope.numOfNewsInEachPage - 1)) {
					$scope.pageIndexsList[0] = 1;
				}
				if (i > ($scope.numOfNewsInEachPage - 1)) {
					if (((i+1)/$scope.numOfNewsInEachPage) > $scope.pageIndexsList.length) {
						$scope.pageIndexsList[((i+1)/$scope.numOfNewsInEachPage) - 1] = (i+1)/$scope.numOfNewsInEachPage;
					}
				}
			}
			if ($scope.curCateNews.newsList.length % $scope.numOfNewsInEachPage != 0) {
				$scope.pageIndexsList[$scope.pageIndexsList.length] = $scope.pageIndexsList.length + 1;
			}
			$scope.activeNewsList = $scope.curCateNews.newsList.slice(0,$scope.numOfNewsInEachPage);
			$scope.$applyAsync();
			//$scope.$apply();
			//alert($scope.curCateNews.name);
		});
	}
	//
	$scope.stickToBookmark = function (newsId) {
		return appService.stickToBookmark(newsId);
	}
	//
	$scope.getPageByIndex = function (idx) {
		if (idx < 1 || idx > $scope.pageIndexsList[$scope.pageIndexsList.length - 1]) {
			$scope.$applyAsync();
			return 0;
		}
		$("#page" + $scope.curState).removeClass('active');
		$("#page" + idx).addClass('active');
		$scope.curState = idx;
		var leftLimit = ($scope.curState - 1) * $scope.numOfNewsInEachPage;
		var rightLimit = ($scope.curState) * $scope.numOfNewsInEachPage;
		$scope.activeNewsList = $scope.curCateNews.newsList.slice(leftLimit, rightLimit);
		$scope.$applyAsync();
	}
	//
	$scope.loadNews = function (news) {
		$scope.$applyAsync(function () {
			$rootScope.$broadcast("passNewsFromCate", news);
			$('#newsField').removeClass("hidden");
		});
	}
}]);


app.controller("newsController", ['$scope', '$rootScope', 'appService',function($scope, $rootScope, appService) {
	$rootScope.$on("passNewsFromCate", function(event, data) {
		document.getElementById('newsField').scrollIntoView();
		$scope.news = data;
		$('#newsContent').html($scope.news.content);
		//alert($scope.news.content);
		$scope.$applyAsync();
		//$scope.$apply();
		//alert($scope.curCateNews.name);
	});
	//
	$scope.stickToBookmark = function (newsId) {
		return appService.stickToBookmark(newsId);
	}
}]);