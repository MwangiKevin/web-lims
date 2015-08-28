app.factory('apiAuth', ['authService','$rootScope','$http','$activityIndicator','$location','notify','$localStorage','$sessionStorage',function(authService,$rootScope,$http,$activityIndicator,$location,notify$localStorage,$sessionStorage){
	var apiAuth={};
	apiAuth.baseURL= base_url;

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
			if(response.loggedin){

				$rootScope.$storage.filter_type = response.user.linked_entity.filter_type;
				$rootScope.$storage.filter_id 	= response.user.linked_entity.filter_id;

			}else{
				$rootScope.$storage.filter_type	=	0;
				$rootScope.$storage.filter_id 	=	0;
			}


		});	
	}
	apiAuth.getFilterType = $rootScope.getFilterType =  function (){
		$http.get(
			'api/auth/get_filter_type'
			)
		.success(function(response){
			// return response.user.linked_entity.filter_type;
		});	
	}
	apiAuth.getFilterId = $rootScope.getFilterId =  function (){
		var r=0;
		$http.get(
			'api/auth/get_filter_id'
			)
		.success(function(response){
			r=  response;
		});	

		return r;
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
			$activityIndicator.stopAnimating();
			// notify({ message:'Your session was ended'} );

		})
	}
	return apiAuth;
}])