<div class="ui stackable page grid" cg-busy="promise">
	<div class="twelve wide column" >
		<div style="" class="ui segment"> 

			<table st-table="displayedCollection" st-safe-src="fcdrrsColl" class="ui table table-striped">
				<thead>
					<tr>
						<th colspan="6"><input st-search="" class="form-control" placeholder="global search ..." type="text"/></th>
					</tr>
					<tr>
						<th st-sort="facility_name">Facility Name</th>
						<th st-sort="facility.facility_mfl_code">MFL Code</th>
						<th st-sort="from_date">Start Date</th>
						<th st-sort="to_date">End Date</th>
						<th st-sort="commodities.length">Commodities reported for</th>
						<th st-sort="">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="row in displayedCollection">
						<td>{{row.facility_name}}</td>
						<td>{{row.facility_mfl_code}}</td>
						<td>{{row.from_date}}</td>
						<td>{{row.to_date}}</td>
						<td>{{row.commodities.length}}</td>
						<td>
							<!-- <a type="button"  class="btn btn-sm btn-danger" style="    padding-top: 1px;  padding-bottom: 1px;">
								<i class="remove icon">
								</i>
							</a> -->
							<a type="button" href="#editFCDRR/{{row.fcdrr_id}}" class="ui blue button" style="padding-top: 3px;  padding-bottom: 3px;">
								<i class="edit icon">
								</i>
							</a>
							<a type="button" href="#editFCDRR/{{row.fcdrr_id}}" class="ui teal button" style="padding-top: 3px;  padding-bottom: 3px;">
								<i class="print icon">
								</i>
							</a>
							<a type="button" href="#editFCDRR/{{row.fcdrr_id}}" class="ui purple button" style="padding-top: 3px;  padding-bottom: 3px;">
								<i class="file excel outline icon">
								</i>
							</a>
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
<!-- 	<div class="three wide column">
		<div class="ui segment">

		</div>
		<div class="ui segment">			
			
		</div>
	</div> -->
</div>

<style>

</style>

