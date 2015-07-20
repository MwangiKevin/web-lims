app.controller('newCD4DeviceCtrl',
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
    '$filter',
    function($stateParams,$state,$scope,$http,ngProgress,Filters,Commons,$activityIndicator,API,SweetAlert,notify,Restangular,apiAuth,$filter){
     
    apiAuth.requireLogin();

    $scope.selected = {}; // used for the drop down boxes when user selects a value
    $scope.dateAsString = $filter('date')(new Date(), "yyyy-MM-dd"); // current date

    $scope.baseCD4Devices = Restangular.all('facility_devices'); // to make posting possible

    var new_cd4_form = $("#new_cd4");

    $scope.populateDevice_types = function() { // get all the device types and populate the U.I
        var loaded_device_types = Restangular.all('device_types');
        loaded_device_types.getList().then(function(dev_types) {
           $scope.device_types = dev_types;
        })
            
    }

    $scope.populateFacilities = function() { // get all the facilities and populate the U.I
        var loaded_facilities = Restangular.all('facilities');
        loaded_facilities.getList().then(function(facilities_load) {
           $scope.facilities = facilities_load;
        })
          
    }
    $scope.$watch('check_roll', function(){ // rollout device or not. If not rolled out, deactivation reason
            $scope.deact_reason = !$scope.check_roll;

            if($scope.deact_reason === false){
                $scope.facility_dev_detail.deactivation_reason = '';
                $scope.facility_dev_detail.date_removed = '';
            }

        }, true );

    $scope.facility_change = function (id){ // when a facility is chosen, the facility details are populated on the U.I

        $scope.populateFacility_details($scope.selected.facility.id);
    }
    $scope.dev_type_change = function(){
        $scope.facility_dev_detail.device_name = $scope.selected.device_type.name;
        $scope.facility_dev_detail.device_id = $scope.selected.device_type.id;
        //$scope.facility_dev_detail.date_added = new Date();
    }

    $scope.populateFacility_details = function(id) { // fetch facility details based on the id chosen respectively by the facility name
        var loaded_facility = Restangular.one('facilities', id);
        loaded_facility.get().then(function(facility_load) {
           $scope.facility_detail = facility_load;

           $scope.facility_dev_detail.facility_id = $scope.facility_detail.facility_id;
           $scope.facility_dev_detail.facility_mfl_code = $scope.facility_detail.facility_mfl_code;
           $scope.facility_dev_detail.sub_county_name = $scope.facility_detail.sub_county_name;
           $scope.facility_dev_detail.facility_sub_county_id = $scope.facility_detail.facility_sub_county_id;
           $scope.facility_dev_detail.county_name = $scope.facility_detail.county_name;
           $scope.facility_dev_detail.partner_name = $scope.facility_detail.partner_name;
           $scope.facility_dev_detail.facility_partner_id = $scope.facility_detail.partner_id;
           $scope.facility_dev_detail.facility_central_site_id = $scope.facility_detail.central_site_id;
           $scope.facility_dev_detail.central_site_name = $scope.facility_detail.central_site_name;

        })
    }

    $scope.isInvalid = function () {
            return !new_cd4_form.form('validate form');
    };

    $scope.save_new_device = function(){ // save the new CD4 device

            if(!$scope.facility_dev_detail.deactivation_reason ==''){
                $scope.facility_dev_detail.date_removed = $scope.dateAsString; // set today's date if deactivation reason is entered
                $scope.facility_dev_detail.status = 0;
            }else{
                $scope.facility_dev_detail.status = 1;
                $scope.facility_dev_detail.date_removed = '';
            }

            $scope.facility_dev_detail.date_added = $scope.dateAsString; //assign date to data being sent

            swal({
                title: "Are you sure?",
                text: "Do you want to save this device "+$scope.facility_dev_detail.serial_number+"",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#00b5ad",
                confirmButtonText: "Yes, Save it!",
                closeOnConfirm: false,
            }, function() {
                $scope.baseCD4Devices.post($scope.facility_dev_detail).then(function(facility_dev_detail) {
                    swal("Saved!", $scope.facility_dev_detail.serial_number+" has been saved as a new CD4 device", "success");
                    //$state.transitionTo('CD4Devices');
                }, function(response) {
                    console.log("Error with status code", response);
                    swal("Error!", "An Error was encountered. \n Your device has not been saved", "error");
                });
            });
        
    }

    // run functions to populate U.I
    $scope.populateFacilities();
    $scope.populateDevice_types();

}]);