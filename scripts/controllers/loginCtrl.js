app.controller('loginCtrl',['$scope','$rootScope','Commons', 'apiAuth',function ($scope,$rootScope,Commons,apiAuth){
    
   	$scope.username = "";
   	$scope.password = "";

    
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

      // apiAuth.login(username,password).success(function(){

      //     alert('done');
      // })
    }
}])

