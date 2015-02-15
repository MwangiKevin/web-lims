var app = angular
.module('dashboard',[
	'ngAnimate',
	'ngRoute',
	'ui.router',
	'ngProgress',
	'ngSanitize', 
	'ui.select',
	'daterangepicker',
	'chart.js',
	'highcharts-ng',
	'ngActivityIndicator'
	])
.config(['$stateProvider','$urlRouterProvider',function($stateProvider,$urlRouterProvider){

	$urlRouterProvider.otherwise('/');

	$stateProvider
	.state('Dashboard',{
		url: '/',		
		abstract: true,
		views:{
			'main':{
				 templateUrl: 'dashboard/dashboard_view',
				 controller:'dashboardCtrl'
			},
			'navbar':{
				templateUrl: 'dashboard/navbar',
				// controller: 'navbarCtrl'
			},
			'filter':{
				templateUrl: 'dashboard/filter',
				// controller: "filtersCtrl"
			},
			'footer':{
				templateUrl: 'dashboard/footer',
				controller: ['$scope', function($scope){
				}]
			}
		}
	})



	//common routes
	.state('Dashboard.main',{
		url: '',
		templateUrl: 'dashboard/dashboard_item',
		// controller:'dashboardTestTrendsCtrl'		
	})
	
	.state('facilities',{
		url: '/facilities',
		views:{
			'main':{
				templateUrl: 'facilities/facilities_view',
				// controller: ngProgress_Test
			},
			'navbar':{
				templateUrl: 'dashboard/navbar',
				controller: 'navbarCtrl'
			},
			'head':{
				templateUrl: 'dashboard/head_template',
				controller: ['$scope', function($scope){
					$scope.title= "EID/Viral Load Dashboard"
				}]
			},
			'footer':{
				templateUrl: 'dashboard/footer',
				controller: ['$scope', function($scope){
					$scope.title= "EID/Viral Load Dashboard"
				}]
			}
		}
	})

}]);
