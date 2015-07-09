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

       $scope.populateCounty = function(id) {
            if ($stateParams.id > 0) {
                var loaded_county = Restangular.one('counties',id);
                loaded_county.get().then(function(county_load) {
                   $scope.county = county_load;

                   $scope.facility_detail.county_id = $scope.county.id;
                   $scope.facility_detail.county_name = $scope.county.region_name;

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

        $scope.populatePartners = function() {
            if ($stateParams.id > 0) {
                var loaded_partners = Restangular.all('partners');
                loaded_partners.getList().then(function(partners) {
                   $scope.partners = partners;
                })
            }
        }

        $scope.sub_county_change =function(id){
            $scope.populateCounty(id);
        }


         $scope.populateFacility_details();
         $scope.populateSubcounties();
         $scope.populatePartners();

    
}]);