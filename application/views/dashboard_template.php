<!DOCTYPE html>
<html ng-app="dashboard" style="width:100%">

<head ui-view="head">    
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  <!-- Force Latest IE rendering engine -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="mobile-web-app-capable" content="yes">

	<title>CD4 LIMS |</title>


	<!--fav and touch icons -->

	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url('assets/images/favicon/apple-icon-57x57.png');?>">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url('assets/images/favicon/apple-icon-60x60.png');?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('assets/images/favicon/apple-icon-72x72.png');?>">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/images/favicon/apple-icon-76x76.png');?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('assets/images/favicon/apple-icon-114x114.png');?>">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url('assets/images/favicon/apple-icon-120x120.png');?>">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url('assets/images/favicon/apple-icon-144x144.png');?>">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url('assets/images/favicon/apple-icon-152x152.png');?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('assets/images/favicon/apple-icon-180x180.png');?>">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url('assets/images/favicon/android-icon-192x192.png');?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/images/favicon/favicon-32x32.png');?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('assets/images/favicon/favicon-96x96.png');?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/images/favicon/favicon-16x16.png');?>">
	<link rel="manifest" href="<?php echo base_url('assets/images/favicon/manifest.json');?>">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<!-- Styles -->

	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/semantic/dist/semantic.css');?>"> 

</head>

<body class="" style="width:100%">

	<div class="m-app-loading" ng-animate-children >

		<!-- view-source:http://bennadel.github.io/JavaScript-Demos/demos/pre-bootstrap-loading-screen-angularjs/
			HACKY CODE WARNING: I'm putting Style block inside directive so that it 
			will be removed from the DOM when we remove the directive container.
		-->
		<style type="text/css">

		div.m-app-loading {
			position: fixed ;
		}

		div.m-app-loading div.animated-container {
			background-color: #333333 ;
			bottom: 0px ;
			left: 0px ;
			opacity: 1.0 ;
			position: fixed ;
			right: 0px ;
			top: 0px ;
			z-index: 9999990000000 ;
		}

		/* Used to initialize the ng-leave animation state. */
		div.m-app-loading div.animated-container.ng-leave {
			opacity: 1.0 ;
			transition: all linear 200ms ;
			-webkit-transition: all linear 200ms ;
		}

		/* Used to set the end properties of the ng-leave animation state. */
		div.m-app-loading div.animated-container.ng-leave-active {
			opacity: 0 ;
		}

		div.m-app-loading div.messaging {
			color: #FFFFFF ;
			font-family: monospace ;
			left: 0px ;
			margin-top: -37px ;
			position: absolute ;
			right: 0px ;
			text-align: center ;
			top: 50% ;
		}

		div.m-app-loading h1 {
			font-size: 26px ;
			line-height: 35px ;
			margin: 0px 0px 20px 0px ;
		}

		div.m-app-loading p {
			font-size: 18px ;
			line-height: 14px ;
			margin: 0px 0px 0px 0px ;
		}

		</style>
		

		<!-- BEGIN: Actual animated container. -->
		<div class="animated-container">

			<div class="messaging">

				<h1>
					Please wait while <big>CD4 LIMS</big> loads..
				</h1>
				<div class="ui active inline loader"></div>
			</div>

		</div>
		<!-- END: Actual animated container. -->

	</div>
	<!-- END: App-Loading Screen. -->

	<div>
		<authmain>
			<div ui-view="navbar" ng-class="" class="ui grid" ng-cloak="" ></div>
			<div ng-controller="loginCtrl" class="ui one column stackable center aligned page grid" id="login-holder">
				<div ng-show="true" class="column nine wide" id="loginbox" style="background-color: #00b5ad;margin-top:35px;margin-bottom:35px;border-radius:0.2857rem;">
					<div class="ui form">
						<div class="field">
							<h1><img src="<?php echo base_url('assets/images/nascop.jpg');?>" height="80"  alt="" style="z-index: -50;border-radius:0.2857rem;"></h1>
						</div>
						<div class="field">
							<label for="username">Facility Login: </label>
							<div class="ui icon input">								
								<input type="checkbox" ng-model="facility_login">
							</div>
						</div>
						<div ng-show="!facility_login" class="field">							
							<label for="username">Username: </label>
							<div class="ui icon input">
								<input type="text" placeholder="email" name="username" id="username" ng-model="username">
								<i class="user icon"></i>
							</div>
						</div>
						<div ng-show="facility_login" class="field">
							<label for="username">Facility: </label>
							<div class="ui icon input">
								<div class="ui input">
									<ui-select ng-model="selected.facility" theme="selectize" ng-disabled="disabled"  reset-search-input="false" style="min-width: 300px;">
									    <ui-select-match placeholder="Type Facility Name or MFL Code...">{{$select.selected.facility_name}}</ui-select-match>
									    <ui-select-choices repeat="fac in facilities track by $index | limitTo:10" refresh="refreshFacilities($select.search)" refresh-delay="4">
									      	<div ng-bind-html="fac.facility_name | highlight: $select.search"></div>
									      		<small>
													<b>MFL Code</b>: <span ng-bind-html="''+fac.facility_mfl_code | highlight: $select.search"></span><br/>
													email: {{fac.email}}
													phone: <span ng-bind-html="''+fac.phone | highlight: $select.search"></span>
												</small>
									    </ui-select-choices>
									</ui-select>
								</div>
							</div>
						</div>
						<div class="field">
							<label for="password">Password: </label>
							<div class="ui icon input">
								<input type="password" placeholder="Password" name="password" id="password" ng-model="password" ng-keyup="$event.keyCode == 13 && submit()">
								<i class="lock icon"></i>
							</div>
						</div>
						<input type="submit" name="submit" class="ui inverted blue button" ng-click="submit()">
					</div>	
					<div class="ui link list">						
						<a class="item" href="#registration">Register</a>
						<a class="item" href="#forgotPassword">Forgot Password</a>	
					</div>			
				</div>				
			</div>
			<div id = "content">			
				<div ui-view="filter" id="filterNav" class="ui column segment grid filter" ng-cloak=""></div>

				<main ui-view="main" class="ui column  grid " ng-cloak="" style="width:100%" ></main>
			</div>
		</authmain>
	</div>
	<div ui-view="footer" class=" ui column grid full"></div>


	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker-bs3.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/ngprogress/ngProgress.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/fontawesome/css/font-awesome.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/angular-ui-select/dist/select.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/selectize/dist/css/selectize.bootstrap3.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/ngActivityIndicator/css/ngActivityIndicator.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/customized_bootstrap/btn/bootstrap.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/customized_bootstrap/pagination/bs-paginate-only.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/angular-form-for/dist/form-for.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/angular-busy/dist/angular-busy.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/sweetalert/lib/sweet-alert.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/sweetalert/lib/ie9.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/angularjs-toaster/toaster.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/angular-notify/dist/angular-notify.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/bower_components/datatables/media/css/jquery.dataTables.css">

	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/datatables-tabletools/css/dataTables.tableTools.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/datatables-colvis/css/dataTables.colVis.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/datatables-responsive/css/dataTables.responsive.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/datatables-colreorder/css/dataTables.colReorder.css');?>">


	<!-- open scripts -->
	<script type="text/javascript">
		var base_url 		= '<?php echo base_url();?>';
		var api_base_url 	= "<?php echo base_url('api');?>";
	</script>

	<!--JS libraries -->
	<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/semantic/dist/semantic.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular/angular.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/moment/moment.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-route/angular-route.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-ui-router/release/angular-ui-router.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/ngprogress/build/ngprogress.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-ui-select/dist/select.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-sanitize/angular-sanitize.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-daterangepicker/js/angular-daterangepicker.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/moment/moment.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/Chart.js/Chart.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-chart.js/dist/angular-chart.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/highcharts/highcharts-all.js');?>"></script>
	<script src="<?php echo base_url('assets/other/highcharts-themes/dist/highcharts-themes.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/highcharts/modules/drilldown.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/highcharts-ng/dist/highcharts-ng.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/ngActivityIndicator/ngActivityIndicator.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-animate/angular-animate.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-form-for/dist/form-for.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/danialfarid-angular-file-upload/dist/angular-file-upload-shim.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/danialfarid-angular-file-upload/dist/angular-file-upload.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-smart-table/dist/smart-table.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/underscore/underscore-min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-underscore/angular-underscore.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-busy/dist/angular-busy.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/waypoints/lib/jquery.waypoints.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/sweetalert/lib/sweet-alert.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-sweetalert/SweetAlert.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angularjs-toaster/toaster.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-notify/dist/angular-notify.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/restangular/dist/restangular.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-validation/dist/angular-validation.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-validation/dist/angular-validation-rule.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-http-auth/src/http-auth-interceptor.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-cookie/angular-cookie.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/ng-token-auth/dist/ng-token-auth.min.js');?>"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo base_url();?>assets/bower_components/datatables/media/js/jquery.dataTables.js"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-datatables/dist/angular-datatables.min.js');?>"></script>

	<script src="<?php echo base_url('assets/bower_components/datatables-tabletools/js/dataTables.tableTools.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/datatables-colvis/js/dataTables.colVis.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/datatables-responsive/js/dataTables.responsive.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/datatables-colreorder/js/dataTables.colReorder.js');?>"></script>
	
	<script src="<?php echo base_url('assets/bower_components/angular-datatables/dist/plugins/colvis/angular-datatables.colvis.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-datatables/dist/plugins/tabletools/angular-datatables.tabletools.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-datatables/dist/plugins/colreorder/angular-datatables.colreorder.min.js');?>"></script>

	<script src="<?php //echo base_url('assets/bower_components/angular-form-for/dist/form-for.js');?>"></script>
	<script src="<?php //echo base_url('assets/bower_components/angular-form-for/dist/form-for.bootstrap-templates.js');?>"></script>
	

	<!--app -->
	<script src="<?php echo base_url('scripts/app.js');?>"></script>

	
	<!-- config -->

	<script src="<?php echo base_url('scripts/config/notify.js');?>"></script>
	<script src="<?php echo base_url('scripts/config/restangularCFG.js');?>"></script>

	<!-- values -->

	<script src="<?php echo base_url('scripts/values/cgBusyDefaults.js');?>"></script>


	<!--Controllers -->
	<script src="<?php echo base_url('scripts/controllers/dashboardCtrl.js');?>"></script>
	<script src="<?php echo base_url('scripts/controllers/fcdrrCtrl.js');?>"></script>
	<script src="<?php echo base_url('scripts/controllers/fcdrrsCtrl.js');?>"></script>
	<script src="<?php echo base_url('scripts/controllers/filtersCtrl.js');?>"></script>

	<script src="<?php echo base_url('scripts/controllers/dashboard/summaryCtrl.js');?>"></script>
	<script src="<?php echo base_url('scripts/controllers/dashboard/TestsTrendCtrl.js');?>"></script>
	<script src="<?php echo base_url('scripts/controllers/dashboard/device_distributionCtrl.js');?>"></script>

	<script src="<?php echo base_url('scripts/controllers/navbarCtrl.js');?>"></script>

	<script src="<?php echo base_url('scripts/controllers/facilitiesCtrl.js');?>"></script>
	<script src="<?php echo base_url('scripts/controllers/cd4TestsCtrl.js');?>"></script>
	<script src="<?php echo base_url('scripts/controllers/cd4DevicesCtrl.js');?>"></script>
	<script src="<?php echo base_url('scripts/controllers/deviceUploadsCtrl.js');?>"></script>
	<script src="<?php echo base_url('scripts/controllers/limsLoginCtrl.js');?>"></script>
	<script src="<?php echo base_url('scripts/controllers/loginCtrl.js');?>"></script>
	<script src="<?php echo base_url('scripts/controllers/registrationCtrl.js');?>"></script>
	<script src="<?php echo base_url('scripts/controllers/admin/partnersCtrl.js');?>"></script>




	<!--Factories, Services and providers -->

	<script src="<?php echo base_url('scripts/factories/Filters.js');?>"></script>
	<script src="<?php echo base_url('scripts/factories/apiAuth.js');?>"></script>
	<script src="<?php echo base_url('scripts/factories/Commons.js');?>"></script>
	<script src="<?php echo base_url('scripts/factories/API.js');?>"></script>
	<script src="<?php echo base_url('scripts/factories/charts/cd4_tests_table.js');?>"></script>

	<script src="<?php echo base_url('scripts/services/uploadSvc.js');?>"></script>
	
	<!--Chart factories -->
	<script src="<?php echo base_url('scripts/factories/charts/cd4_tests_table.js'); ?>"></script>

	<!-- directives-->

	<script src="<?php echo base_url('scripts/directives/onlyDigits.js');?>"></script>
	<script src="<?php echo base_url('scripts/directives/mAppLoading.js');?>"></script>
	<script src="<?php echo base_url('scripts/directives/authmain.js');?>"></script>

	<script>


    Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.4).get('rgb')] // darken
            ]
        };
    });

    Highcharts.setTheme('base');

	</script>

	



</body>
</html>

<style>
.main-navbar{

	padding-left: 0 !important;
	padding-right: 0 !important;
}

.filter{
	/*padding-bottom: 200px;*/
}


.ui.menu.vertical  .active.item.shadowed{
	box-shadow: 2px 0em 0em inset !important;
}
.ui.menu  .active.item.shadowed{
	box-shadow:  0em 2px 0em inset !important;
}
/*overrides*/
.ui.grid{
	font-size: 1em !important;	
	margin-top: 0rem !important; 
	margin-bottom: 0rem !important; 
	margin-left: 0rem !important; 
	margin-right: 0rem !important; 

}
.ui.grid > .page  {
	padding-left: 0rem !important;
	padding-right: 0rem !important;
}

.chart-wrapper {
	position: relative;
	padding-bottom: 40%;
	margin-left: 5%;
	margin-right: 5%;

	height:100px;
	overflow-y: auto;
}

.chart-inner {
	position: absolute;
	width: 90%; 

	/*height: 90%;*/

}

.ng-hide:not(.ng-hide-animate) {
  /* this is just another form of hiding an element */
  display: none!important;
  position: absolute;
  top: -9999px;
  left: -9999px;
}

.pagination {
    cursor: pointer;
}
.cg-busy-default-wrapper{	
    cursor: no-drop;
}
</style>

