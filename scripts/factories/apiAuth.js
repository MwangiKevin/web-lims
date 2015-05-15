app.factory('apiAuth', ['authService','$rootScope','$location','$http','$activityIndicator',function(authService,$rootScope,$location,$http,$activityIndicator){
	var apiAuth={};
	apiAuth.baseURL= base_url;

	apiAuth.checkLoginSt = function (){
		return true;
	}

	apiAuth.checkLoginDetails = function (){
		return {
			name		: 	'kevin Mwangi',
			email		: 	'mwangikevinn@gmail.com',
			phone		: 	'+254723016811',
			user_type	: 	'1',
			facility	: 	'7'
		};
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
		.succes
		.s(function(response){
			$activityIndicator.stopAnimating() 
		})
	}

	apiAuth.publicAction = function (){


	}

	return apiAuth;
}])