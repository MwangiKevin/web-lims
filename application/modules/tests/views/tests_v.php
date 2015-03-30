<div class="ui stackable page grid">
	<div class="twelve wide column">
		<div style="" class="ui segment"> 

			<button type="button" ng-click="addRandomItem(row)" class="btn btn-sm btn-success">
				<i class="glyphicon glyphicon-plus">
				</i> Add random item
			</button>

			<table st-table="displayedCollection" st-safe-src="testsColl" class="ui table table-striped">
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