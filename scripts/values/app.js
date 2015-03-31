var app = angular
.module('dashboard',[
	'ngRoute',
	'ui.router',
	'ngProgress',
	'ngSanitize', 
	'ui.select',
	'daterangepicker',
	'chart.js',
	'highcharts-ng'
	])
	
.config(['$stateProvider','$urlRouterProvider',function($stateProvider,$urlRouterProvider){

	$urlRouterProvider.otherwise('/');	
	$stateProvider
	//LIMS Login	
	.state('limsLogin',{
		url: '/lims_login',	
		views:{
			'main':{
				templateUrl: 'login/lims_login',
				controller: ['$scope', function($scope){
					$scope.pageTitle= "LIMS/VL | Login"
					$scope.application = 'Lab Information System Management/Viral Load'
					$scope.Title = 'United Republic of Tanzania'
				}]
			},
			'navbar':{
				templateUrl: 'login/nav_bar'
			},
			'head':{
				templateUrl: 'dashboard/head_template',
				controller: ['$scope', function($scope){
					$scope.title= "LIMS/VL | Login"
				}]
			},
			'footer':{
				templateUrl: 'dashboard/footer',
				controller: ['$scope', function($scope){
				}]
			}
		}
	})

	
	//EID Login	
	.state('Login',{
		url: '/login',		
		views:{
			'main':{
				templateUrl: 'login/login_v',
				controller: 'loginCtrl'
			},
			'navbar':{
				templateUrl: 'login/nav_bar'
			},
			'head':{
				templateUrl: 'dashboard/head_template',
				controller: ['$scope', function($scope){
					$scope.title= "EID/VL | Login"
				}]
			},
			'footer':{
				templateUrl: 'dashboard/footer',
				controller: ['$scope', function($scope){
				}]
			}
		}
	})
	
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
				controller: 'navbarCtrl'
			},
			'head':{
				templateUrl: 'dashboard/head_template',
				controller: ['$scope', function($scope){
					$scope.title= "EID/Viral Load Dashboard"
				}]
			},
			'filter':{
				templateUrl: 'dashboard/filter',
				controller: "filtersCtrl"
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
		controller:'dashboardTestTrendsCtrl'		
	})
	.state('Dashboard.summary',{
		url: 'summary',
		templateUrl: 'dashboard/dashboard_item',
		controller:'dashboardTestTrendsCtrl'		
	})
	.state('Dashboard.tests',{
		url: 'tests',
		templateUrl: 'dashboard/dashboard_item',
		controller:'dashboardTestTrendsCtrl'		
	})
	.state('Dashboard.tat',{
		url: 'tat',
		templateUrl: 'dashboard/dashboard_item_singular',
		controller:'TATCtrl'
	})
	.state('Dashboard.facilitiesTests',{
		url: 'facilitiesTests',
		templateUrl: 'dashboard/dashboard_item'
	})
	.state('Dashboard.labPerformance',{
		url: 'labPerformance',
		templateUrl: 'dashboard/dashboard_item'
	})
	.state('Dashboard.SampleType',{
		url: 'SampleType',
		templateUrl: 'dashboard/dashboard_item'
	})


	//vl routes
	.state('Dashboard.VL',{
		url: 'VL',
		templateUrl: 'dashboard/dashboard_item',
		controller:'dashboardTestTrendsCtrl'
	})
	.state('Dashboard.VLtests',{
		url: 'VL/tests',
		templateUrl: 'dashboard/dashboard_item',
		controller:'dashboardTestTrendsCtrl'
	})
	.state('Dashboard.VLtat',{
		url: 'VL/tat',
		templateUrl: 'dashboard/dashboard_item_singular',
		controller:'TATCtrl'
	})
	.state('Dashboard.VLfacilitiesTests',{
		url: 'VL/facilitiesTests',
		templateUrl: 'dashboard/dashboard_item'
	})
	.state('Dashboard.VLlabPerformance',{
		url: 'VL/labPerformance',
		templateUrl: 'dashboard/dashboard_item'
	})
	.state('Dashboard.VLTBCoinf',{
		url: 'VL/TBCoinf',
		templateUrl: 'dashboard/dashboard_item'
	})
	.state('Dashboard.VLVLSuppression',{
		url: 'VL/VLSuppression',
		templateUrl: 'dashboard/dashboard_item'
	})
	.state('Dashboard.VLSampleType',{
		url: 'VL/SampleType',
		templateUrl: 'dashboard/dashboard_item'
	})

	//eid routes
	.state('Dashboard.EID',{
		url: 'EID',
		templateUrl: 'dashboard/dashboard_item'
	})
	.state('Dashboard.EIDtests',{
		url: 'EID/tests',
		templateUrl: 'dashboard/dashboard_item'
	})
	.state('Dashboard.EIDtat',{
		url: 'EID/tat',
		templateUrl: 'dashboard/dashboard_item_singular',
		controller:'TATCtrl'
	})
	.state('Dashboard.EIDfacilitiesTests',{
		url: 'EID/facilitiesTests',
		templateUrl: 'dashboard/dashboard_item'
	})
	.state('Dashboard.EIDlabPerformance',{
		url: 'EID/labPerformance',
		templateUrl: 'dashboard/dashboard_item'
	})
	.state('Dashboard.EIDSampleType',{
		url: 'EID/SampleType',
		templateUrl: 'dashboard/dashboard_item'
	})
	.state('Dashboard.EIDBF',{
		url: 'EID/BF',
		templateUrl: 'dashboard/dashboard_item'
	})

	.state('lab',{
		url: '/lab',
		views:{
			'main':{
				templateUrl: 'lab/lab_view',
				controller: ['$scope', function($scope){
					$scope.home= "dd"
				}]
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

	.state('test', {
		abstract: true,
		url: '/test',
		views: {
			'main': {
				template:  '<h1>Hello!!!</h1>' +
				'<div ui-view="view1"></div>' +
				'<div ui-view="view2"></div>'
			}
		}
	})
	.state('test.subs', {
		url: '',
		views: {
			'view1@test': {
				template: "Im View1"
			},
			'view2@test': {
				template: "Im View2"
			}
		}
	});
}]);
