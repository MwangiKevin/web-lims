app.factory('API', ['$location','$http','$activityIndicator',function($location,$http,$activityIndicator){
	var API={};
	var commodities = [34];

	API.getFacilities = function (id) {

		params = {id: id};
		$activityIndicator.startAnimating();
		return $http.get(
			'api/facilities',
			{params: params}
			)
		.success(function(response){
			$activityIndicator.stopAnimating() 
		});
	};
	API.getCommodities = function (id,fcdrr_format,reportingOnly) {

		params = {id: id, fcdrr_format: fcdrr_format, reportingOnly: reportingOnly};
		$activityIndicator.startAnimating();
		return $http.get(
			'api/commodities',
			{params: params}
			)
		.success(function(response){
			$activityIndicator.stopAnimating() 
		});
	};

	API.getfcdrrs = function(){

	};

	return API;
}])