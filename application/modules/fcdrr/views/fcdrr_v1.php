<div>
	<?php
		echo form_open('fcdrr/submit',"id='commodity' onsubmit='return doOnSubmit()'");
	?>
	<h2 class= "ui header"style="text-align:center; font-size: 20px; font-family: tahoma;font-style: normal;font-variant: normal;font-weight: normal;">FACILITY CONSUMPTION DATA REPORT & REQUEST FORM(F-CDRR) FOR ART LABORATORY MONITORING REAGENTS</h2>
	
	<ol class="breadcrumb">
		<li><a href="#">Home</a></li>
		<li class="active"><a href="#">FCDRR</a></li>
	</ol>
	<h1 class="lighter">
		<i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer blue"></i>
		<a href="#" data-toggle="modal" class="pink"> Fill The Form and Click Submit </a>
	</h1>
	<div class="ui horizontal divider">Start</div>
	<div class="row">
		<div class="col-md-3">
			<div class="input-group my-input-group   ">
				<span class="input-group-addon my-input-group-caption">
					Facility
				</span>
				<input readonly="" name="facility" id="facility" class="form-control" style="" type="text" value="<?php //echo $this->session->userdata('facility'); ?>">
			</div>
		</div>
		<div class="col-md-3">
			<div class="input-group my-input-group   ">
				<span class="input-group-addon my-input-group-caption">
					Sub-County
				</span>
				<input readonly="" name="sub_county" id="sub_county" class="form-control" style="" type="text" value="<?php //echo $this->session->userdata('sub_county'); ?>">
			</div>
		</div>
		<div class="col-md-3">
			<div class="input-group my-input-group   ">
				<span class="input-group-addon my-input-group-caption">
					County
				</span>
				<input readonly="" name="county" id="county" class="form-control" style="" type="text" value="<?php //echo $this->session->userdata('county'); ?>">
			</div>
		</div>
		<div class="col-md-3">
			<div class="input-group my-input-group  ">
				<span class="input-group-addon my-input-group-caption">
					Facility MFL Code
				</span>
				<input readonly="" name="mflcode" id="mflcode" class="form-control" style="" type="text" value="<?php //echo $this->session->userdata('mfl_code'); ?>">
			</div>
		</div>
	</div>
	
	<div class="row" style="margin-top:20px;">
		<div class="col-md-3">Report for The Period</div>
		<div class="col-md-3">
			<select  class="textfield form-control" style='border-radius:0px 5px 5px 0px;' name="report_year" onchange="" required>
               	<option value="">* Select Year *</option>
                <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>                 					
            </select>
		</div>
		<div class="col-md-3">
			<select class="textfield form-control" style='border-radius:0px 5px 5px 0px;' name="report_month">
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
		<!-- <div class="col-md-3">
			<div class="input-group my-input-group  ">				
				<input readonly="" name="affiliation" id="affiliation" class="form-control" type="text" style="width:19em;-webkit-box-sizing: border-box;  -moz-box-sizing: border-box;    box-sizing: border-box; ">
			</div>
		</div> -->
	</div>
	
	<div class="row" style="margin-top:20px;">
		<div class="col-md-3">State the number of CD4 Tests conducted</div>
		<div class="col-md-3">			
			<div class="input-group my-input-group">
				<span class="input-group-addon my-input-group-caption">
					Calibur
				</span>
				<input name="calibur_pead" id="calibur_peads" class="form-control" style="" type="text" >
				<input name="calibur_adult" id="calibur_adults" class="form-control" style="" type="text" >
			</div>
		</div>
		<div class="col-md-3">		
			<div class="input-group my-input-group   ">
				<span class="input-group-addon my-input-group-caption">
					Count
				</span>
				<input name="count_pead" id="count_peads" class="form-control" placeholder="Pead Tests" type="text" required>
				<input name="count_adult" id="count_adults" class="form-control" placeholder="Adult Tests" type="text" required>
			</div>
			
		</div>
		<div class="col-md-3">		
			<div class="input-group my-input-group">
				<span class="input-group-addon my-input-group-caption">
					Cyflow Partec
				</span>
				<input name="cyfllow_pead" id="cyfllow_peads" class="form-control" placeholder="Pead Tests" type="text" required>
				<input name="cyfllow_adult" id="cyfllow_adults" class="form-control" placeholder="Adult Tests" type="text" required>
			</div>
		</div> <br />
		<div class="col-md-3">Alere PIMA</div>
		<div class="col-md-3">		
			<div class="input-group my-input-group">
				<input name="alere" id="aleres" class="form-control" style="" type="text" readonly value="0" required>
			</div>
		</div><br />
	</div>
	<div class="row"><hr /></div>
	<div class="row">
		<div class="col-md-3">CD4 TESTS DONE IN REPORTING PERIOD</div>
		<div class="col-md-3">
			<div class="input-group my-input-group">
				<span class="input-group-addon my-input-group-caption">
					TOTAL NUMBER
				</span>
				<input name="total_tests_done" id="total_tests" class="form-control" style="min-width:200px;" type="text" readonly required>
			</div>
		</div>
	</div>

	<div class="row" style="margin-top:20px;">
		<div class="col-md-12">
			<table width="" id="commodities-heading" style="font-size:12px;" >
				<thead>
					<tr>
						<td rowspan="2" style="border:1px solid black !important; background:#eeeeee;" ><b><center>Commodity Name</center></b></td>
						<td rowspan="2" style="border:1px solid black !important; background:#eeeeee;"><b><center>Unit</center></b></td>
						<td rowspan="2" style="border:1px solid black !important; background:#eeeeee;"><b><center>Beginning<br />Balance</center></b></td>
						<td rowspan="2" style="border:1px solid black !important; background:#eeeeee;"><b>Quantity Recevied This Month From Central<br/> WAREHOUSE (e.g. KEMSA)</b></td>             
						<td rowspan="2" style="border:1px solid black !important; background:#eeeeee;"><b><center>Quantity Used</center></b></td>
						<td rowspan="2" style="border:1px solid black !important; background:#eeeeee;"><b><center>Losses / Wastages &nbsp;</center></b></td>
						<td colspan="2" style="border:1px solid black !important; background:#eeeeee;"><b>Adjustments<br/><i>Indicate if (+) or (-)</i></b></td>
						<td rowspan="2" style="border:1px solid black !important; background:#eeeeee;"><b><center>End Of Month<br/>Physical Count</center></b></td>
						<td rowspan="2" style="border:1px solid black !important; background:#eeeeee;"><b><center>Quantity<br />Requested</center></b></td>
					</tr>
					<tr>
						<!-- <td style="border:1px solid black !important">Quantity</td>
						<td style="border:1px solid black !important">Lot No.</td> -->
						<td style="border:1px solid black !important;background:#eeeeee;">Positive</td>
						<td style="border:1px solid black !important;background:#eeeeee;">Negative</td>    
					</tr>

					<tr>
					</tr>
				</thead>	    
				<tbody>  
					<tr><td rowspan="1" colspan="10" style="border:1px solid black !important;background:#eeeeee;">FACS Calibur reagents and consumables</td></tr>
						<?php foreach($facs_calibur as $facs_calibur_commodity): ?>
						<tr>
							<td><?php echo $facs_calibur_commodity['name'] ?></td>
							<td><center><?php echo $facs_calibur_commodity['unit']; ?></center></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
							<td><center><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></center></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
						</tr>
						<?php endforeach; ?>
					<tr><td rowspan="1" colspan="10" style="border:1px solid black !important;background:#eeeeee;">FACS Count Reagents</td></tr>
						<?php foreach($facs_count as $facs_count_commodity): ?>
						<tr>
							<td><?php echo $facs_count_commodity['name'] ?></td>
							<td><center><?php echo $facs_count_commodity['unit'] ?></center></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
							<td><center><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></center></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
						</tr>
						<?php endforeach; ?>
					<tr><td rowspan="1" colspan="10" style="border:1px solid black !important;background:#eeeeee;">Cyflow Partec reagents</td></tr>
						<?php foreach($cyflow_partec as $cyflow_commodity): ?>
						<tr>
							<td><?php echo $cyflow_commodity['name']; ?></td>
							<td><center><?php echo $cyflow_commodity['unit']; ?></center></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
							<td><center><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></center></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" required/></td>
						</tr>
						<?php endforeach; ?>
					<tr><td rowspan="1" colspan="10" style="border:1px solid black !important;background:#eeeeee;">Point of Care CD4 reagents (e.g. PIMA, etc)</td></tr>
						<?php foreach($poc_commodities as $poc): ?>
						<tr>
							<td><?php echo $poc['name']; ?></td>
							<td><center><?php echo $poc['unit']; ?></center></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" /></td>
							<td><center><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" /></center></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" /></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" /></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" /></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" /></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" /></td>
							<td><input name="" id="" style="width:100px;" size="5" type="text" class="form-control" /></td>
						</tr>
						<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="row" style="margin-top:20px;">
		<div class="col-md-12">
			<div class="input-group my-input-group  ">
				<span class="input-group-addon my-input-group-caption">
					Comments
				</span>
				<textarea class="form-control" placeholder="FCDRR Comments" name="comments" id="comments" cols="150" style="width: 99%;">
				</textarea>
			</div>
		</div>


		<!-- div class="col-md-3">
			Order for extra LMIS tools:-
				<div class="input-group my-input-group   ">
					<span class="input-group-addon my-input-group-caption">
						(1) Daily Activity Register for Laboratory Reagents and Consumables (MoH 642):
					</span>
					<input name="lab_reagents_consume" id="lab_reagents_consume" class="form-control" style="width:200px;" type="text" value="">
				</div>
				<div class="input-group my-input-group   ">
					<span class="input-group-addon my-input-group-caption">
						(2) F-CDRR for Lab Monitoring Reagents (MoH 643B):
					</span>
					<input name="monitoring_reagents" id="monitoring_reagents" class="form-control" style="width:365px;" type="text" value="">
				</div>
		</div> -->

		</div>
	
	<div class="ui horizontal divider">END</div>

	<div class="row" style="margin-top:20px;">
		<div class="col-md-12">
			<input type="submit" name="submit" value="Submit Commodity Report" class="button" />
			<input type="hidden" value="true" name="exists" id="exists" />
			<input type="hidden" value="true" name="repeat" id="repeat" /> 
			<input type="button" value="Reset" class="button" onclick="clearTempData()"/>
			<input type="button" onclick="printCommodity()" name="print" value="Print" class="button"  />
		</div>
	</div>

	<div class="ui horizontal divider"></div>

	<?php echo form_close();?>
</div>
<script type="text/javascript">
    	$(function() {
			$('#start_date').datepicker({dateFormat: 'dd/mm/yyyy'});
			$('#end_date').datepicker({dateFormat: 'dd/mm/yyyy'});
		});
</script>