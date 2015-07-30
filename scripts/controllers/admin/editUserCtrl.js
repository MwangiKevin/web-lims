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

    $scope.entities = [{ name: '', email:'',phone:'', type: '' }];
    $scope.user_groups=[];

    $scope.back_users = function(){
        window.location = "#/users";
    }

    $scope.user = {};

    $scope.populate_user = function() {
        if ($stateParams.id > 0) {
            var loaded_partner = Restangular.one('users', $stateParams.id);
            loaded_partner.get().then(function(user) {
               $scope.user = user;

                if($scope.user.banned == 0){
                    $scope.banned = false;
                }
                else{
                    $scope.banned = true;
                }
            })
        }
    }

    $scope.$watch('banned', function(){
       
       if($scope.banned){            
            $scope.user.banned = 1;
       }else{

            $scope.user.banned = 0;
       }
            
    }, true );

    $scope.put_user = function() {
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
    $scope.populate_user();

    $scope.refreshEntities = function(search_term) {
        Filters.getEntities(search_term)
        .success(function (ents) {
            $scope.entities = ents;
        })
        .error(function (error) {
            $scope.status = 'Unable to load Filters data: ' + error.message;
        });       
    }
    $scope.refreshEntities("");

    $scope.clear_entity = function($event) {
        $event.stopPropagation(); 
        $scope.user.linked_entity = {filter_type:0,filter_id:0};
    };

    $scope.get_user_groups= function (){
        $http.get(base_url+'api/auth/list_groups')
          .success(function(data, status, headers, config) {

            $scope.user_groups = data;

          });
    }
        
    $scope.get_user_groups();


}]);
