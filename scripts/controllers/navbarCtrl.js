app.controller('navbarCtrl',
	['$scope',	
	'Commons',
	'apiAuth',
	'$rootScope',function($scope,Commons,apiAuth,$rootScope){

	$scope.getActiveMenu = Commons.getActiveMenu;
	$scope.menuName 	=	"";

	$scope.sess= "";
	$scope.sessionCheck = function(){	

		$scope.menuName 	=	"";

		apiAuth.getLoginDetails().success(function(data){
			$scope.sess = data;

			if(data.loggedin){
				$scope.menuName = data.name;
			}else{
				$scope.menuName = "Action";			
			}
		})
	}

	$scope.sessionCheck();



	$scope.login = function(){
		apiAuth.requireLogin();		
		$scope.sessionCheck();
	}

	$scope.logout = function(){
		
		apiAuth.logout().success(function(data){
			$scope.sessionCheck();
		});

	}


}])
