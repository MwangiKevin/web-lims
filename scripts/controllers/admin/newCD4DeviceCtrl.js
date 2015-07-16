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
    function($stateParams,$state,$scope,$http,ngProgress,Filters,Commons,$activityIndicator,API,SweetAlert,notify,Restangular,apiAuth){
     
    apiAuth.requireLogin();

    $scope.populateDevice_types = function() {
        var loaded_device_types = Restangular.all('device_types');
        loaded_device_types.getList().then(function(dev_types) {
           $scope.device_types = dev_types;
        })
            
    }

    $scope.populateFacilities = function() {
        var loaded_facilities = Restangular.all('facilities');
        loaded_facilities.getList().then(function(facilities_load) {
           $scope.facilities = facilities_load;
        })
          
    }

    $scope.populateFacilities();
    $scope.populateDevice_types();

    }]);