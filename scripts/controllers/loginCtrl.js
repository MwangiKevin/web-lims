app.controller('loginCtrl',['$scope','$rootScope','$state','Commons', 'apiAuth', 'Restangular','$window','$localStorage','$sessionStorage', function ($scope,$rootScope,$state,Commons,apiAuth,Restangular,$window,$localStorage,$sessionStorage){
    
   	$scope.username = "";
   	$scope.password = "";
    
    $scope.selected = {
              facility:[]
    }  
    $scope.auth_error = false;  
    $rootScope.$storage= $rootScope.store = $localStorage.$default({
        filter_type : 0,
        filter_id   : 0,
        user:[]       
    });
    
    $rootScope.getFilterType = function(){
        return $rootScope.$storage.filter_type;
    }
    $rootScope.getFilterId = function(){
        return $rootScope.$storage.filter_id;
    }

    $scope.submit = function (){
    	username = $scope.username;
    	password = $scope.password;
    	
    	var formData = {username:username,password:password};

     $.ajax({
       url:Commons.baseURL+"api/auth/login",
       type: 'POST',
       data:formData,
       success:function(res){
          $state.reload();
      }
    })
    .done(function( data, textStatus, jqXHR ){


        apiAuth.loginConfirmed();


        $rootScope.getSessionDetails().success(function(data){

          $scope.auth_error = false;  
          $rootScope.sess= data;
          $scope.password = "";
          
          if(data.loggedin){
            $rootScope.menuName= data.name;
          }else{
            $rootScope.menuName= "Action";      
          }
        })

        if(jqXHR.status == 202){
          // swal("Change password!", "You are using the default password. \nYou need to change it");
          swal({   
            title: "Change password",   
            text: "You are using the default password. \nYou need to change it!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, Change it!",   
            cancelButtonText: "No, cancel!",   
            closeOnConfirm: true,   
            closeOnCancel: false 
          },
          function(isConfirm){   
            if (isConfirm) { 
              // $location.path( "#/change_password" );   
              $window.location.href = "#/change_password";
            } else {     
              swal("Cancelled", "You will be asked to change the password next time.", "error");   
            } 
          });
        }
     })

      .fail(function( jqXHR, textStatus, errorThrown ){      
          $scope.auth_error = true;  
      })    
    }

    $scope.facilities=[]; 
     

    $scope.baseFacilities = Restangular.all('facilities'); 
    $scope.refreshFacilities = function(search) {
      var params = {address: search, sensor: false};                    

      $scope.baseFacilities.getList({search:search,limit_items:6}).then(function(com) {
        $scope.facilities = com;
      });  

      return  $scope.facilities ;
    };
    $scope.$watch('selected.facility',function(){

      if($scope.facility_login){

        $scope.username  =   $scope.selected.facility.facility_mfl_code;
      }

    });
    $scope.$watch('facility_login',function(){      
      $scope.username = "";
      $scope.selected = {
            facility:[]
      };
    });

}])

