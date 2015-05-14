app.controller('loginCtrl',['$scope','Commons', 'apiAuth',function ($scope,Commons,apiAuth){
    
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
     })

      .fail(function( jqXHR, textStatus, errorThrown ){
        console.log(errorThrown);
      })

      // apiAuth.login(username,password).success(function(){

      //     alert('done');
      // })
    }
}])

