<div id="row">
	<div class="ui blue segment" id="chart_container" >
		<div class="ui grid">
			<div class="ten wide column">
				<highchart id="device_distribution_stack" config="device_distribution_stack" class="span"></highchart>
			</div>
			<div class="four wide column">
		  		<highchart id="expected_reporting_devices" config="expected_reporting_devices" class="span"></highchart>
		  	</div>
		</div>
		<hr />
		<div class="ui grid">
			<div class="ten wide column">
				<h4>CD4 Equipment</h4>
				{{t_data}}
				<table class="ui celled table">
					<thead>
						<tr>
							<th></th>
							<th>Device</th>
		                    <th>Total</th>
		                    <th>Functional</th>
		                    <th>Broken down</th>
		                    <th>Obsolete</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td> {{table_data[0].equipment}} </td>
							<td> {{table_data[0].total}} </td>
							<td> {{table_data[0].functional}} </td>
							<td> {{table_data[0].broken_down}} </td>
							<td> {{table_data[0].obsolete}} </td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="four wide column">
				<highchart id="cd4_equipment_pie" config="cd4_equipment_pie" class="span10"></highchart>
		  	</div>
		</div>
		
		<div class="ui grid">
			<div class="ten wide column">
				<h4># of Tests Per Equipment</h4>
				<table class="ui celled table">
					<thead>
						<tr>
							<th>Device</th>
	                    	<th>Total Tests</th>
	                    	<th>Functional</th>
	                    	<th>Broken down</th>
	                    	<th>Obsolete</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td> {{equipment_tests_data[0].equipment}} </td>
							<td> {{equipment_tests_data[0].count}} </td>
							<td> {{equipment_tests_data[0].valid}} </td>
							<td> {{equipment_tests_data[0].errors}} </td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="four wide column">
				<highchart id="equipment_tests_pie" config="equipment_tests_pie" class="span10"></highchart>
			</div>				
		</div>
</div>
<div style="clear:both; height: 10px;"></div>