<style type="text/css">
	#top_chart_container{
		width: 75%;
	}
</style>
<div class="ui segment">
  <h3><center><div class="ui yellow horizontal label big ">View Facility Statistics</div></center></h3>
</div>

<div class="ui segment">
	<h3>{{ facility_detail.facility_name }}</h3>
	<table class="ui yellow table">
		<thead>
		    <tr>
			    <th>MFL Code</th>
			    <th>Email</th>
			    <th>Phone</th>
			    <th>Sub County</th>
			    <th>County</th>
			    <th>Partner</th>
			    <th>Central Site</th>
			    <th>Facility Type</th>
			    <th>Rollout Status ?</th>
		  	</tr>
		</thead>
	  	<tbody>
		    <tr>
		      	<td>{{ facility_detail.facility_mfl_code }}</td>
		      	<td>{{ facility_detail.facility_email }}</td>
		      	<td>{{ facility_detail.facility_phone }}</td>
		      	<td>{{ facility_detail.sub_county_name }}</td>
		      	<td>{{ facility_detail.county_name }}</td>
		      	<td>{{ facility_detail.partner_name }}</td>
		      	<td>{{ facility_detail.central_site_name }}</td>
		      	<td>{{ facility_detail.affiliation }}</td>
		      	<td>{{ facility_detail.status }}</td>
		    </tr>
	  	</tbody>
	</table>
	
	<table class="ui yellow table">
		<thead>
		    <tr>
			    <th>Device Type</th>
			    <th>Device Serial Number</th>
			    <th>Roll Out Status</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="facility_devs in facility_detail.devices">
				<td>{{ facility_devs.device_name }}</td>
				<td>{{ facility_devs.serial_number }}</td>
				<td ng-if="facility_devs.facility_rollout_status == 1">{{ 'Yes' }}</td>
				<td ng-if="facility_devs.facility_rollout_status == 0">{{ 'No' }}</td>
			</tr>
		</tbody>
	</table>

	<h4 class="ui horizontal divider header"><i class="fa fa-tint fa-sm icon red"></i> CD4 Tests</h4>
			<table style = "vertical-align:center;width:100%;clear:both;"  class="ui yellow table">
				<thead class="even" style="background:#f0f0f0" >
					<tr style = "border: 1px solid #DDD;" >
						<th></th>
						<th class="center aligned">Total Attempted</th>
						<th class="center aligned">Valid tests</th>
						<th class="center aligned">cd4 Above critical Level
						<br/>
						<br/>
						(350 cells/mm for adults)</th>
						<th class="center aligned">cd4 Below critical Level
						<br/>
						<br/>
						(25% for peadiatrics)</th>
						<th class="center aligned">Unsuccessful Tests</th>
					</tr>
				</thead>
				<tbody>
					<tr style = "border: 1px solid #DDD;" ng-repeat="t_data in table_data">
						<td style="background-color: #CCCCCC;"  >
							<center>
								{{t_data.title}}
							</center>
						</td>
						<td style="background-color: #F6F6F6;;" >
							<center>
								{{t_data.total}}
							</center>
						</td>
						<td style="background-color: #F6F6F6;;" >
							<center>
								{{t_data.valid}}
							</center>
						</td>
						<td style="background-color: #F6F6F6;;" >
							<center>
								{{t_data.passed}}
							</center>
						</td>
						<td style="background-color: #F6F6F6;;" >
							<center>
								{{t_data.failed}}
							</center>
						</td>
						<td style="background-color: #F6F6F6;;" >
							<center>
								{{t_data.errors}}
							</center>
						</td>
					</tr>
				</tbody>
			</table>
			<h4 class="ui horizontal divider header"><i class="bar chart icon"></i> Graph Visualizations </h4>
			
			<div class="ui grid">
				<div class="center aligned row" id='top_chart_container'>
					<highchart id="testing_trends" config="testing_trends" class="span"></highchart>
				</div>
				<div class="row" id="middle_chart_container">
					<div id="middle_chart">
						<highchart id="yearly_testing_trends" config="yearly_testing_trends" class="span10" style="float:left; width:40%"></highchart>
					</div>
					<div id="middle_chart">
						<highchart id="tests_vs_errors_pie" config="tests_vs_errors_pie" class="span10" style="float:right; width:45%" data-theme='pastel'></highchart>
					</div>
				</div>
			</div>
	<div style="height:150px"></div>
</div>