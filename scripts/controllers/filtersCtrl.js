app.controller('filtersCtrl',['$scope','$rootScope','Filters', function($scope,$rootScope,Filters){

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

	$scope.filters.selected  = {
		dates : {start:'',end:''},
		entity: []
	};

	$scope.$watch('filters.selected.dates', function(){

		alert($scope.filters.selected.dates.start);

    });
	


	$scope.refreshFilters = function(search_term) {
		Filters.getEntities(search_term)
		.success(function (ents) {
			$scope.filters.entities = ents;
		})
		.error(function (error) {
			$scope.status = 'Unable to load Filters data: ' + error.message;
		});

		Filters.getDates()
		.success(function (dates) {
			$scope.filters.dates = dates;
		})
		.error(function (error) {
			$scope.status = 'Unable to load Filters data: ' + error.message;
		});

		// $.extend(Filters.entity, $scope.filters.entities.selected);
	}
	$scope.refreshFilters("");

	$scope.filters.clear = function() {
		$scope.filters.entities.selected = undefined;

		Filters.entities.selected = undefined;
	};

	$scope.bindDates = function(st,en){
		$scope.filters.selected.dates.start = st
		$scope.filters.selected.dates.end = en

		$scope.ss = st;

		alert($scope.filters.selected.dates.start);
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