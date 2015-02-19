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
				controller: 'navbarCtrl'
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
		templateUrl: 'dashboard/dashboard_summary',
		controller:'dashboardSummaryCtrl'		
	})


	.state('Dashboard.summary',{
		url: 'summary',
		templateUrl: 'dashboard/dashboard_summary',
		controller:'dashboardSummaryCtrl'		
	})
	
	.state('facilities',{
		url: '/facilities',
		views:{
			'main':{
				templateUrl: 'facilities/facilities_view'
			},
			'navbar':{
				templateUrl: 'dashboard/navbar',
				controller: 'navbarCtrl'
			},
			'footer':{
				templateUrl: 'dashboard/footer'
			}
		}
	})
	.state('fillFCDRR',{ /* fcdrr page loaded here */
		url: '/fillFCDRR',
		views:{
			'main':{
				templateUrl: 'fcdrr/fillFCDRR_view',
				 controller: 'fcdrrCtrl'
			},
			'navbar':{
				templateUrl: 'dashboard/navbar',
				controller: 'navbarCtrl'
			},
			'footer':{
				templateUrl: 'dashboard/footer',
			}
		}
	})
	.state('CD4DeviceUploads',{
		url: '/CD4DeviceUploads',
		views:{
			'main':{
				templateUrl: 'devices/CD4DeviceUploads_view'
			},
			'navbar':{
				templateUrl: 'dashboard/navbar',
				controller: 'navbarCtrl'
			},
			'footer':{
				templateUrl: 'dashboard/footer'
			}
		}
	})
	.state('CD4Tests',{
		url: '/CD4Tests',
		views:{
			'main':{
				templateUrl: 'tests/CD4Tests_view'
			},
			'navbar':{
				templateUrl: 'dashboard/navbar',
				controller: 'navbarCtrl'
			},
			'footer':{
				templateUrl: 'dashboard/footer',
			}
		}
	})
	.state('CD4Devices',{
		url: '/CD4Devices',
		views:{
			'main':{
				templateUrl: 'devices/CD4Devices_view',
				// controller: ngProgress_Test
			},
			'navbar':{
				templateUrl: 'dashboard/navbar',
				controller: 'navbarCtrl'
			},
			'footer':{
				templateUrl: 'dashboard/footer',
			}
		}
	})
	.state('Reports',{
		url: '/Reports',
		views:{
			'main':{
				templateUrl: 'reports/Reports_view',
				// controller: ngProgress_Test
			},
			'navbar':{
				templateUrl: 'dashboard/navbar',
				controller: 'navbarCtrl'
			},
			'footer':{
				templateUrl: 'dashboard/footer',
			}
		}
	})

}]);
