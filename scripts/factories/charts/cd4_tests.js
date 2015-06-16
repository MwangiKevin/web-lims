app.controller('cd4_tests',['$scope', 'Filters',function($scope,Filters){
	
	$scope.watch(function(){
		console.log( "Function watched" );
		
		// Filters.getDates()
		// .success(function (dates) {
			// $scope.filters.dates = dates;
			// console.log('works');
		// })
		// .error(function (error) {
			// $scope.status = 'Unable to load Filters data: ' + error.message;
		// });
		
	},function(){
		console.log('works');
	})
	
	// $scope.test_table = new function test_table(){
		// //var entity_filter = $filter('getEntities');
		// //var date_filter = $filter('getDates');
// 		
// 		
		// var myname = 'Oscar';
	// }
// 	
}]);