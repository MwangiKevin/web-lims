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
    '$filter',
    function($stateParams,$state,$scope,$http,ngProgress,Filters,Commons,$activityIndicator,API,SweetAlert,notify,Restangular,apiAuth,$filter){
     
    apiAuth.requireLogin();

    $scope.facility_dev_id = $stateParams.id;

    $scope.selected = {}; // used for the drop down boxes when user selects a value

    $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd-MM-yyyy', 'shortDate','yyyy-MM-dd'];
    $scope.format = $scope.formats[4];

    $scope.dateOptions = {
        formatYear: 'yy',
        startingDay: 1
      };
    $scope.open = function($event) {
    $event.preventDefault();
    $event.stopPropagation();

    $scope.opened = true;
  };
    var tomorrow = new Date();
  tomorrow.setDate(tomorrow.getDate() + 1);
  var afterTomorrow = new Date();
  afterTomorrow.setDate(tomorrow.getDate() + 2);
  $scope.events =
    [
      {
        date: tomorrow,
        status: 'full'
      },
      {
        date: afterTomorrow,
        status: 'partially'
      }
    ];


    $scope.getDayClass = function(date, mode) {
        if (mode === 'day') {
          var dayToCheck = new Date(date).setHours(0,0,0,0);

          for (var i=0;i<$scope.events.length;i++){
            var currentDay = new Date($scope.events[i].date).setHours(0,0,0,0);

            if (dayToCheck === currentDay) {
              return $scope.events[i].status;
            }
          }
        }

        return '';
      };

    $scope.backDevices = function(){
            window.location = "#/CD4Devices";
    }

    $scope.populateDevice_details = function() {
            if ($stateParams.id > 0) {
                var loaded_facility_device = Restangular.one('facility_devices', $stateParams.id);
                loaded_facility_device.get().then(function(facility_device_load) {
                   $scope.facility_dev_detail = facility_device_load;

                   if($scope.facility_dev_detail.facility_rollout_status == 1 && $scope.facility_dev_detail.status == 1){

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

            if($scope.deact_reason === false){
                $scope.facility_dev_detail.deactivation_reason = '';
                $scope.facility_dev_detail.date_removed = '';
            }
            
        }, true );

    $scope.facility_change = function (id){

        $scope.populateFacility_details($scope.selected.facility.id);
    }

    $scope.dev_type_change = function(){
        $scope.facility_dev_detail.device_name = $scope.selected.device_type.name;
        $scope.facility_dev_detail.device_id = $scope.selected.device_type.id;
    }

    $scope.populateFacility_details = function(id) {
            if ($stateParams.id > 0) {
                var loaded_facility = Restangular.one('facilities', id);
                loaded_facility.get().then(function(facility_load) {
                   $scope.facility_detail = facility_load;

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
        }
    $scope.populateFacilities = function() {
            if ($stateParams.id > 0) {
                var loaded_facilities = Restangular.all('facilities');
                loaded_facilities.getList().then(function(facilities_load) {
                   $scope.facilities = facilities_load;
                })
            }
    }
    $scope.populateDevice_types = function() {
            if ($stateParams.id > 0) {
                var loaded_device_types = Restangular.all('device_types');
                loaded_device_types.getList().then(function(dev_types) {
                   $scope.device_types = dev_types;
                })
            }
    }

    $scope.save_facility_device = function(){
        $scope.facility_dev_detail.date_added = $filter('date')($scope.facility_dev_detail.date_added, "yyyy-MM-dd");
        swal({
            title: "Are you sure?",
            text: "This makes changes to this device details",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#00b5ad",
            confirmButtonText: "Yes, Save it!",
            closeOnConfirm: false,
        }, function() {
            $scope.facility_dev_detail.put().then(function(facility_dev_detail) {
                swal("Saved!", "Your Changes for this device Have Been Updated", "success");
                $state.transitionTo('CD4Devices');
            }, function(response) {
                console.log("Error with status code", response);
                swal("Error!", "An Error was encountered. \n Your changes have not been made ", "error");
            });
        });
    }

    $scope.populateDevice_details();
    $scope.populateFacilities();
    $scope.populateDevice_types();
    

    }]);