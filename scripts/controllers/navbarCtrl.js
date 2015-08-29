app.controller('navbarCtrl',
	['$scope',	
	'Commons',
	'apiAuth',
	'$rootScope',
	function($scope,Commons,apiAuth,$rootScope){

	$scope.getActiveMenu = Commons.getActiveMenu;

	$rootScope.sess 		= "";
	$rootScope.menuName 	=	"";
	$rootScope.sessionName 	= function(){	

		$rootScope.menuName 	=	"";

		$rootScope.getSessionDetails().success(function(data){
			$rootScope.sess= data;

			if(data.loggedin){
				$rootScope.menuName= data.name;
			}else{
				$rootScope.menuName= "Action";			
			}
		})
	}

	$rootScope.sessionName();

	$scope.login = function(){
		apiAuth.requireLogin();		
		$rootScope.getSessionDetails();
	}

	$scope.logout = function(){
		
		apiAuth.logout().success(function(data){
			$rootScope.getSessionDetails();
		});
	}	

	$scope.change_password = function(){
        window.location = "#/change_password";
		$rootScope.getSessionDetails();
	}
}])
