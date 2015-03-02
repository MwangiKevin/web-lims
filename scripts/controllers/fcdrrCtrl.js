app.controller('fcdrrCtrl',['$scope','$http','ngProgress', 'Filters', 'Commons','$activityIndicator','API',	function($scope,$http,ngProgress,Filters,Commons,$activityIndicator,API){
	
	Commons.activeMenu = "fcdrr";

	$scope.formData = {};

	$scope.the_commodities = [];
	$http.get('fcdrr/get_commodities_and_categories').success(function($data){ $scope.the_commodities=$data; });

	$scope.currentFacility= {id:"34",name:"Lunga Lunga", mflcode:"12720"};
	$scope.facilities=API.getFacilities();
	$scope.commodities=API.getComodities();


}




]);
