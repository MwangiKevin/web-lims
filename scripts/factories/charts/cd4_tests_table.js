app.controller('cd4_tests_table',['$scope', 'Filters',function($scope,Filters){
	$scope.mydate = $filter('getDates');
	
	// $scope.test_table = new function test_table(){
		// var entity_filter = $filter('getEntities');
		// var date_filter = $filter('getDates');
		// var myname = 'Oscar';
	// }
}]);