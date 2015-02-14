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

<div class="row" style="border-color: #428bca;">
	<div class="col-md-2" id="leftCol">

		<ul class="nav nav-stacked" id="sidebar">
			<!-- <li ng-show="true" ng-class="getActiveClass('/') || getActiveClass('/summary')"><a href="#summary">Summary</a></li>
			<li ng-class = "getSpecActiveClass('/tests')"  ng-show="visible('tests')"><a href="#{{filters.programs.selected().initials}}/tests">Testing Trends</a></li>
			<li ng-class = "getSpecActiveClass('/tat')"  ng-show="visible('tat')"><a href="#{{filters.programs.selected().initials}}/tat">Turn-Around-Time (TAT)</a></li>
			<li ng-class = "getSpecActiveClass('/facilitiesTests')"  ng-show="visible('facilitiesTests')"><a href="#{{filters.programs.selected().initials}}/facilitiesTests">Facilities and Tests</a></li>
			<li ng-class = "getSpecActiveClass('/labPerformance')"  ng-show="visible('labPerformance')"><a href="#{{filters.programs.selected().initials}}/labPerformance">Lab Performance</a></li>
			<li ng-class = "getSpecActiveClass('/TBCoinf')"  ng-show="visible('TBCoinf')"><a href="#{{filters.programs.selected().initials}}/TBCoinf">TB Co-Infection </a></li>
			<li ng-class = "getSpecActiveClass('/VLSuppression')"  ng-show="visible('VLSuppression')"><a href="#{{filters.programs.selected().initials}}/VLSuppression">Viral Load Suppression Level </a></li>
			<li ng-class = "getSpecActiveClass('/SampleType')"  ng-show="visible('SampleType')"><a href="#{{filters.programs.selected().initials}}/SampleType">Sample Type </a></li>
			 --><li ng-class = "getSpecActiveClass('/BF')"  ng-show="visible('BF')"><a href="#{{filters.programs.selected().initials}}/BF">EID Breast Feeding </a></li>
		</ul>
	</div>
	<div class="col-md-10">
		<div class="" ui-view></div>
	</div>	
</div>


