
app.controller('fcdrrCtrl',['$scope','$http','ngProgress', 'Filters', 'Commons','$activityIndicator',function($scope,$http,ngProgress,Filters,Commons,$activityIndicator){
	$scope.users = [];
	$http.get('fcdrr/get_commodities').success(function($data){ $scope.users=$data; });


}])
