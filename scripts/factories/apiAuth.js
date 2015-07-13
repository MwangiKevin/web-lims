app.factory('apiAuth', ['authService','$rootScope','$http','$activityIndicator','$location','notify',function(authService,$rootScope,$http,$activityIndicator,$location,notify){
	var apiAuth={};
	apiAuth.baseURL= base_url;

	// $rootScope.session = {
	// 	user:null,
	// 	loggedIn: false,
	// 	filter:{
	//         filter_type: 0,
	//         filter_id: 0
	//     }
	// }

	apiAuth.checkLoginSt = function (){
		return true;
	}

	apiAuth.requireNoLogin = function(){
		
		$rootScope.$broadcast('event:auth-loginNotRequired');
	}
	apiAuth.requireLogin = function(){
		return $http.get("api/auth/is_logged_in");
	}
	apiAuth.loginConfirmed = function(){
		
		$rootScope.$broadcast('event:auth-loginConfirmed');
		return apiAuth.getSessionDetails();
	}

	apiAuth.getSessionDetails = $rootScope.getSessionDetails =  function (){
		return  $http.get(
			'api/auth/get_session_details'
			)
		.success(function(response){

		});	
	}

	apiAuth.login = function(usr,pwd){	
		$activityIndicator.startAnimating();

		return $http.post(
			'api/auth/login',
			{
				username: usr,
				password: pwd
			}
			)
		.success(function(response){
			notify({ message:'You have successfully logged in'} );
			$activityIndicator.stopAnimating() 
		});
	}

	apiAuth.logout = function(){
		return $http.post('api/auth/logout')
		.success(function(response){
			$location.path( "/logout" );
			$activityIndicator.stopAnimating() 
			notify({ message:'Your session was ended'} );

		})
	}
	return apiAuth;
}])