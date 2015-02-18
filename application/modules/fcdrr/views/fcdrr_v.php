<div style="">
	<div ui-view="filter" class="ui column segment grid" style="">
		<h3><center>FACILITY CONSUMPTION DATA REPORT & REQUEST(F-CDRR) FOR ART LABORATORY MONITORING REAGENTS</center></h3>
		<div class="ui horizontal divider">Start</div>
		<div class="three wide column">Facility: </div>
		<div class="three wide column">Facility MFL: </div>
		<div class="three wide column">Sub County: </div>
		<div class="three wide column">County: </div>
		<div class="three wide column">Affliation: </div>
		<hr />
		<div class="three wide column">REPORT OF THE PERIOD</div>
		<div class="four wide column">
			<select  class="ui dropdown" name="report_year" onchange="" required>
				<option value="">* Select Year *</option>
				<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>                 					
			</select>
		</div>
		<div class="three wide column">
			<select class="ui dropdown" name="report_month">
				<option value="">* Select Month *</option>
				<option value="1">January</option>
				<option value="2">February</option>
				<option value="3">March</option>
				<option value="4">April</option>
				<option value="5">May</option>
				<option value="6">June</option>
				<option value="7">July</option>
				<option value="8">August</option>
				<option value="9">September</option>
				<option value="10">October</option>
				<option value="11">November</option>
				<option value="12">December</option>                 					
			</select>
		</div>
		<hr />
		<div class="three wide column">State the number of CD4 Tests conducted:-</div>
		<div class="three wide column">
			Calibur<div class="ui input"><input placeholder="" type="text" /></div>
			<div class="ui input"><input placeholder="" type="text" /></div>
		</div>
		<div class="three wide column">
			Count<br /><div class="ui input"><input placeholder="Paed Tests" type="text" /></div>
			<div class="ui input"><input placeholder="Adult Tests" type="text" /></div>
		</div>
		<div class="three wide column">
			Cyflow Partec<div class="ui input"><input placeholder="Paed Tests" type="text" /></div>
			<div class="ui input"><input placeholder="Adult Tests" type="text" /></div>
		</div>
		<div class="three wide column">
			Alere Pima<div class="ui input"><input placeholder="" type="text" /></div>
		</div>
		<hr />
		<div class="three wide column">TOTAL NUMBER OF CD4 TESTS DONE DURING THE MONTH(REPORTING PERIOD):</div>
		<div class="three wide column">
			<div class="ui input"><input value="" type="text" readonly="readonly" /></div>
		</div>
		<hr />
		<table  class="ui celled striped structured table">
			<thead>
				<tr>
					<th rowspan="2">Commodity</th>
					<th rowspan="2">Unit</th>
					<th rowspan="2">Beginning Balance</th>
					<th rowspan="2">Quantity Received <br/>From Warehouse(e.g Kemsa)</th>
					<th rowspan="2"><center>Quantity Used</center></th>
					<th rowspan="2"><center>Losses / Wastages &nbsp;</center></th>
					<th colspan="2">Adjustments<br/><i>Indicate if (+) or (-)</i></th>
					<th rowspan="2"><center>End Of Month<br/>Physical Count</center></th>
					<th rowspan="2"><center>Quantity<br />Requested</center></th>
				</tr>
				<tr>
					<th>Positive</th>
					<th>Negative</th>    
				</tr>
			</thead>
			<tbody>
				<tr><td rowspan="1" colspan="10" style="background:#eeeeee;">FACS Calibur reagents and consumables</td></tr>	
				<tr ng-repeat="user in users.facs_calibur">
					<td>{{user.name}}</td>
					<td>{{user.unit}}</td>
					<td><div class="ui input"><input name="" id="" style="" size="" type="text" class="form-control" required/></div></td>
					<td><div class="ui input"><input name="" id="" style="" size="" type="text" class="form-control" required/></div></td>
					<td><div class="ui input"><input name="" id="" style="" size="" type="text" class="form-control" required/></div></td>
					<td><div class="ui input"><input name="" id="" style="" size="" type="text" class="form-control" required/></div></td>
					<td><div class="ui input"><input name="" id="" style="" size="" type="text" class="form-control" required/></div></td>
					<td><div class="ui input"><input name="" id="" style="" size="" type="text" class="form-control" required/></div></td>
					<td><div class="ui input"><input name="" id="" style="" size="" type="text" class="form-control" value="" required readonly/></div></td>
					<td><div class="ui input"><input name="" id="" style="" size="" type="text" class="form-control" required/></td>
				</tr>
			</tbody>
		</table>
		<hr />
		<div class="four wide column">	
			<div class="ui form">
				<div class="field">
					<label>FCDRR Comments</label>
					<textarea width="100"></textarea>
				</div>
			</div>
		</div>
		<div class="ui horizontal divider">END</div>
		<div class="four wide column">
			<div class="ui primary button">
				Submit Commodity Report	
			</div>
		</div>
		<div class="four wide column">
			<div class="ui reset button">
				Reset Form
			</div>
		</div>
		<div class="four wide column">
			<div class="ui button">
				Print	
			</div>
		</div>
	</div>
</div>

