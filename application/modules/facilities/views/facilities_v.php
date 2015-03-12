<div class="ui stackable page grid">
	<div class="twelve wide column">
		<div style="" class="ui segment"> 

			<button type="button" ng-click="addRandomItem(row)" class="btn btn-sm btn-success">
				<i class="glyphicon glyphicon-plus">
				</i> Add random item
			</button>

			<table st-table="displayedCollection" st-safe-src="facilitiesColl" class="ui table table-striped">
				<thead>
					<tr>
						<th colspan="1"><input st-search="" class="form-control" placeholder="global search ..." type="text"/></th>
					</tr>
					<tr>
						<th st-sort="firstName">Facility Name</th>
						<th st-sort="lastName">MFL Code</th>
						<th st-sort="lastName">County</th>
						<th st-sort="birthDate">Sub-County</th>
						<th st-sort="birthDate">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="row in displayedCollection">
						<td>{{row.facility_name}}</td>
						<td>{{row.facility_mfl_code}}</td>
						<td>{{row.county_name}}</td>
						<td>{{row.sub_county_name}}</td>
						<td>
							<button type="button" ng-click="removeItem(row)" class="btn btn-sm btn-danger">
								<i class="remove icon">
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