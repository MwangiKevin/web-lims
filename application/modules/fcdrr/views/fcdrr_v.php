<div style="margin-left:2px" cg-busy="promise">
	<div ui-view="filter" class="ui column segment grid" id="viewport">
		<h3><center>FACILITY CONSUMPTION DATA REPORT & REQUEST(F-CDRR) FOR ART LABORATORY MONITORING REAGENTS (MoH643B)</center></h3>
		<div>
		<div class="ui horizontal divider">Start</div>
		<a class="ui teal ribbon label">Facility Details</a>
		<div class="ui stackable grid">
			<div class="six wide column"> <div class="ui horizontal label large">Facility (MFL Code):</div><b>{{ fcdrr.facility.facility_name+'('+fcdrr.facility.facility_mfl_code+')' }}</b></div>
			<div class="three wide column"> <div class="ui horizontal label large">Sub County:</div><b>{{fcdrr.facility.sub_county_name}}</b></div>
			<div class="three wide column"> <div class="ui horizontal label large">County:</div><b>{{fcdrr.facility.county_name}}</b></div>
			<div class="three wide column"> <div class="ui horizontal label large">Affiliation:</div><b>{{fcdrr.facility.affiliation}}</b></div>
		</div>
		<hr />
			<a class="ui teal ribbon label">Dates</a>
		<div class="ui stackable grid ">
			<div class="three wide column">REPORT OF THE PERIOD</div>
			<div class="three wide column" ng-show="(editState()=='new')">

				<ui-select ng-click="getSelectableMonths()" ng-model="selected.year" theme="selectize" search-enabled="searchDisabled" ng-disabled="disabled" style="width: 150px;">
					<ui-select-match placeholder="Select a Year">{{$select.selected.label}}</ui-select-match>
					<ui-select-choices repeat="year in selectableDates.years | filter: $select.search">
						<span ng-bind-html="year.label | highlight: $select.search"></span>
					</ui-select-choices>
				</ui-select>

			</div>
			<div class="three wide column" ng-show="selected.year&&(editState()=='new')">

				<ui-select on-select="bind_dates()" ng-model="selected.month" theme="selectize" search-enabled="searchDisabled" ng-disabled="disabled" style="width: 150px;">
					<ui-select-match placeholder="Select a Month">{{$select.selected.label}}</ui-select-match>
					<ui-select-choices  repeat="month in selectableDates.months | filter: $select.search">
						<span ng-bind-html="month.label | highlight: $select.search"></span>
					</ui-select-choices>
				</ui-select>

			</div>

			<div class="three wide column" ng-show="(editState()=='edit')">	
				<div class="ui input">
					<input  value="{{showYear()}}"   readonly/>
				</div>
			</div>
			<div class="three wide column" ng-show="(editState()=='edit')">			
				<div class="ui input">
					<input  value="{{showMonth()}}"   readonly/>
				</div>
			</div>
		</div>
		<hr />
		<a class="ui teal ribbon label"><div>Device Tests</div></a>
		<div class="ui stackable grid">
			<div class="three wide column">STATE THE NUMBER OF CD4 TESTS CONDUCTED:</div>
			<div class="three wide column">
				<div class="ui labeled input">
					<div class="ui label">
						Facs </br>Calibur:
					</div>
					<input ng-keyup="calculate_total()" placeholder="Paeds" type="text" only-digits ng-model="fcdrr.calibur_tests_pead"/>
					<input ng-keyup="calculate_total()" placeholder="Adults" type="text" only-digits ng-model="fcdrr.calibur_tests_adults" />
				</div>
			</div>
			<div class="three wide column">			
				<div class="ui labeled input">
					<div class="ui label">
						Facs </br>Count:
					</div>
					<input ng-keyup="calculate_total()" placeholder="Paeds" type="text" only-digits ng-model="fcdrr.count_tests_pead" />
					<input ng-keyup="calculate_total()" placeholder="Adults" type="text" only-digits ng-model="fcdrr.count_tests_adults" />
				</div>
			</div>
			<div class="three wide column">			
				<div class="ui labeled input">
					<div class="ui label">
						Cyflow </br>Partec:
					</div>
					<input ng-keyup="calculate_total()" placeholder="Paeds" type="text" only-digits ng-model="fcdrr.cyflow_tests_pead" />
					<input ng-keyup="calculate_total()" placeholder="Adults" type="text" only-digits ng-model="fcdrr.cyflow_tests_adults" />
				</div>
			</div>
			<div class="three wide column">
				<div class="ui labeled input">
					<div class="ui label">
						Alere </br>PIMA:
					</div>
					<input ng-keyup="calculate_total()" placeholder="Total Tests" type="text" only-digits ng-model="fcdrr.pima_tests"/>
				</div>
			</div>
		</div>
		<hr />
		<a class="ui teal ribbon label " >Total Tests</a>
		<div class="ui stackable grid" >
			<div class="three wide column">TOTAL NUMBER OF CD4 TESTS DONE DURING THE MONTH(REPORTING PERIOD):</div>
			<div class="three wide column">
				<div class="ui labeled input">
					<div class="ui label">
						Total :
					</div>
					<input ng-model="fcdrr.total_cd4" type="text" placeholder="Total tests" readonly />
				</div>
			</div>
			<div class="three wide column">
				<div class="ui labeled input">
					<div class="ui label">
						Adults < 500 </br>CD4 count:
					</div>
					<input ng-model="fcdrr.adults_bel_cl" placeholder="Adults < 500" type="text" />
				</div>
			</div>
			<div class="three wide column">
				<div class="ui labeled input">
					<div class="ui label">
						Pead < 500 </br>CD4 count:
					</div>
					<input ng-model="fcdrr.pead_bel_cl" placeholder="Peads < 500" type="text" />
				</div>
			</div>
		</div>
		<hr />
	<!-- 	<pre>
			{{fcdrr_id}}
		</pre> -->

		<hr />
		<a class="ui teal ribbon label" id="scroll-to">Commodities/Consumables</a>
		<table  class="ui celled striped structured table"   >
			<thead class="ui sticky" style="  padding-right: 4%;z-index:1;">
				<tr style="">
					<th   id="h_commodity_name" rowspan="2"><center>Commodity</center></th>
					<th   id="h_unit" rowspan="2"><center>Unit</center></th>
					<th   id="h_beg_bal" rowspan="2"><center>Beginning Balance</center></th>
					<th   id="h_quat_rec" colspan="2"><center>Received From<br/>Warehouse(e.g Kemsa) </center></th>
					<th   id="h_quant_used" rowspan="2"><center>Quantity Used</center></th>
					<th   id="h_loss" rowspan="2"><center>Losses / Wastages </center></th>
					<th   					colspan="2"><center>Adjustments<br/><i>Indicate if (+) or (-)</i></center></th>
					<th   id="h_end_bal" rowspan="2"><center>End Of Month<br/>Physical Count</center></th>
					<th   id="h_req" rowspan="2"><center>Quantity<br />Requested</center></th>
				</tr>
				<tr>
					<th  id="h_warehse" ><center>Quantity</center></th>
					<th  id="h_lot_no" ><center>Lot Code</center></th> 
					<th  id="h_adj_pos" ><center>Positive</center></th>
					<th  id="h_adj_neg" ><center>Negative</center></th>    
				</tr>
			</thead>

			<tbody ng-repeat="commodity_cat in commodities">
				<tr ><td rowspan="1" colspan="11" style="background:#eeeeee;">{{commodity_cat.category_name}}</td></tr>	

				<tr ng-repeat="commodity in commodity_cat.commodities">

					<td style="width:50em"><label class="ui horizontal label commodity-label commodity-hide" style="width:8em">Commodity:</label><div class="ui input">{{commodity.name}}</div></td>
					<td style="width:10em"><label class="ui horizontal label commodity-label commodity-hide" style="width:8em">Unit:</label><div class="ui input">{{commodity.unit}}</div></td>
					<td style="width:30em">
						<div class="item">
							<label class="ui horizontal label commodity-label commodity-hide">Beginning Balance:</label>								
							<div class="ui input">
								<input only-digits ng-model="fcdrr.displayed_commodities[commodity.id].beginning_bal" type="text"  required/>
							</div>
						</div>
					</td>
					<td style="width:50em">
						<label class="ui horizontal label commodity-label commodity-hide">Quantity Received:</label>
						<div class="ui input">
							<input only-digits ng-model="fcdrr.displayed_commodities[commodity.id].received_qty" type="text"   required/>
						</div>
					</td>
					<td style="width:50em">
						<label class="ui horizontal label commodity-label commodity-hide">Lot No:</label>
						<div class="ui input">
							<input ng-model="fcdrr.displayed_commodities[commodity.id].lot_code" type="text"   required/>
						</div>
					</td>
					<td style="width:30em">
						<label class="ui horizontal label commodity-label commodity-hide">Quantity Used:</label>
						<div class="ui input">
							<input only-digits ng-model="fcdrr.displayed_commodities[commodity.id].qty_used" type="text"  required/>
						</div>
					</td>
					<td style="width:30em">
						<label class="ui horizontal label commodity-label commodity-hide">Losses / Wastages:</label>
						<div class="ui input">
							<input only-digits ng-model="fcdrr.displayed_commodities[commodity.id].losses" type="text"  required/>
						</div>
					</td>
					<td style="width:30em">
						<label class="ui horizontal label commodity-label commodity-hide">Positive Adjustment:</label>
						<div class="ui input">
							<input only-digits ng-model="fcdrr.displayed_commodities[commodity.id].adjustment_plus" type="text"  required/>
						</div>
					</td>
					<td style="width:30em">
						<label class="ui horizontal label commodity-label commodity-hide">Negative Adjustment:</label>
						<div class="ui input">
							<input only-digits ng-model="fcdrr.displayed_commodities[commodity.id].adjustment_minus" type="text"  required/>
						</div>
					</td>
					<td style="width:30em">
						<label class="ui horizontal label commodity-label commodity-hide">End Balance:</label>
						<div class="ui input">
							<input only-digits ng-model="fcdrr.displayed_commodities[commodity.id].end_bal"  type="text"  required/>
						</div>
					</td>
					<td style="width:30em">
						<label class="ui horizontal label commodity-label commodity-hide">Quantity Requested:</label>
						<div class="ui input">
							<input only-digits ng-model="fcdrr.displayed_commodities[commodity.id].requested"  type="text"  required/>
						</div>
					</td>
				</tr>
			</tbody>				
			<tfooter class="ui label" >
				<tr style="">
					<td id="f_commodity_name"   rowspan="2"><center>Commodity</center></td>
					<td id="f_unit"   			rowspan="2"><center>Unit</center></td>
					<td id="f_beg_bal"   		rowspan="2"><center>Beginning Balance</center></td>
					<td id="f_quat_rec" 	   	colspan="2"><center>Received From <br/>Warehouse(e.g Kemsa)</center></td>
					<td id="f_quant_used"   	rowspan="2"><center>Quantity Used</center></td>
					<td id="f_loss"   			rowspan="2"><center>Losses / Wastages</center></td>
					<td   						colspan="2"><center>Adjustments<br/><i>Indicate if (+) or (-)</center></i></td>
					<td id="f_end_bal"   		rowspan="2"><center>End Of Month<br/>Physical Count</center></td>
					<td id="f_req"   			rowspan="2"><center>Quantity<br />Requested</center></td>
				</tr>
				<tr>
					<td id="f_warehse"  ><center>Quantity</center></td>
					<td id="f_lot_no"  ><center>Lot Code</center></td>   
					<td id="f_adj_pos"  ><center>Positive</center></td>
					<td id="f_adj_neg"  ><center>Negative</center></td>    
				</tr>
			</tfooter>
		</table>
		<hr />
		<a class="ui teal ribbon label">FCDRR Comments</a>
		<div class="sixteen wide column">	
			<div class="ui form">
				<div class="field">
					<textarea style="height:20px" ng-model="fcdrr.comments"></textarea>
				</div>
			</div>
		</div>
		<div class="ui horizontal divider">END</div> 
		<div class="ui stackable grid">
			<div class="five wide column">
				<button class="ui primary button" ng-click="save_fcdrr()">
					Submit Commodity Report	
				</button>
			</div>
			<div class="five wide column" ng-click="reset()">
				<button class="ui active button">
					Reset Form
				</button>
			</div>
			<div class="five wide column" ng-click="print()">
				<button class="ui teal button">
					Print
				</button>
			</div>
		</div>
		<div style="height:300px">

		</div>
		</div>
	</div>
</div>
<script>


$(window).scroll(function(){
	commodity_labels_();
	header_width();	

	var waypoint = new Waypoint({
		element: document.getElementById('scroll-to'),
		handler: function(direction) {
			stickY_(direction);
		}
	})

});
$(window).load(function(){
	commodity_labels_();
	header_width();

	var waypoint = new Waypoint({
		element: document.getElementById('scroll-to'),
		handler: function(direction) {
			stickY_(direction);
		}
	})
})

$(window).resize(function(){
	commodity_labels_();
	header_width();

	var waypoint = new Waypoint({
		element: document.getElementById('scroll-to'),
		handler: function(direction) {
			stickY_(direction);
		}
	})
});

function header_width(){
	$('#h_commodity_name').width($('#f_commodity_name').width());
	$('#h_unit').width($('#f_unit').width());
	$('#h_beg_bal').width($('#f_beg_bal').width());
	$('#h_quat_rec').width($('#f_quat_rec').width());
	$('#h_warehse').width($('#f_warehse').width());
	$('#h_lot_no').width($('#f_lot_no').width());
	$('#h_quant_used').width($('#f_quant_used').width());
	$('#h_loss').width($('#f_loss').width());
	$('#h_end_bal').width($('#f_end_bal').width());
	$('#h_req').width($('#f_req').width());
	$('#h_adj_pos').width($('#f_adj_pos').width());
	$('#h_adj_neg').width($('#f_adj_neg').width());

}

function commodity_labels_(){	

	var commodity_label = $('.commodity-label');
	width = $(window).width();
	if (width>691) {
		commodity_label.addClass(' commodity-hide');
		commodity_label.removeClass(' commodity-diplay');
	}else{

		commodity_label.removeClass(' commodity-hide');
		commodity_label.addClass(' commodity-diplay');
	}
}

function stickY_(direction){
	var sticky = $('.sticky');
	var commodity_label = $('.commodity-label');
	width = $(window).width();

	if ((width>691 )&& (direction == 'down')) {
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
.ui.labeled.input input {
   padding-right: 0.1em !important; 
   padding-left: 0.1em !important; 
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
	/*padding-right: 67px;*/
}
.ui.labeled.input{
	width:100%;
}
	</style>

