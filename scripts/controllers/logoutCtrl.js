app.controller('logoutCtrl',['$scope','$rootScope','$state','Commons', 'apiAuth','notify', 'Restangular','$localStorage','$sessionStorage', function ($scope,$rootScope,$state,Commons,apiAuth,notify,Restangular,$localStorage,$sessionStorage){
       
      notify({ message:'Your session was ended', duration:2000} );

}])

