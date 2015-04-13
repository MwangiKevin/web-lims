<div class="row">
	<div class="ui blue segment" id="chart_container" >
		<div id='top_chart_container'>
			<highchart id="device_distribution_stack" config="device_distribution_stack" class="span"></highchart>
		</div>
		<!-- CD4 Equipment -->
		<div id="middle_chart_container">
			<div id="middle_chart">
				<highchart id="cd4_equipment_pie" config="cd4_equipment_pie" class="span10" style="float:left; width:40%"></highchart>
			</div>
			<div id="middle_chart">
				<highchart id="cd4_equipment_table" config="cd4_equipment_table" class="span10" style="float:right; width:45%"></highchart>
			</div>
		</div>
		<!-- Equipment and Tests -->
		<div id="middle_chart_container">
			<div id="middle_chart">
				<highchart id="equipment_tests_pie" config="equipment_tests_pie" class="span10" style="float:left; width:40%"></highchart>
			</div>
			<div id="middle_chart">
				<highchart id="equipment_tests_table" config="equipment_tests_table" class="span10" style="float:right; width:45%"></highchart>
			</div>
		</div>
		<!-- Expected Reporting Devices -->
		<div id="bottom_chart_container">
			<highchart id="expected_reporting_devices" config="expected_reporting_devices" class="span"></highchart>
		</div>
	</div>
</div>