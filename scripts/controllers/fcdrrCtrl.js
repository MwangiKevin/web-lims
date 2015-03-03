app.controller('fcdrrCtrl',['$scope','$http','ngProgress', 'Filters', 'Commons','$activityIndicator','API',	function($scope,$http,ngProgress,Filters,Commons,$activityIndicator,API){

	
	Commons.activeMenu = "fcdrr";

	$scope.the_commodities = [];
	$http.get('fcdrr/get_commodities_and_categories').success(function($data){ $scope.the_commodities=$data; });
	
    // $scope.total = function(){
    //     return parseInt($scope.facs_calibur_paed)+
    //     		parseInt($scope.facs_calibur_adult)+
    //     		parseInt($scope.facs_count_paed)+
    //     		parseInt($scope.facs_count_adult)+
    //     		parseInt($scope.cyflow_paed)+
    //     		parseInt($scope.cyflow_adult);
    // };

    $scope.fcdrr="";

    $scope.currentFacility= {id:"34",name:"Lunga Lunga", mflcode:"12720"};
    $scope.facilities=API.getFacilities();
    $scope.commodities=API.getComodities();



    $scope.fcdrr={
    	head_info:{ },
    	devicetests:{ },
    	comodities:{ }
    }

}


]);
