app.controller('loginCtrl',['$scope','$rootScope','Commons', 'apiAuth', 'Restangular',function ($scope,$rootScope,Commons,apiAuth,Restangular){
    
   	$scope.username = "";
   	$scope.password = "";
    
    $scope.selected = {
              facility:[]
    } 

    $scope.submit = function (){
    	username = $scope.username;
    	password = $scope.password;
    	
    	var formData = {username:username,password:password};

     $.ajax({
       url:Commons.baseURL+"api/auth/login",
       type: 'POST',
       data:formData,
       success:function(success){

      }
    })
     .done(function( data, textStatus, jqXHR ){
        apiAuth.loginConfirmed();

        $rootScope.getSessionDetails().success(function(data){
          $rootScope.sess= data;

          if(data.loggedin){
            $rootScope.menuName= data.name;
          }else{
            $rootScope.menuName= "Action";      
          }
        })
     })

      .fail(function( jqXHR, textStatus, errorThrown ){
        console.log(errorThrown);
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

