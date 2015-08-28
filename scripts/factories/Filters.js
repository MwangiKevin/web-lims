app.factory('Filters',['$http','$activityIndicator', function($http,$activityIndicator){
	var Filters=
	{
		dates:
		{
			start:null,
			end:null
		},
		entity:{}
	};
	Filters.getEntities = function (search_term,items,type) {
		if(!items || angular.isUndefined(items))  {
			items = 3;
		}

		if(!type || angular.isUndefined(type))  {
			type = "all";
		}		
		$activityIndicator.startAnimating();
		return $http.get('api/filters/entities',{params:{limit_items:items,search:search_term,entity_type:type}}).success(function(){$activityIndicator.stopAnimating()});
	};
	
	Filters.getDates = function () {
		
		$activityIndicator.startAnimating();
		return $http.get('api/filters/dates').success(function(){$activityIndicator.stopAnimating()});
	};	
	
	Filters.getSelectedEntity = function () {
		
		$activityIndicator.startAnimating();
		return $http.get('api/filters/entities').success(function(){$activityIndicator.stopAnimating()});
	};
	
	Filters.getSelectedDates = function () {
		
		$activityIndicator.startAnimating();
		return $http.get('api/filters/dates').success(function(){$activityIndicator.stopAnimating()});
	};

	Filters.getSelectedDates = function () {
		return Filters.dates;
	};
	Filters.getSelectedEntity = function () {
		return Filters.entity;
	};

	return Filters;
}]);