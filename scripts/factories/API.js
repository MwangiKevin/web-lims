app.factory('API', ['$location','$http',function($location,$http){
	var API={};

	API.getFacilities = function () {
		return $http.get('api/filters/dates');
	};
	API.getComodities = function () {
		return $http.get('api/filters/dates');
	};
	
	return API;
}])