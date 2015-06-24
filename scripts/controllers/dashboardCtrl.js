app.controller('dashboardCtrl', ['$scope', '$timeout', 'ngProgress', 'Filters', 'Commons', '$activityIndicator', function($scope, $timeout, ngProgress, Filters, Commons, $activityIndicator) {
	Commons.activeMenu = "dashboard";
	$scope.getActiveSubmenuLV1 = Commons.getActiveSubmenuLV1;
	$scope.getActiveSubmenuLV2 = Commons.getActiveSubmenuLV2;
	Commons.requireNoLogin();
	ngProgress.color('#FFD3D3');
	$scope.showMe = 3;
	$scope.filters = {};
	$scope.filters.programs = {};
	$scope.filters.programs.selected = function() {
		return Filters.programs.selected;
	};
	$timeout(function() {}, 300);
	$scope.commons = Commons;
}])