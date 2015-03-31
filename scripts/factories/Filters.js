app.factory('Filters',['$http','$activityIndicator', function($http,$activityIndicator){
	var Filters={};
	Filters.getEntities = function () {
		
		$activityIndicator.startAnimating();
		return $http.get('api/filters/entities').success(function(){$activityIndicator.stopAnimating()});
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


	return Filters;
}]);