app.controller('loginCtrl',['$scope','Commons',function ($scope,Commons){
    
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
                alert(success);
			}
		});	
    }
}])

