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

		$activityIndicator.startAnimating();
		return $http.get('api/filters/entities').success(function(){$activityIndicator.stopAnimating()});
	};
	Filters.getDates = function () {
		
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