<!DOCTYPE html>
<html ng-app="dashboard">

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
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker-bs3.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/ngprogress/ngProgress.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/fontawesome/css/font-awesome.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/angular-ui-select/dist/select.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/selectize/dist/css/selectize.bootstrap3.css');?>">
	<!-- <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');?>"> -->

</head>

<body>
	<div class="" >
		<div ui-view="navbar" class="ui inverted fixed menu navbar page grid main-navbar"></div>

		<div ui-view="filter" class="ui column segment grid filter"></div>

		<main ui-view="main" class="ui column  grid full"></main>

	</div>
	<div ui-view="footer"></div>
</body>

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


<!--app -->
<script src="<?php echo base_url('scripts/app.js');?>"></script>

<!--Controllers -->
<script src="<?php echo base_url('scripts/controllers/dashboardCtrl.js');?>"></script>

<script src="<?php echo base_url('scripts/controllers/filtersCtrl.js');?>"></script>


<!--Factories, Services and providers -->
<!--
<script src="<?php echo base_url('scripts/factories/Filters.js');?>"></script>
<script src="<?php echo base_url('scripts/factories/Commons.js');?>"></script>
-->
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

