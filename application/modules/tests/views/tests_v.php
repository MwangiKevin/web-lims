<div class="ui stackable page grid">
	<div class="twelve wide column">
		<div style="" class="ui segment"> 

			<button type="button" ng-click="addRandomItem(row)" class="btn btn-sm btn-success">
				<i class="glyphicon glyphicon-plus">
				</i> Add random item
			</button>

			<!-- <table st-table="displayedCollection" st-safe-src="testsColl" class="ui table table-striped">
				<thead>
					<tr>
						<th colspan="1"><input st-search="" class="form-control" placeholder="global search ..." type="text"/></th>
					</tr>
					<tr>
						<th st-sort="firstName">Facility Name</th>
						<th st-sort="lastName">MFL Code</th>
						<th st-sort="lastName">Patient ID</th>
						<th st-sort="birthDate">Result</th>
						<th st-sort="birthDate">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="row in displayedCollection">
						<td>{{row.firstName}}</td>
						<td>{{row.lastName}}</td>
						<td>{{row.birthDate}}</td>
						<td>{{row.balance}}</td>
						<td>
							<button type="button" ng-click="removeItem(row)" class="btn btn-sm btn-danger">
								<i class="glyphicon glyphicon-remove-circle">
								</i>
							</button>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="5" class="text-center">
							<div st-pagination="" st-items-by-page="itemsByPage" st-displayed-pages="10"></div>
						</td>
					</tr>
				</tfoot>
			</table> -->
			<table class="table table-bordered" id="tests_table" width="100%">
				<thead>
					<tr>
						
			            <th style="text-align: center" >Test ID</th>
			            <th style="text-align: center" >Patient ID</th>
			            <th style="text-align: center" >Facility</th>
			            <th style="text-align: center" >CD4 Count</th>
			           
			         </tr>
				</thead>
				<tbody>
									       
					<tr class="odd gradeX">
							
					<td style="text-align: center"> </td>
					<td style="text-align: center"> </td>
					<td style="text-align: center"> </td>
					<td style="text-align: center">  </td>
					 
					 </tr>
				
				</tbody>
			</table>

		</div>
	</div>
	<div class="three wide column">
		<div class="ui segment">

		</div>
		<div class="ui segment">

		</div>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function(){
	// $('#example').dataTable( {
	// 	"processing":true,
	// 	"serverSide":true,
	// 	"sAjaxSource" : "tests/test_unparametized",
	// 	"oLanguage": {
	// 		"sLengthMenu": "Page length: _MENU_",
	// 		"sSearch": "Filter",
	// 		"sZeroRecords":"No records found"
	// 	} 
	// });
$('#tests_table').dataTable({
	serverSide: true,
	processing: true,
	ajax: {
		type: 'POST',
		url: 'tests/test_unparametized'
	}
	// sAjaxSource: 'tests/test_unparametized',
	// oLanguage: {
	// 	sLengthMenu: 'Page length: _MENU_',
	// 	sSearch: 'Filter',
	// 	sZeroRecords: 'No records found'
	// }
});

});
</script>
