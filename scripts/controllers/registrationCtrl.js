app.controller('registrationCtrl',['$scope',function ($scope){
	  var registrationForm = $("#form");

      $scope.user = {};
      $scope.loading = false;

      $scope.isInvalid = function () {
        return !registrationForm.form('validate form');
      };

      $scope.register = function () {
        if (this.isInvalid()) {
        	alert("sent");
          return;
        }

        this.loading = true;

        console.log(this.user);
      };
}])

