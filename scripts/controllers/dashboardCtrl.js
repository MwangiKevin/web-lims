app.controller('dashboardCtrl',['$scope','$timeout','ngProgress', 'Filters','$activityIndicator',function($scope,$timeout,ngProgress,Filters,$activityIndicator){

	ngProgress.color('#FFD3D3');
	ngProgress.start();
	$timeout(ngProgress.complete(), 100000);

	$scope.showMe =3;
	$scope.filters 	={};
	$scope.filters.programs 	={};

	$scope.filters.programs.selected = function(){
		return Filters.programs.selected;
	};

	$activityIndicator.startAnimating();
	$timeout(function () {
		$activityIndicator.stopAnimating();
	}, 300);
}])
