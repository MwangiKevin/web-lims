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
		entity: {filter_type:0,filter_id:0}
	};


	$rootScope.Filters = {

				change_tst : 0,
				change_dev : 0,
				selected 	: 	{
					dates 	: 	{
						start : '',
						end  : ''
					},
					entity:{filter_type:0,filter_id:0}
				},
				getFilterEntity 	: function(){return $rootScope.Filters.selected.entity},
				getFilterStartDate 	: function(){return $rootScope.Filters.selected.dates.start},
				getFilterEndDate 	: function(){return $rootScope.Filters.selected.dates.end}
			};

	$scope.$watch('filters.selected.dates.start', function(){
		
		$rootScope.Filters.change_tst += 1;
		$rootScope.Filters.change_dev += 1;
		$rootScope.Filters.selected.dates.start = $scope.filters.selected.dates.start;

    });

	$scope.$watch('filters.selected.dates.end', function(){	

		$rootScope.Filters.change_tst += 1;		
		$rootScope.Filters.change_dev += 1;	
		$rootScope.Filters.selected.dates.end = $scope.filters.selected.dates.end;

    });

	$scope.$watch('filters.selected.entity', function(){	

		$rootScope.Filters.change_tst += 1;	
		$rootScope.Filters.change_dev += 1;
		$rootScope.Filters.selected.entity = $scope.filters.selected.entity;

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
	}
	$scope.refreshFilters("");

	$scope.filters.clear = function($event) {
		$event.stopPropagation(); 
		$scope.filters.selected.entity = {filter_type:0,filter_id:0};
	};

	$scope.bindDates = function(st,en){
		$scope.filters.selected.dates.start = st
		$scope.filters.selected.dates.end = en

		$scope.ss = st;
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