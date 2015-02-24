<style>


@media (min-width: 300px) {
	#sidebar.affix-top {
		position: static;
		margin-top:30px;
		width:228px;
	}

	#sidebar.affix {
		position: fixed;
		top:70px;
		width:228px;
	}
}

#sidebar li.active {
	border:0 #eee solid;
	border-right-width: 4px;
	border-right-color: #428bca;
}


</style>
<!-- <div class="ui thin vertical inverted labeled icon left overlay sidebar menu" >abc</div> -->
<div class="ui page stackable grid" style="padding-top:10px;">
	<div class="three wide column" style="margin:0px;padding:0px;">
		<div class="ui black medium launch right attached button" style="">
			<a ng-click="commons.toggleMenu()">
				<i class="icon list layout right"></i>
				<span class="text right" style="display:none;">Menu</span>
			</a>
		</div>  
	</div>  

	<div class="nine wide column" style="margin:0px;padding:0px;">  
		<div class="ui grid right " style="">
			<div class="ui segment">
				<div class="ui large breadcrumb">
					<a class="section">Home</a>
					<i class="right chevron icon divider"></i>
					<a class="section">Dashboard</a>
					<i class="right chevron icon divider"></i>
					<div class="active section">Summary</div>
				</div>
			</div>  
		</div>
	</div>

	<div style="margin:0px;padding:0px;" class="three wide column">
		<h1 style="float:right;margin-bottom: 0px;margin-top: 0px;" class="ui inverted">{{commons.getTitle()}}</h1>
	</div>
</div>
<script>
$(".launch.button").mouseenter(function(){
	$(this).stop().animate({width: '100px'}, 300, 
		function(){$(this).find('.text').show();});
}).mouseleave(function (event){
	$(this).find('.text').hide();
	$(this).stop().animate({width: '70px'}, 300);
});
// $(".ui.overlay.sidebar").sidebar({overlay: true})
// .sidebar('attach events','.ui.launch.button');
</script>


<div class="ui page site stackable grid" style="padding-top:20px">
	<div class="three wide column" ng-show="commons.getMenuShowStatus()" style="margin:0px;padding:0px;">
		<div class="ui vertical inverted  menu pointing left uncover visible" id="toc">
			<a class="item" ng-class="getActiveSubmenuLV1('summary')" href="#summary">
				<b>Summary</b>
			</a>
			<a class="item" href="#testingTrends" ng-class="getActiveSubmenuLV1('testingTrends')">
				<b>Testing Trends</b><i class="fa fa-line-chart " style="float:right"></i>
			</a>
			<a class="item" href="#deviceDistribution" ng-class="getActiveSubmenuLV1('deviceDistribution')">
				<b>Device Distribution</b><i class="fa fa-medkit " style="float:right"></i>
			</a>
			<a class="item" href="#map" ng-class="getActiveSubmenuLV1('map')">
				<i class="map icon"></i> <b>Map</b>
			</a>
			<a class="item" href="#fcdrrReporting" ng-class="getActiveSubmenuLV1('fcdrrReporting')">
				<b>FDRR Reporting </b><i class="fa fa-bar-chart " style="float:right"></i>
			</a>

			<div class="item" ng-class="getActiveSubmenuLV1('pocCD4')">
				<div class="ui small active  inverted header">POC CD4</div>
				<div class="menu">
					<a class="item" href="" ng-class="getActiveSubmenuLV2('pocReportingRates')">
						Device reporting rates
					</a>
					<a class="item" href="" ng-class="getActiveSubmenuLV2('pocSuppression')">
						CD4 Suppression Level
					</a>
				</div>
			</div>
			<div class="item" ng-class="getActiveSubmenuLV1('conventionalCD4')">
				<div class="ui small active  inverted header">Conventional CD4</div>
				<div class="menu">
					<a class="item" href="" ng-class="getActiveSubmenuLV2('convReportingRates')">
						Device reporting rates
					</a>
					<a class="item" href="" ng-class="getActiveSubmenuLV2('convSuppression')">
						CD4 Suppression Level
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="twelve wide " ng-class="commons.getDashboardAreaClass()" style="margin:0px;padding:0px;">
		<div ui-view class=""></div>
	</div>
</div>

<style>


.opensleft{
	top: 123.5px; 
	right: 209.875px; 
	left: auto; 
	display: none;
}
.fullpage{
	width: 100% !important;
}
.ui.vertical.menu {
	width: 90% !important;
}

</style>



