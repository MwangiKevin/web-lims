app.controller('registrationCtrl',['$scope','$http','Commons',function ($scope,$http,Commons){
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
      $http.post(Commons.baseURL+'api/registration/submit',{params:$scope.user})
      .success(function(response){
        $location.path( "/dashboard" );        
        swal("Registered!", "You have been successfully registered. \n Check your email to confirm your registration", "success");
      }) 
      .error(function(response){  
        $scope.loading = false;
        swal("Error!", "Something went wrong, Please try again ", "error");      
      })
    }

  };
}])

