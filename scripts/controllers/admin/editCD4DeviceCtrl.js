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

    $scope.facility_dev_id = $stateParams.id;

    $scope.backDevices = function(){
            window.location = "#/CD4Devices";
        }

    $scope.populateDevice_details = function() {
            if ($stateParams.id > 0) {
                var loaded_facility_device = Restangular.one('facility_devices', $stateParams.id);
                loaded_facility_device.get().then(function(facility_device_load) {
                   $scope.facility_dev_detail = facility_device_load;

                   if($scope.facility_dev_detail.facility_rollout_status ==1){

                        $scope.check_roll = true;
                   }
                   else{
                        $scope.check_roll = false;
                   }
                })
            }
        }

    $scope.$watch('check_roll', function(){
            $scope.deact_reason = !$scope.check_roll;
        }, true );

    $scope.facility_change = function (id){

        $scope.populateFacility_details(id);
    }

    $scope.populateFacility_details = function(id) {
            if ($stateParams.id > 0) {
                var loaded_facility = Restangular.one('facilities', id);
                loaded_facility.get().then(function(facility_load) {
                   $scope.facility_detail = facility_load;

                   $scope.facility_dev_detail.facility_mfl_code = $scope.facility_detail.facility_mfl_code;
                   $scope.facility_dev_detail.sub_county_name = $scope.facility_detail.sub_county_name;
                   $scope.facility_dev_detail.county_name = $scope.facility_detail.county_name;
                   $scope.facility_dev_detail.partner_name = $scope.facility_detail.partner_name;

                })
            }
        }
    $scope.populateFacilities = function() {
            if ($stateParams.id > 0) {
                var loaded_facilities = Restangular.all('facilities');
                loaded_facilities.getList().then(function(facilities_load) {
                   $scope.facilities = facilities_load;
                })
            }
        }

    $scope.populateDevice_details();
    $scope.populateFacilities();
    

    }]);