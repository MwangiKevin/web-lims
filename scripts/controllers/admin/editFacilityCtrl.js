app.controller('editFacilityCtrl',
	[
	'$stateParams',
    '$state',
    '$scope',
    '$http',
    'ngProgress', 
    'Filters', 
    'Commons',
    '$activityIndicator',
    'API',
    'SweetAlert', 
    'notify',
    'Restangular',
    'apiAuth',
    function($stateParams,$state,$scope,$http,ngProgress,Filters,Commons,$activityIndicator,API,SweetAlert,notify,Restangular,apiAuth){
     
    apiAuth.requireLogin();

    $scope.facility_id = $stateParams.id;
    // $scope.promise = null;

    // $scope.baseFacilities = Restangular.all('facilities');

        $scope.backFacilities = function(){
            window.location = "#/facilities";
        }

        $scope.populateFacility_details = function() {
            if ($stateParams.id > 0) {
                var loaded_facility = Restangular.one('facilities', $stateParams.id);
                loaded_facility.get().then(function(facility_load) {
                   $scope.facility_detail = facility_load;
                })
            }
        }

       $scope.populateCounties = function() {
            if ($stateParams.id > 0) {
                var loaded_counties = Restangular.all('counties');
                loaded_counties.getList().then(function(county_load) {
                   $scope.counties = county_load;
                })
            }
        }

        $scope.populateSubcounties = function() {
            if ($stateParams.id > 0) {
                var loaded_sub_counties = Restangular.all('sub_counties');
                loaded_sub_counties.getList().then(function(sub_county_load) {
                   $scope.sub_counties = sub_county_load;
                })
            }
        }


         $scope.populateFacility_details();
         $scope.populateCounties();
         $scope.populateSubcounties();

    
}]);