app.factory('apiAuth', ['authService','$rootScope','$http','$activityIndicator',function(authService,$rootScope,$http,$activityIndicator){
	var apiAuth={};
	apiAuth.baseURL= base_url;

	$rootScope.session = {
		user:null,
		loggedIn: false
	}

	apiAuth.checkLoginSt = function (){
		return true;
	}

	apiAuth.requireNoLogin = function(){
		
		$rootScope.$broadcast('event:auth-loginNotRequired');		
	}
	apiAuth.requireLogin = function(){
		
		$rootScope.$broadcast('event:auth-loginRequired');		
	}


	apiAuth.getLoginDetails = function (){
		return $http.get(
			'api/auth/get_session_details'
			)
		.success(function(response){

		});	
	}

	apiAuth.login = function(usr,pwd){

		params = {
			usr: usr,
			pwd: pwd
		};		
		$activityIndicator.startAnimating();

		return $http.post(
			'api/auth/login',
			{params: params}
			)
		.success(function(response){			
			$activityIndicator.stopAnimating() 
		});
	}

	apiAuth.logout = function(){
		return $http.post('api/auth/logout')
		.success(function(response){
			$activityIndicator.stopAnimating() 
		})
	}

	apiAuth.publicAction = function (){


	}

	return apiAuth;
}])