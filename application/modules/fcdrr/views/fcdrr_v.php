<div style="margin-left:10px">
	<div ui-view="filter" class="ui column segment grid" id="viewport">
		<h3><center>FACILITY CONSUMPTION DATA REPORT & REQUEST(F-CDRR) FOR ART LABORATORY MONITORING REAGENTS</center></h3>
		<form>
		<div class="ui horizontal divider">Start</div>
		<div class="ui stackable grid">
			<div class="three wide column"><b>Facility:</b><div ng-model="fdcrr.head_info.facility"><center>A.I.C Kijabe Naivasha Medical Centre</center></div></div>
			<div class="three wide column"><b ng-model="fdcrr.head_info.mfl">Facility MFL:</b> 15282</div>
			<div class="three wide column"><b>Sub County:</b> Naivasha</div>
			<div class="three wide column"><b>County:</b> Nakuru</div>
			<div class="three wide column"><b>Affliation:</b> CHAK</div>
		</div>
		<hr />
		<div class="ui stackable grid">
			<div class="three wide column">REPORT OF THE PERIOD</div>
			<div class="three wide column">
				<select  class="ui dropdown" name="report_year" onchange="" required ng-model="fdcrr.head_info.report_year">
					<option value="">* Select Year *</option>
					<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>                 					
				</select>
			</div>
			<div class="three wide column">
				<select class="ui dropdown" name="report_month" ng-model="fdcrr.head_info.report_month">
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
		</div>
		<hr />
		<div class="ui stackable grid">
			<div class="three wide column">State the number of CD4 Tests conducted:-</div>
			<div class="three wide column">
				<div class="ui labeled input">
					<div class="ui label">
						Facs </br>Calibur:
					</div>
					<input placeholder="Paed Tests" type="text" ng-model="fcdrr.devicetests.facs_calibur.paed_tests" />
					<input placeholder="Adult Tests" type="text" ng-model="fcdrr.devicetests.facs_calibur.adult_tests" />
				</div>
			</div>
			<div class="three wide column">			
				<div class="ui labeled input">
					<div class="ui label">
						Facs </br>Count:
					</div>
					<input placeholder="Paed Tests" type="text" ng-model="fcdrr.devicetests.facs_count.paed_tests" />
					<input placeholder="Adult Tests" type="text" ng-model="fcdrr.devicetests.facs_count.adult_tests" />
				</div>
			</div>
			<div class="three wide column">			
				<div class="ui labeled input">
					<div class="ui label">
						Cyflow </br>Partec:
					</div>
					<input placeholder="Paed Tests" type="text" ng-model="fcdrr.devicetests.cyflow.paed_tests" />
					<input placeholder="Adult Tests" type="text" ng-model="fcdrr.devicetests.cyflow.adult_tests" />
				</div>
			</div>
			<div class="three wide column">
				<div class="ui labeled input">
					<div class="ui label">
						Alere PIMA:
					</div>
					<input placeholder="PIMA Tests" type="text" ng-model="fcdrr.devicetests.pima.pima_tests"/>
				</div>

			</div>
		</div>
		<hr />
		<div class="ui stackable grid">
			<div class="three wide column">TOTAL NUMBER OF CD4 TESTS DONE DURING THE MONTH(REPORTING PERIOD):</div>
			<div class="three wide column" ng-controller="fcdrrCtrl">
				<div class="ui input">
					<input ng-model="total_cd4" placeholder="{{facs_calibur_paed -- facs_calibur_adult -- facs_count_paed -- facs_count_adult -- cyflow_paed -- cyflow_adult}}" type="text" readonly />
					<!-- <input ng-model="total_cd4" placeholder="{{total()}}" readonly /> -->
				</div>
			</div>
		</div>
		<hr />
		<table  class="ui celled striped structured table" >
			<thead class="ui sticky" >
				<tr style="width:98%">
					<th  style="width:90em" rowspan="2">Commodity</th>
					<th  style="width:10em" rowspan="2">Unit</th>
					<th  style="width:30em" rowspan="2">Beginning Balance</th>
					<th  style="width:30em" rowspan="2">Quantity Received <br/>From Warehouse(e.g Kemsa)</th>
					<th  style="width:30em" rowspan="2"><center>Quantity Used</center></th>
					<th  style="width:30em" rowspan="2"><center>Losses / Wastages &nbsp;</center></th>
					<th   colspan="2">Adjustments<br/><i>Indicate if (+) or (-)</i></th>
					<th  style="width:30em" rowspan="2"><center>End Of Month<br/>Physical Count</center></th>
					<th  style="width:30em" rowspan="2"><center>Quantity<br />Requested</center></th>
				</tr>
				<tr>
					<th style="width:30em" >Positive</th>
					<th style="width:30em" >Negative</th>    
				</tr>
			</thead>

			<tbody ng-repeat="commodity in the_commodities">
				<tr ><td rowspan="1" colspan="10" style="background:#eeeeee;">{{commodity.category_name}}</td></tr>	
				
				<tr ng-repeat="comod_cat in commodity.commodities">
					<td style="width:50em">{{comod_cat.name}}</td>
					<td style="width:10em">{{comod_cat.unit}}</td>
					<td style="width:30em"><div class="ui input"><input ng-model="fcdrr.comodities[comod_cat.id].beg_bal" name="" id="" type="text"  required/></div></td>
					<td style="width:50em"><div class="ui input"><input ng-model="fcdrr.comodities[comod_cat.id].qty_receive" name="" id="" type="text"   required/></div></td>
					<td style="width:30em"><div class="ui input"><input ng-model="fcdrr.comodities[comod_cat.id].qty_used" name="" id="" type="text"  required/></div></td>
					<td style="width:30em"><div class="ui input"><input ng-model="fcdrr.comodities[comod_cat.id].losses" name="" id="" type="text"  required/></div></td>
					<td style="width:30em"><div class="ui input"><input ng-model="fcdrr.comodities[comod_cat.id].positives" name="" id="" type="text"  required/></div></td>
					<td style="width:30em"><div class="ui input"><input ng-model="fcdrr.comodities[comod_cat.id].negatives" name="" id="" type="text"  required/></div></td>
					<td style="width:30em"><div class="ui input"><input ng-model="fcdrr.comodities[comod_cat.id].end_bal" name="" id="" type="text"  required value="" readonly/></div></td>
					<td style="width:30em"><div class="ui input"><input ng-model="fcdrr.comodities[comod_cat.id].qty_request" name="" id="" type="text"  required/></td>

				</tr>
			</tbody>
		</table>
		<hr />
		<div class="sixteen wide column">	
			<div class="ui form">
				<div class="field">
					<label>FCDRR Comments</label>
					<textarea style="height:20px"></textarea>
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
		</form>
	</div>
</div>{{fcdrr}}
<script>
$(window).scroll(function(){
	var sticky = $('.sticky'),
	scroll = $(window).scrollTop();
	//console.log(scroll);
	if (scroll >= 314) sticky.addClass('fixed');
	else sticky.removeClass('fixed');
});
</script>
<style>
.fixed {
    position: fixed;
    top:0; 
    margin-top:45px; 
    left:0;
    width: 100%; }
</style>

