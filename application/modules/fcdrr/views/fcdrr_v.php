<div style="margin-left:10px">
	<div ui-view="filter" class="ui column segment grid" id="viewport">
		<h3><center>FACILITY CONSUMPTION DATA REPORT & REQUEST(F-CDRR) FOR ART LABORATORY MONITORING REAGENTS</center></h3>
		<form cg-busy="promise">
			<div class="ui horizontal divider">Start</div>
			<a class="ui teal ribbon label">Facility Details</a>
			<div class="ui stackable grid">
				<div class="six wide column"> <div class="ui horizontal label large">Facility (MFL Code):</div><b>{{ fcdrr.head_info.selected.facility.facility_name+'('+fcdrr.head_info.selected.facility.facility_mfl_code+')' }}</b></div>
				<div class="three wide column"> <div class="ui horizontal label large">Sub County:</div><b>{{fcdrr.head_info.selected.facility.facility_sub_county_name}}</b></div>
				<div class="three wide column"> <div class="ui horizontal label large">County:</div><b>{{fcdrr.head_info.selected.facility.facility_county_name}}</b></div>
				<div class="three wide column"> <div class="ui horizontal label large">Affiliation:</div><b>{{fcdrr.head_info.selected.facility.facility_affiliation}}</b></div>
			</div>
			<hr />
				<a class="ui teal ribbon label">Dates</a>
			<div class="ui stackable grid ">
				<div class="three wide column">REPORT OF THE PERIOD</div>
				<div class="three wide column">

					<ui-select ng-click="getSelectableMonths()" ng-model="fcdrr.head_info.selected.dates.year" theme="selectize" search-enabled="searchDisabled" ng-disabled="disabled" style="width: 150px;">
						<ui-select-match placeholder="Select a Year">{{$select.selected.label}}</ui-select-match>
						<ui-select-choices repeat="year in selectableDates.years | filter: $select.search">
							<span ng-bind-html="year.label | highlight: $select.search"></span>
						</ui-select-choices>
					</ui-select>

				</div>
				<div class="three wide column" ng-show="fcdrr.head_info.selected.dates.year">

					<ui-select ng-model="fcdrr.head_info.selected.dates.month" theme="selectize" search-enabled="searchDisabled" ng-disabled="disabled" style="width: 150px;">
						<ui-select-match placeholder="Select a Month">{{$select.selected.label}}</ui-select-match>
						<ui-select-choices  repeat="month in selectableDates.months | filter: $select.search">
							<span ng-bind-html="month.label | highlight: $select.search"></span>
						</ui-select-choices>
					</ui-select>

				</div>
			</div>
			<hr />
			<a class="ui teal ribbon label"><div>Device Tests</div></a>
			<div class="ui stackable grid">
				<div class="three wide column">State the number of CD4 Tests conducted:-</div>
				<div class="three wide column">
					<div class="ui labeled input">
						<div class="ui label">
							Facs </br>Calibur:
						</div>
						<input placeholder="Paed Tests" type="text" only-digits ng-model="fcdrr.devicetests.facs_calibur.paed_tests"/>
						<input placeholder="Adult Tests" type="text" only-digits ng-model="fcdrr.devicetests.facs_calibur.adult_tests" />
					</div>
				</div>
				<div class="three wide column">			
					<div class="ui labeled input">
						<div class="ui label">
							Facs </br>Count:
						</div>
						<input placeholder="Paed Tests" type="text" only-digits ng-model="fcdrr.devicetests.facs_count.paed_tests" />
						<input placeholder="Adult Tests" type="text" only-digits ng-model="fcdrr.devicetests.facs_count.adult_tests" />
					</div>
				</div>
				<div class="three wide column">			
					<div class="ui labeled input">
						<div class="ui label">
							Cyflow </br>Partec:
						</div>
						<input placeholder="Paed Tests" type="text" only-digits ng-model="fcdrr.devicetests.cyflow.paed_tests" />
						<input placeholder="Adult Tests" type="text" only-digits ng-model="fcdrr.devicetests.cyflow.adult_tests" />
					</div>
				</div>
				<div class="three wide column">
					<div class="ui labeled input">
						<div class="ui label">
							Alere PIMA:
						</div>
						<input placeholder="" type="text" only-digits ng-model="fcdrr.devicetests.pima.pima_tests"/>
					</div>
				</div>
			</div>
			<hr />
			<a class="ui teal ribbon label ">Total Tests</a>
			<div class="ui stackable grid" id="totalTests">
				<div class="three wide column">TOTAL NUMBER OF CD4 TESTS DONE DURING THE MONTH(REPORTING PERIOD):</div>
				<div class="three wide column" ng-controller="fcdrrCtrl">
					<div class="ui input">
						<input ng-model="total_cd4" placeholder="{{facs_calibur_paed -- facs_calibur_adult -- facs_count_paed -- facs_count_adult -- cyflow_paed -- cyflow_adult}}" type="text" readonly />

					</div>
				</div>
			</div>
			<hr />
			<pre>
				{{fcdrr}}
				{{selectableDates}}
				{{facilities}}
			</pre>

			<hr />
			<a class="ui teal ribbon label">Commodities/Consumables</a>
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

				<tbody ng-repeat="commodity_cat in commodities">
					<tr ><td rowspan="1" colspan="10" style="background:#eeeeee;">{{commodity_cat.category_name}}</td></tr>	

					<tr ng-repeat="commodity in commodity_cat.commodities">

						<td style="width:50em"><label class="ui horizontal label commodity-label commodity-hide" style="width:8em">Commodity:</label><div class="ui input">{{commodity.name}}</div></td>
						<td style="width:10em"><label class="ui horizontal label commodity-label commodity-hide" style="width:8em">Unit:</label><div class="ui input">{{commodity.unit}}</div></td>
						<td style="width:30em">
							<div class="item">
								<label class="ui horizontal label commodity-label commodity-hide">Beginning Balance:</label>								
								<div class="ui input">
									<input only-digits ng-model="fcdrr.comodities[commodity.id].beg_bal" type="text"  required/>
								</div>
							</div>
						</td>
						<td style="width:50em">
							<label class="ui horizontal label commodity-label commodity-hide">Quantity Received:</label>
							<div class="ui input">
								<input only-digits ng-model="fcdrr.comodities[commodity.id].qty_receive" type="text"   required/>
							</div>
						</td>
						<td style="width:30em">
							<label class="ui horizontal label commodity-label commodity-hide">Quantity Used:</label>
							<div class="ui input">
								<input only-digits ng-model="fcdrr.comodities[commodity.id].qty_used" type="text"  required/>
							</div>
						</td>
						<td style="width:30em">
							<label class="ui horizontal label commodity-label commodity-hide">Losses / Wastages:</label>
							<div class="ui input">
								<input only-digits ng-model="fcdrr.comodities[commodity.id].losses" type="text"  required/>
							</div>
						</td>
						<td style="width:30em">
							<label class="ui horizontal label commodity-label commodity-hide">Positive Adjustment:</label>
							<div class="ui input">
								<input only-digits ng-model="fcdrr.comodities[commodity.id].positives" type="text"  required/>
							</div>
						</td>
						<td style="width:30em">
							<label class="ui horizontal label commodity-label commodity-hide">Negative Adjustment:</label>
							<div class="ui input">
								<input only-digits ng-model="fcdrr.comodities[commodity.id].negatives" type="text"  required/>
							</div>
						</td>
						<td style="width:30em">
							<label class="ui horizontal label commodity-label commodity-hide">End Balance:</label>
							<div class="ui input">
								<input only-digits ng-model="fcdrr.comodities[commodity.id].end_bal"  type="text"  readonly/>
							</div>
						</td>
						<td style="width:30em">
							<label class="ui horizontal label commodity-label commodity-hide">Quantity Requested:</label>
							<div class="ui input">
								<input only-digits ng-model="fcdrr.comodities[commodity.id].qty_request"  type="text"  required/>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<hr />
			<a class="ui teal ribbon label">FCDRR Comments</a>
			<div class="sixteen wide column">	
				<div class="ui form">
					<div class="field">
						<textarea style="height:20px"></textarea>
					</div>
				</div>
			</div>
			<div class="ui horizontal divider">END</div> 
			<div class="ui stackable grid">
				<div class="five wide column">
					<div class="ui primary button">
						Submit Commodity Report	
					</div>
				</div>
				<div class="five wide column">
					<div class="ui active button">
						Reset Form
					</div>
				</div>
				<div class="five wide column">
					<div class="ui teal button">
						Print	
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script>


$(window).scroll(function(){
	stickY_();
	commodity_labels_();
});
$(window).load(function(){
	stickY_();
	commodity_labels_();
})

$(window).resize(function(){
	stickY_();
	commodity_labels_();
});


function commodity_labels_(){	
	width = $(window).width();
	if (width>691) {
		commodity_label.addClass(' commodity-hide');
		commodity_label.removeClass(' commodity-diplay');
	}else{

		commodity_label.removeClass(' commodity-hide');
		commodity_label.addClass(' commodity-diplay');
	}
}

function stickY_(){
	var sticky = $('.sticky');
	var commodity_label = $('.commodity-label');
	scroll = $(window).scrollTop();
	width = $(window).width();

	if (scroll >= 514 && width>691) {
		sticky.addClass('fixed');
	}
	else {
		sticky.removeClass('fixed');
	}


	if (width>691) {
		commodity_label.addClass(' commodity-hide');
		commodity_label.removeClass(' commodity-diplay');
	}else{

		commodity_label.removeClass(' commodity-hide');
		commodity_label.addClass(' commodity-diplay');
	}
}

</script>
<style>
.commodity-diplay{
	display:auto !important;
	width:15em;
}
.commodity-hide{
	display:none !important;
	width:15em;
}
.fixed {
	position: fixed;
	top:0; 
	margin-top:45px; 
	left:0;
	width: 100%; 	
	padding-right: 67px;
}
.ui.labeled.input{
	width:100%;
}
	</style>

