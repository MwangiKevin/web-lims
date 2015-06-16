<style>
	#chart_container{
		width:100%;
		padding: 5%;
		border:solid;
	}
	#middle_chart{
		width:100%;
		
	}
	#table_container{
		padding:5%;
		clear:both;
	}
	#middle_chart_container{
		width:75%;
	}
	#top_chart_container{
		width: 100%;
		overflow-y:auto;
		overflow-x:auto;
	}
	#bottom_chart_container{
		width: 75%;
	}
</style>

<div id="row">
	<div class="ui blue segment" id="chart_container" >
		<div id='top_chart_container'>
			<highchart id="device_distribution_stack" config="device_distribution_stack" class="span"></highchart>
		</div>
		<hr />
		<div style="float:left; width: 30%;">
			<highchart id="cd4_equipment_pie" config="cd4_equipment_pie" class="span10"></highchart>
		</div>
		<div style="float:right; width: 50%;">
			<h4>CD4 Equipment</h4>
			<table style = "border: 1px solid #DDD;" class="span10">
	            <thead class="even" style="background:#f0f0f0" >
	                <tr>
	                    <td>Device</td>
	                    <td>Total</td>
	                    <td>Functional</td>
	                    <td>Broken down</td>
	                    <td>Obsolete</td>
	                </tr>
	            </thead>
	            <tbody>
		            <tr style = "border: 1px solid #DDD;" ng-repeat="t_data in table_data" >
		                <td style="background-color: #CCCCCC;"  ><center><a href="">{{t_data.equipment}}</a></center></td>
		                <td style="background-color: #F6F6F6;;" ><center>{{t_data.total}}</center></td>
		                <td style="background-color: #F6F6F6;;" ><center>{{t_data.functional}}</center></td>
		                <td style="background-color: #F6F6F6;;" ><center>{{t_data.broken_down}}</center></td>
		                <td style="background-color: #F6F6F6;;" ><center>{{t_data.obsolete}}</center></td>
		            </tr>
	            </tbody>
	       </table>
		</div>
		<div style="clear:both;">
			<hr />
		</div>
		<div style="float:left; width: 30%;">
			<highchart id="equipment_tests_pie" config="equipment_tests_pie" class="span10"></highchart>
		</div>
		<div style="float:right; width: 50%;">
			<h4>CD4 Tests Equipment</h4>
			<table style = "border: 1px solid #DDD;" class="span10">
	            <thead class="even" style="background:#f0f0f0" >
	                <tr>
	                    <td>Device</td>
	                    <td>Total Tests</td>
	                    <td>Successful Tests</td>
	                    <td>Errors</td>
	                </tr>
	            </thead>
	            <tbody>
		            <tr style = "border: 1px solid #DDD;" ng-repeat="t_data in equipment_tests_data">
		                <td style="background-color: #CCCCCC;"  ><center><a href="">{{t_data.name}}</a></center></td>
		                <td style="background-color: #F6F6F6;;" ><center>{{t_data.count}}</center></td>
		                <td style="background-color: #F6F6F6;;" ><center>{{t_data.valid}}</center></td>
		                <td style="background-color: #F6F6F6;;" ><center>{{t_data.errors}}</center></td>
		            </tr>
	            </tbody>
	        </table>
		</div>
		<div style="clear:both;">
			<hr />
		</div>
		<!-- Expected Reporting Devices -->
		<div id="bottom_chart_container">
			<highchart id="expected_reporting_devices" config="expected_reporting_devices" class="span"></highchart>
		</div>
		
</div>