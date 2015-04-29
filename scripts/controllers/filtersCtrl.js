app.controller('filtersCtrl',['$scope','$location', 'Filters', function($scope,$location,Filters){

	$(".opensleft").hide();

	Filters.entities= {};
	Filters.dates= {}; 	
	Filters.dates.start = ''
	Filters.dates.end = ''

	$scope.filters = {};
	$scope.filters.dates = {};

	$scope.filters.entities = [{ name: '', email:'',phone:'', type: '' }];

	$scope.filters.dates.start = ''
	$scope.filters.dates.end = ''

	initializeFilters();

	function initializeFilters() {
		// Filters.getEntities()
		// .success(function (ents) {
			// $scope.filters.entities = ents;
		// })
		// .error(function (error) {
			// $scope.status = 'Unable to load Filters data: ' + error.message;
		// });

		Filters.getDates()
		.success(function (dates) {
			$scope.filters.dates = dates;
		})
		.error(function (error) {
			$scope.status = 'Unable to load Filters data: ' + error.message;
		});

		$.extend(Filters.entity, $scope.filters.entities.selected);
	}

	$scope.filters.clear = function() {
		$scope.filters.entities.selected = undefined;

		Filters.entities.selected = undefined;
	};

	$scope.bindDates = function(st,en){
		$scope.filters.dates.start = st
		$scope.filters.dates.end = en

		Filters.dates.start = st
		Filters.dates.end = en	
	}

}])
.filter('entityFilter', function() {
	return function(items, props) {
		var out = [];

		if (angular.isArray(items)) {
			items.forEach(function(item) {
				var itemMatches = false;

				var keys = Object.keys(props);
				for (var i = 0; i < keys.length; i++) {
					var prop = keys[i];
					var text = props[prop].toLowerCase();
					if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
						itemMatches = true;
						break;
					}
				}

				if (itemMatches) {
					out.push(item);
				}
			});
		} else {
      // Let the output be the input untouched
      out = items;
  }

  return out;
};
})