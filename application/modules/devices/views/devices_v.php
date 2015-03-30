<div class="ui stackable page grid" cg-busy="promise">
	<div class="twelve wide column" >
		<div style="" class="ui segment"> 

			<button type="button" ng-click="addRandomItem(row)" class="btn btn-sm btn-success">
				<i class="glyphicon glyphicon-plus">
				</i> Add a Device
			</button>

			<table st-table="displayedCollection" st-safe-src="facilitiesColl" class="ui table table-striped">
				<thead>
					<tr>
						<th colspan="6"><input st-search="" class="form-control" placeholder="global search ..." type="text"/></th>
					</tr>
					<tr>
						<th st-sort="device_name">Device Name</th>
						<th st-sort="facility_name">Facility Name</th>
						<th st-sort="serial_number">Serial Number</th>
						<th st-sort="">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="row in displayedCollection">
						<td>{{row.device_name}}</td>
						<td>{{row.facility_name+' ( '+row.facility_mfl_code+' )'}}</td>
						<td>{{row.serial_number}}</td>
						<td>
							<button type="button" ng-click="removeItem(row)" class="btn btn-sm btn-danger" style="    padding-top: 1px;  padding-bottom: 1px;">
								<i class="remove icon">
								</i>
							</button>
							<button type="button" ng-click="newFacility()" class="btn btn-sm btn-primary" style="    padding-top: 1px;  padding-bottom: 1px;">
								<i class="edit icon">
								</i>
							</button>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6" class="text-center">
							<center><div st-pagination=""  st-items-by-page="6" st-displayed-pages="10"></div></center>
						</td>
					</tr>
				</tfoot>
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

<style>

</style>

