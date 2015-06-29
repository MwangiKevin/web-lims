app.controller('editCD4DeviceCtrl',
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

    $scope.backDevices = function(){
            window.location = "#/CD4Devices";
        }

    $scope.populateDevice_details = function() {
            if ($stateParams.id > 0) {
                var loaded_facility_device = Restangular.one('facility_devices', $stateParams.id);
                loaded_facility_device.get().then(function(facility_device_load) {
                   $scope.facility_dev_detail = facility_device_load;
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
    $scope.populatePartners = function() {
            if ($stateParams.id > 0) {
                var loaded_partners = Restangular.all('partners');
                loaded_partners.getList().then(function(partners) {
                   $scope.partners = partners;
                })
            }
        }

    $scope.populateDevice_details();
    $scope.populateCounties();
    $scope.populateSubcounties();
    $scope.populatePartners();


    }]);