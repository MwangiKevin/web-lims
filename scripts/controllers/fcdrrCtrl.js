app.controller('fcdrrCtrl',['$scope','$http','ngProgress', 'Filters', 'Commons','$activityIndicator','API', function($scope,$http,ngProgress,Filters,Commons,$activityIndicator,API){

	Commons.activeMenu = "fcdrr";

	$scope.commodities=[];
	$scope.status = false;

    $scope.fcdrr={
    	head_info:{},
    	devicetests:{},
    	comodities:{}
    }

    function getCommodities() {
    	API.getCommodities('',true,true)
    	.success(function (comm) {
    		$scope.commodities = comm;
    	})
    	.error(function (error) {
    		$scope.status = 'Unable to load customer data: ' + error.message;
    	});
    }
    getCommodities();

}])
