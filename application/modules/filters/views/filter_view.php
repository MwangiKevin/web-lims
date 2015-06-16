

<script type="text/javascript">
$('#reportrange').daterangepicker(
{
	ranges: {
		'Today': [moment(), moment()],
		'Last 7 Days': [moment().subtract('days', 6), moment()],
		'Last 30 Days': [moment().subtract('days', 29), moment()],
		'This Month': [moment().startOf('month'), moment().endOf('month')],
		'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')],
		'Last Three Months': [moment().subtract('month', 3).startOf('month'), moment().subtract('month').endOf('month')],
		'Last Six Months': [moment().subtract('month', 6).startOf('month'), moment().subtract('month').endOf('month')],
		'This Year': [moment().startOf('year'),moment()],
	},
	format: 'YYYY-MM-DD',
	startDate: '<?php echo date("Y");?>-1-1',
	endDate: '<?php echo date("Y-m-d");?>',
	maxDate:'<?php echo date("Y-m-d");?>',
	minDate:'2012-1-1',
	showWeekNumbers:true,
	showDropdowns:true
},
function(start, end) {
	$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
	$('#fro').val(start.format('YYYY-MM-D') ).trigger('change');
	$('#to').val(end.format('YYYY-MM-D') ).trigger('change');

	angular.element('#filterNav').scope().$apply(function(){
		angular.element('#filterNav').scope().bindDates(start.format('YYYY-MM-D'),end.format('YYYY-MM-D'));
	})
}
);

$('#reportrange').on('apply.daterangepicker', function(ev, picker) {
})
</script>
<div class="ui right aligned stackable grid">
	<div class="left floated left aligned six wide column">
		<ui-select ng-model="filters.selected.entity" theme="selectize" ng-disabled="disabled" reset-search-input="false" style="min-width: 300px;">
		<ui-select-match placeholder="Search Criteria to Filter by...">{{$select.selected.name +" ("+ $select.selected.type +")"  }}</ui-select-match>
		<ui-select-choices group-by="'type'" repeat="entity in filters.entities track by $index| limitTo:12"   refresh="refreshFilters($select.search)" refresh-delay="3" >
		<div ng-bind-html="entity.name | highlight: $select.search"></div>
		<small>
			email: {{entity.email}}
			phone: <span ng-bind-html="''+entity.phone | highlight: $select.search"></span>
		</small>
	</ui-select-choices>
</ui-select>
</div>
<div class="left floated left aligned two wide column">

	<div class="ui button blue"><i class="fa fa-undo fa-sm"></i> Reset </div>
</div>

<div class="right floated right aligned six wide column">
	<div class="blue ui buttons">
		<!-- {{ Filters}} -->
		<div id="reportrange" class="ui button pull-right filterButton" style="">
			<i class="fa fa-calendar fa-md"></i>
			<span><?php echo 'January '.date("1, Y", strtotime('first day of this year')); ?> - <?php echo date("F j, Y"); ?></span> <b class="caret"></b>
		</div>
	</div>
</div>

</div>
<style>

.opensleft{
	top: 123.5px; 
	right: 209.875px; 
	left: auto; 
	display: none;
}
.optgroup-header {
	font-size: 20px !important;
	line-height: 1.42857143 !important; 
	color: #000000 !important; 
	background: #D4DDB8 !important;
}
</style>