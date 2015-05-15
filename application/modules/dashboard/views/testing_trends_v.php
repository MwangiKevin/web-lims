<style>
	#chart_container{
		width:100%;
		padding: 5%;
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
		width: 75%;
	}
</style>
<div class="row">
	<div class="ui blue segment" id="chart_container" >
		<div id='top_chart_container'>
			<highchart id="testing_trends" config="testing_trends" class="span"></highchart>
		</div>
		<div id="middle_chart_container">
			<div id="middle_chart">
				<highchart id="yearly_testing_trends" config="yearly_testing_trends" class="span10" style="float:left; width:40%"></highchart>
			</div>
			<div id="middle_chart">
				<highchart id="tests_vs_errors_pie" config="tests_vs_errors_pie" class="span10" style="float:right; width:45%"></highchart>
			</div>
		</div>
		<div id='table_container'>
			<hr/>
			<h4 style="text-align: center;">CD4 Tests for the Year 2013</h4>
			<table style = "border: 1px solid #DDD;vertical-align:center;width:100%;clear:both;" >
				<thead class="even" style="background:#f0f0f0" >
					<tr style = "border: 1px solid #DDD;" >
						<th></th>
						<th>Total Attempted</th>
						<th>Valid tests</th>
						<th>cd4 Above critical Level
						<br/>
						<br/>
						(350 cells/mm for adults)</th>
						<th>cd4 Below critical Level
						<br/>
						<br/>
						(25% for peadiatrics)</th>
						<th>Unsuccessful Tests</th>
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
								{{t_data.vaild}}
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
		</div>
	</div>
</div>