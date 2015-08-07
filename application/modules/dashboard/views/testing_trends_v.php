<div class="row">
	<div class="ui blue segment" id="chart_container" >
		<div class="ui grid">
			<div class="ten wide column">
				<highchart id="testing_trends" config="testing_trends" class="span"></highchart>
			</div>
		  	<div class="four wide column">
		  		<highchart id="yearly_testing_trends" config="yearly_testing_trends" class="span10"></highchart>
		  	</div>
		</div>
		<div style="clear:both"><hr></div>
		<div class="ui grid">
			<div class="ten wide column">
				<h4 style="text-align: center;">CD4 Tests</h4>
				<table class="ui celled table">
					<thead>
						<tr>
							<th></th>
							<th>Total Attempted</th>
							<th>Valid tests</th>
							<th>cd4 Above critical Level
							<br/>
							<br/>
							(500 cells/mm for adults)</th>
							<th>cd4 Below critical Level
							<br/>
							<br/>
							<!-- (25% for peadiatrics) --></th>
							<th>Unsuccessful Tests</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="td in table_data">
							<td>
								<center>
									{{td.title}}
								</center>
							</td>
							<td>
								<center>
									{{td.total}}
								</center>
							</td>
							<td>
								<center>
									{{td.valid}}
								</center>
							</td>
							<td>
								<center>
									{{td.passed}}
								</center>
							</td>
							<td>
								<center>
									{{td.failed}}
								</center>
							</td>
							<td>
								<center>
									{{td.errors}}
								</center>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="four wide column">
				<highchart id="tests_vs_errors_pie" config="tests_vs_errors_pie" class="span10" data-theme='pastel'></highchart>
			</div>
		</div>
	</div>
</div>
<div style="clear:both; height: 20px;"></div>