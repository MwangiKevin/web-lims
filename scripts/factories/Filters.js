app.factory('Filters',['$http','$activityIndicator', function($http,$activityIndicator){
	var Filters={};
<<<<<<< HEAD
  Filters.getEntities = function () {

	$activityIndicator.startAnimating();
    return $http.get('api/filters/entities').success(function(){$activityIndicator.stopAnimating()});
  };
  Filters.getDates = function () {
  	
	$activityIndicator.startAnimating();
    return $http.get('api/filters/dates').success(function(){$activityIndicator.stopAnimating()});
  };
=======
	Filters.getEntities = function () {
		return $http.get('api/filters/entities');
	};
	Filters.getDates = function () {
		return $http.get('api/filters/dates');
	};
>>>>>>> feature/fcdrr

	return Filters;
}]);