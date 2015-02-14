app.controller('dashboardCtrl',['$scope','$timeout','ngProgress', 'Filters',function($scope,$timeout,ngProgress,Filters){

	// ngProgress.color('#cfba13');
	ngProgress.start();
	$timeout(ngProgress.complete(), 100000);

	$scope.showMe =3;
	$scope.filters 	={};
	$scope.filters.programs 	={};

	$scope.visible = 	function(page){

		if((page=="tests" || page=="tat" || page=="facilitiesTests" || page=="labPerformance"|| page=="SampleType" ||page=="BF") && Filters.programs.selected.initials=="EID"){
			return true;
		}
		else if((page=="tests" || page=="tat" || page=="facilitiesTests" || page=="labPerformance"|| page=="TBCoinf"|| page=="VLSuppression"|| page=="SampleType") && Filters.programs.selected.initials=="VL"){
			return true;
		}
		else{
			return false
		}
	}

	$scope.filters.programs.selected = function(){
		return Filters.programs.selected;
	}


}])
