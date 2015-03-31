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
<h1>This should appear {{test_table.myname}} {{mydate}}</h1>
<div class="row">
	<div class="ui blue segment" id="chart_container" >
		<div id='top_chart_container'>
			<highchart id="testing_trends" config="testing_trends" width='' class="span"></highchart>
		</div>
		<div id="middle_chart_container">
			<div id="middle_chart">
				<highchart id="yearly_testing_trends" config="yearly_testing_trends" class="span10" style="float:left; width:40%"></highchart>
			</div>
			<div id="middle_chart">
				<highchart id="tests_vs_errors_pie" config="tests_vs_errors_pie" class="span10" style="float:right; width:40%"></highchart>
			</div>
		</div>

		<div id='table_container'>
			<hr/>
			<table style = "border: 1px solid #DDD;vertical-align:center;width:100%;clear:both;" >
				<thead class="even" style="background:#f0f0f0" >
					<tr style = "border: 1px solid #DDD;" >
						<td></td>
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
					<tr style = "border: 1px solid #DDD;" >
						<td style="background-color: #CCCCCC;"  >
						<center>
							Tests
						</center></td>
						<td style="background-color: #F6F6F6;;" >
						<center>
							46957
						</center></td>
						<td style="background-color: #F6F6F6;;" >
						<center>
							44248
						</center></td>
						<td style="background-color: #F6F6F6;;" >
						<center>
							24751
						</center></td>
						<td style="background-color: #F6F6F6;;" >
						<center>
							19497
						</center></td>
						<td style="background-color: #F6F6F6;;" >
						<center>
							2709
						</center></td>
					</tr>
					<tr style = "border: 1px solid #DDD;" >
						<td style="background-color: #CCCCCC;"  >
						<center>
							Percentages
						</center></td>
						<td style="background-color: #F6F6F6;;" ><center></center></td>
						<td style="background-color: #F6F6F6;;" >
						<center>
							94.23%
						</center></td>
						<td style="background-color: #F6F6F6;;" >
						<center>
							52.71%
						</center></td>
						<td style="background-color: #F6F6F6;;" >
						<center>
							41.52%
						</center></td>
						<td style="background-color: #F6F6F6;;" >
						<center>
							5.77%
						</center></td>
					</tr>
					<tr style = "border: 1px solid #DDD;" >
						<td style="background-color: #CCCCCC;"  ></center></td>
						<td style="background-color: #F6F6F6;;" ></center></td>
						<td style="background-color: #F6F6F6;;" ></center></td>
						<td style="background-color: #F6F6F6;;" ></center></td>
						<td style="background-color: #F6F6F6;;" ></center></td>
						<td style="background-color: #F6F6F6;;" ></center></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>