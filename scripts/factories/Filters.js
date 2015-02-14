app.factory('Filters',['$http', function($http){
	var Filters={};
  Filters.getEntities = function () {
    return $http.get('api/filters/entities');
  };
  Filters.getPrograms = function () {
    return $http.get('api/filters/programs');
  };
  Filters.getDates = function () {
    return $http.get('api/filters/dates');
  };

  return Filters;
}]);