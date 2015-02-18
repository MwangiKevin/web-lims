
app.controller('fcdrrCtrl',['$scope','$http','ngProgress', 'Filters', 'Commons','$activityIndicator',function($scope,$http,ngProgress,Filters,Commons,$activityIndicator){
	
	Commons.activeMenu = "fcdrr";

	$scope.the_commodities = [];
	$http.get('fcdrr/get_commodities_and_categories').success(function($data){ $scope.the_commodities=$data; });


}])
