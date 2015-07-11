app.controller('editPartnerCtrl',
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

    $scope.partner_id = $stateParams.id;

    // $scope.editState = function() {
    //     if ($stateParams.id > 0) {
    //         return 'edit'
    //     } else {
    //         return 'new'
    //     }
    // }

    $scope.backPartners = function(){
            window.location = "#/partners";
        }

    $scope.populatePartner = function() {
            if ($stateParams.id > 0) {
                var loaded_partner = Restangular.one('partners', $stateParams.id);
                loaded_partner.get().then(function(partner) {
                   $scope.partner = partner;
                })
            }
        }

    // $scope.save_partner = function() {
    //     if ($scope.editState() == 'new') {
    //         $scope.post_partner();
    //     } else if ($scope.editState() == 'edit') {
    //         $scope.put_fcdrr();
    //     }
    // }

    $scope.put_partner = function() {
        swal({
            title: "Are you sure?",
            text: "This makes changes to this Partner",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#00b5ad",
            confirmButtonText: "Yes, Save it!",
            closeOnConfirm: false,
        }, function() {
            $scope.partner.put().then(function(partner) {
                swal("Saved!", "Your Changes Have Been Updated", "success");
                $state.transitionTo('partners');
            }, function(response) {
                console.log("Error with status code", response);
                swal("Error!", "An Error was encountered. \n Your changes have not been made ", "error");
            });
        });
    }

    $scope.populatePartner();

    }]);
