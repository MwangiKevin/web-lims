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
	'ngActivityIndicator',
	'angularFileUpload',
	'smart-table',
	'cgBusy',
	'oitozero.ngSweetAlert',
	'cgNotify',
	'restangular',
	'validation', 
	'validation.rule',
    'http-auth-interceptor',
    'datatables', 
    'datatables.colvis', 
    'datatables.tabletools', 
    'datatables.colreorder'
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
				controller: 'limsLoginCtrl'
			},
			'navbar':{
				templateUrl: 'login/nav_bar',
				controller: 'navbarCtrl'
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
				templateUrl: 'login/navbar',
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


	.state('Registration',{
		url: '/registration',		
		abstract: false,
		views:{
			'main':{
				templateUrl: 'registration',
				controller:  'registrationCtrl'
			},
			'navbar':{
				templateUrl: 'login/navbar',
				controller: 'navbarCtrl'
			},
			'footer':{
				templateUrl: 'dashboard/footer',
				controller: ['$scope', function($scope){
				}]
			}
		}
	})

	.state('Logout',{
		url: '/logout',		
		abstract: false,
		views:{
			'main':{
				templateUrl: 'login/logout',
				controller:  'logoutCtrl'
			},
			// 'navbar':{
			// 	templateUrl: 'login/logout',
			// 	controller: 'navbarCtrl'
			// },
			// 'footer':{
			// 	templateUrl: 'dashboard/footer',
			// 	controller: ['$scope', function($scope){
			// 	}]
			// }
		}
	})

	//common routes
	
	.state('Dashboard.main',{
		url: '',
		templateUrl: 'dashboard/testing_trends',
		controller:'TestsTrendCtrl'		
	})


	.state('Dashboard.summary',{
		url: 'summary',
		templateUrl: 'dashboard/dashboard_summary',
		controller:'dashboardSummaryCtrl'
	})
	.state('Dashboard.testingTrends',{
		url: 'testingTrends',
		templateUrl: 'dashboard/testing_trends'	,
		controller:'TestsTrendCtrl'
	})
	.state('Dashboard.devices',{
		url: 'deviceDistribution',
		templateUrl: 'dashboard/devices',		
		controller:'device_distributionCtrl'		
	})
	.state('Dashboard.map',{
		url: 'map',
		templateUrl: 'dashboard/map'
	})
	.state('Dashboard.fcdrr_reporting',{
		url: 'fcdrrReporting',
		templateUrl: 'dashboard/fcdrr_reporting'		
	})
	.state('fillFCDRRS',{ /* fcdrr page loaded here */
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
				templateUrl: 'dashboard/footer'
			}
		}
	})
	.state('FCDRRS',{ /* fcdrr page loaded here */
		url: '/FCDRRS',
		views:{
			'main':{
				templateUrl: 'fcdrr/fcdrrs',
				controller: 'fcdrrsCtrl'
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
	.state('editFCDRR',{ /* fcdrr page loaded here */
		url: '/editFCDRR/{id:int}',
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
				templateUrl: 'dashboard/footer'
			}
		}
	})
	.state('CD4DeviceUploads',{
		url: '/CD4DeviceUploads',
		views:{
			'main':{
				templateUrl: 'devices/device_uploads',
				controller: deviceUploadsCtrl
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
	
	.state('Facilities',{
		url: '/facilities',
		views:{
			'main':{
				templateUrl: 'facilities',
				controller:'facilitiesCtrl'
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
	
	.state('EditFacility',{
		url: '/editFacility/{id:int}',
		views:{
			'main':{
				templateUrl: 'facilities/edit_facilities',
				controller:'editFacilityCtrl'
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
	
	.state('ViewFacility',{
		url: '/viewFacility/{id:int}',
		views:{
			'main':{
				// templateUrl: 'viewFacility',
				// controller:'viewFacilityCtrl'
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
	
	.state('newFacility',{
		url: '/newFacility',
		views:{
			'main':{
				templateUrl: 'facilities/newFacility',
				controller:'newFacilityCtrl'
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
				templateUrl: 'tests',
				controller:'cd4TestsCtrl'
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
				templateUrl: 'devices',
				controller:'cd4DevicesCtrl'
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
	.state('editCD4Device',{
		url: '/editCD4Device/{id:int}',
		views:{
			'main':{
				templateUrl: 'devices/editFacilityDevices',
				controller:'editCD4DeviceCtrl'
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
	.state('viewCD4Device',{
		url: '/viewCD4Device/{id:int}',
		views:{
			'main':{
				// templateUrl: 'viewDevice',
				// controller:'viewCD4DeviceCtrl'
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
	.state('newCD4Device',{
		url: '/newCD4Device',
		views:{
			'main':{
				// templateUrl: 'newDevice',
				// controller:'newCD4DeviceCtrl'
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
				templateUrl: 'reports',
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
	.state('commodities',{
		url: '/commodities',
		views:{
			'main':{
				// templateUrl: 'commodities',
				// controller:'commoditiesCtrl'
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
	.state('newCommodity',{
		url: '/newCommodity',
		views:{
			'main':{
				// templateUrl: 'newCommodity',
				// controller:'newCommodityCtrl'
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
	.state('editCommodity',{
		url: '/editCommodity/{id:int}',
		views:{
			'main':{
				// templateUrl: 'editCommodity',
				// controller:'editCommodityCtrl'
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
	.state('viewCommodity',{
		url: '/viewCommodity/{id:int}',
		views:{
			'main':{
				// templateUrl: 'viewCommodity',
				// controller:'viewCommodityCtrl'
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
	.state('partners',{
		url: '/partners',
		views:{
			'main':{
				templateUrl: 'admin',
				controller:'partnersCtrl'
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
	.state('newPartner',{
		url: '/newPartner',
		views:{
			'main':{
				// templateUrl: 'newPartner',
				// controller:'newPartnerCtrl'
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
	.state('editPartner',{
		url: '/editPartner/{id:int}',
		views:{
			'main':{
				templateUrl: 'admin/editPartner',
				controller:'editPartnerCtrl'
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
	.state('viewPartner',{
		url: '/viewPartner/{id:int}',
		views:{
			'main':{
				// templateUrl: 'viewPartner',
				// controller:'viewPartnerCtrl'
			},
			'navbar':{
				templateUrl: 'dashboard/navbar',
				controller: 'navbarCtrl'
			},
			'footer':{
				templateUrl: 'dashboard/footer',
			}
		}
	}).state('users',{
		url: '/users',
		views:{
			'main':{
				templateUrl: 'users',
				controller:'usersCtrl'
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
	.state('newUser',{
		url: '/newUser',
		views:{
			'main':{
				// templateUrl: 'newUser',
				// controller:'newPartnerCtrl'
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
	.state('editUser',{
		url: '/editUser/{id:int}',
		views:{
			'main':{
				templateUrl: 'users/edit',
				controller:'editPartnerCtrl'
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
	.state('viewUser',{
		url: '/viewUser/{id:int}',
		views:{
			'main':{
				// templateUrl: 'viewPartner',
				// controller:'viewPartnerCtrl'
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

}])
