app.controller('editUserCtrl',
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

    $scope.user_id = $stateParams.id;

    $scope.bac_users = function(){
        window.location = "#/users";
    }

    $scope.user = {};

    $scope.populateUser = function() {
        if ($stateParams.id > 0) {
            var loaded_partner = Restangular.one('users', $stateParams.id);
            loaded_partner.get().then(function(user) {
               $scope.user = user;
            })
        }
    }

    $scope.put_partner = function() {
        swal({
            title: "Are you sure?",
            text: "This makes changes to this User",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#00b5ad",
            confirmButtonText: "Yes, Save it!",
            closeOnConfirm: false,
        }, function() {
            $scope.user.put().then(function(user) {
                swal("Saved!", "Your Changes Have Been Updated", "success");
                $state.transitionTo('users');
            }, function(response) {
                console.log("Error with status code", response);
                swal("Error!", "An Error was encountered. \n Your changes have not been made ", "error");
            });
        });
    }

    $scope.populateUser();

    }]);
