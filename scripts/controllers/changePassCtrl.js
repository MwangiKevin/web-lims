app.controller('changePassCtrl',['$scope','$http','Commons','$location',function ($scope,$http,Commons,$location){
  var registrationForm = $("#form");
  Commons.requireNoLogin();
  $scope.user = {};
  $scope.loading = false;

  $scope.isInvalid = function () {
    return !registrationForm.form('validate form');
  };

  $scope.register = function () {
    if (this.isInvalid()) {  

    }else{
      this.loading = true;
      $http.post(Commons.baseURL+'api/auth/set_password',{password:$scope.user.password})
      .success(function(response){
        $location.path( "/dashboard" );        
        swal("Password Changed!", "You have been successfully changed your password . \n Check your email to confirm", "success");
      }) 
      .error(function(response){  
        $scope.loading = false;
        swal("Error!", "Something went wrong, Please try again ", "error");      
      })
    }

  };
}])

