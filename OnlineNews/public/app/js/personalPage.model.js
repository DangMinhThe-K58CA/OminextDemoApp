var app = angular.module("personalPageApp", []).config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('{$');
    $interpolateProvider.endSymbol('$}');
});

app.factory('appService', function () {
	var factory = {};
	factory.stickToBookmark = function (newsId) {
		alert(newsId);
	}
	return factory;
});

app.controller("newsController", ['$scope', '$rootScope', 'appService',function($scope, $rootScope, appService) {
	$rootScope.$on("passNewsFromCate", function(event, data) {
		document.getElementById('newsField').scrollIntoView();
		$scope.news = data;
		//alert($scope.news.content);
		$('#newsContent').html($scope.news.content);
		$scope.$applyAsync();
		//$scope.$apply();
		//alert($scope.curCateNews.name);
	});

	$scope.cancelReading = function () {
		$scope.news = {};
		$('#newsField').addClass("hidden");
		$scope.$applyAsync();
	}
}]);


app.controller("hottestBookmarkController", ['$scope', '$rootScope', 'appService',function($scope, $rootScope, appService) {
	$scope.hottestList = [];
	$scope.init = function() {
		$.ajax({
			url: "/general/getHottestBookmarkList",
			type: "GET",
			success: function(jsonData) {
				//alert(jsonData);
				$scope.hottestList = JSON.parse(jsonData);
				for(var i = 0; i < $scope.hottestList.length; i ++) {
					$scope.hottestList[i].order = i + 1;
					$scope.hottestList[i].shortDescription = $scope.hottestList[i].shortDescription.slice(0,200) + " ...";
				}
				$scope.$applyAsync();
			}
		});
	}
	$scope.readNews = function (news) {
		$.ajax({
			url: 'general/readNewsInBookmark',
			type: 'GET',
			data: {newsId: news.id},
			success: function (jsonData) {
				if (jsonData != "0") {
					$rootScope.$broadcast("passNewsFromCate", news);
					$('#newsField').removeClass("hidden");
					$('#newsOfCate').addClass("hidden");
					$scope.$applyAsync();
				}
			}
		});
	}
}]);


app.controller("categoryController", ['$scope', '$rootScope', 'appService',function($scope, $rootScope, appService) {
	$scope.catesData = {};
	$scope.init = function () {
		$.ajax({
			url: 'general/getCategoryWithBookmarkData',
			type: 'GET',
			success: function (jsonData) {
				$scope.catesData = JSON.parse(jsonData);
				for (var i = 0; i < $scope.catesData.length; i ++) {
					var cate = $scope.catesData[i];
					cate.index = 3;
					for (var j = 0; j < cate.bookmarks.length; j ++) {
						cate.bookmarks[j].order = j + 1;
					}
				}
				$scope.$applyAsync();
			}
		});
	}
	$scope.readNews = function (newsId) {
		$.ajax({
			url: 'general/readNewsInBookmark',
			type: 'GET',
			data: {newsId: newsId},
			success: function (jsonData) {
				if (jsonData != "0") {
					for (var i = 0; i < $scope.catesData.length; i ++) {
						var cate = $scope.catesData[i];
						for (var j = 0; j < cate.bookmarks.length; j ++) {
							if (newsId == cate.bookmarks[j].newsId ) {
								cate.bookmarks[j].state = 1;
								var news = cate.bookmarks[j];
								$scope.$applyAsync(function () {
								$rootScope.$broadcast("passNewsFromCate", news);
								$('#newsField').removeClass("hidden");
							});
							}
						}
					}
					
				}
				else {
					return null;
				}
			}
		});
	}
	$scope.deleteNewsFromBookmark = function (newsId) {
		var cnf = confirm('Xóa tin khỏi bookmark ?');
		if (cnf) {
			$.ajax({
				url: 'general/deleteNewsFromBookmark',
				type: 'GET',
				data: {newsId: newsId},
				success: function (jsonData) {
					if (jsonData != "0") {
						for (var i = 0; i < $scope.catesData.length; i ++) {
							var cate = $scope.catesData[i];
							for (var j = 0; j < cate.bookmarks.length; j ++) {
								if (newsId == cate.bookmarks[j].newsId ) {
									cate.index -= 1;
									if (j == cate.bookmarks.length - 1) {
										cate.bookmarks.splice(j,1);
										$scope.$applyAsync();
									}
									else {
										cate.bookmarks.splice(j, 1);
										for (var k = j; k < cate.bookmarks.length; k ++ ) {
											cate.bookmarks[k].order = k;
										}
										$scope.$applyAsync();
									}
									
								}
							}
						}
						
					}
					else {
						return null;
					}
				}
			});
		}
		else {
			return null;
		}
	}
	$scope.showMoreNews = function (cateId) {
		for (var i = 0; i < $scope.catesData.length; i ++) {
			var cate = $scope.catesData[i];
			if (cate.cateId == cateId) {
				if (cate.index >= (cate.bookmarks.length - 3)) {
					cate.index = cate.bookmarks.length;
				}
				else {
					cate.index += 3;
				}
			}
		}
		$scope.$applyAsync();
	}
	$scope.hideLessNews = function (cateId) {
		for (var i = 0; i < $scope.catesData.length; i ++) {
			var cate = $scope.catesData[i];
			if (cate.cateId == cateId) {
				if (cate.index <= 3) {
					cate.index = 3;
				}
				else if (cate.index - 3 < 3) {
					cate.index = 3;
				}
				else {
					cate.index -= 3;
				}
			}
		}
		$scope.$applyAsync();
	}
	$scope.addNews = function () {
		window.location.href = "/";
	}
}]);