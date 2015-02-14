app.controller('filtersCtrl',['$scope','$location', 'Filters', function($scope,$location,Filters){

	Filters.programs= {};
	Filters.entities= {};
	Filters.dates= {}; 	
	Filters.programs.selected =	{ name: 'Viral Load', 				initials:'VL' };			//all these needs to be put in a provider
	Filters.dates.start = ''
	Filters.dates.end = ''

	$scope.filters = {};
	$scope.filters.programs = [{ name: '', 				initials:'' }];	
	$scope.filters.programs.selected = 	Filters.programs.selected ;
	$scope.filters.dates = {};

	$scope.filters.entities = [{ name: '', email:'',phone:'', type: '' }];

	$scope.filters.dates.start = ''
	$scope.filters.dates.end = ''

	initializeFilters();


	function initializeFilters() {
		Filters.getEntities()
		.success(function (ents) {
			$scope.filters.entities = ents;
		})
		.error(function (error) {
			$scope.status = 'Unable to load Filters data: ' + error.message;
		});


		Filters.getPrograms()
		.success(function (prog) {
			$scope.filters.programs = prog;
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

	$scope.filters.clear = function() {
		$scope.filters.entities.selected = undefined;
		$scope.filters.programs.selected = undefined;

		Filters.entities.selected = undefined;
		Filters.programs.selected = undefined;
	};

	$scope.bindProgramSelected= function (){
		Filters.programs.selected =$scope.filters.programs.selected 
		$location.path( Filters.programs.selected.initials );
	}
	$scope.bindDates = function(st,en){
		$scope.filters.dates.start = st
		$scope.filters.dates.end = en

		Filters.dates.start = st
		Filters.dates.end = en	}

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