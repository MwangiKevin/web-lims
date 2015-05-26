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
	Filters.getEntities = function () {

		search_term="";
		
		$activityIndicator.startAnimating();
		return $http.get('api/filters/entities',{params:{limit_items:3,search:search_term}}).success(function(){$activityIndicator.stopAnimating()});
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