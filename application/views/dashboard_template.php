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

<body class="" style="width:98%">

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
					Please wait while <big>CD4 LIMS</big> app loads..
				</h1>
				<div class="ui active inline loader"></div>
			</div>

		</div>
		<!-- END: Actual animated container. -->

	</div>
	<!-- END: App-Loading Screen. -->

	<div class="" >
		<div ui-view="navbar" ng-class="'hide'" class="ui inverted fixed menu navbar page grid main-navbar" ng-cloak=""></div>

		<div ui-view="filter" class="ui column segment grid filter" ng-cloak=""></div>

		<main ui-view="main" class="ui column  grid full" ng-cloak=""></main>

	</div>
	<div ui-view="footer"></div>


	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker-bs3.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/ngprogress/ngProgress.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/fontawesome/css/font-awesome.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/angular-ui-select/dist/select.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/selectize/dist/css/selectize.bootstrap3.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/ngActivityIndicator/css/ngActivityIndicator.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/customized_bootstrap/css/bootstrap.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/angular-form-for/dist/form-for.css');?>">


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
	<script src="<?php echo base_url('assets/bower_components/highcharts/highcharts.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/highcharts-ng/dist/highcharts-ng.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/ngActivityIndicator/ngActivityIndicator.min.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-animate/angular-animate.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/angular-form-for/dist/form-for.js');?>"></script>


	<!--app -->
	<script src="<?php echo base_url('scripts/app.js');?>"></script>


	<!--Controllers -->
	<script src="<?php echo base_url('scripts/controllers/dashboardCtrl.js');?>"></script>
	<script src="<?php echo base_url('scripts/controllers/fcdrrCtrl.js');?>"></script>
	<script src="<?php echo base_url('scripts/controllers/filtersCtrl.js');?>"></script>
	<script src="<?php echo base_url('scripts/controllers/dashboardSummaryCtrl.js');?>"></script>
	<script src="<?php echo base_url('scripts/controllers/navbarCtrl.js');?>"></script>


	<!--Factories, Services and providers -->

	<script src="<?php echo base_url('scripts/factories/Filters.js');?>"></script>
	<script src="<?php echo base_url('scripts/factories/Commons.js');?>"></script>

	<!-- directives-->

	<script src="<?php echo base_url('scripts/directives/mAppLoading.js');?>"></script>



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
</style>

