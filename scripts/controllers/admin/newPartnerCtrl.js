app.controller('newPartnerCtrl',
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

    apiAuth.requireLogin(); // This function is run to check if the user has logged in

    $scope.basePartners = Restangular.all('partners');

    $scope.save_partner = function(){ //save the facility details
        $scope.facility_detail.level = 0;
        $scope.facility_detail.site_prefix  = null;

        swal({
            title: "Are you sure?",
            text:  "This will save "+$scope.partner.name+" as a new Partner",
            type:  "info",
            showCancelButton: true,
            confirmButtonColor: "#00b5ad",
            confirmButtonText: "Yes, Save it!",
            closeOnConfirm: false,
        }, function() {
            $scope.basePartners.post($scope.partner).then(function(partner) {
                swal("Saved!", $scope.partner.name+" has been saved as a new partner ", "success");
                $state.transitionTo('partners');
            }, function(response) {
                console.log("Error with status code", response);
                swal("Error!", "An Error was encountered. \n The partner has not been saved ", "error");
            });
        });
    }
}]);