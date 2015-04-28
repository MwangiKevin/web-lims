app.controller('registrationCtrl',['$scope','$http','Commons',function ($scope,$http,Commons){
  var registrationForm = $("#form");

  $scope.user = {};
  $scope.loading = false;

  $scope.isInvalid = function () {
    return !registrationForm.form('validate form');
  };

  $scope.register = function () {
    if (this.isInvalid()) {  

    }else{
      // alert('freee');
      this.loading = true;
      // console.log(this.user);
      $http.post(Commons.baseURL+'api/registration/submit',{params:$scope.user});
    }

  };
}])

