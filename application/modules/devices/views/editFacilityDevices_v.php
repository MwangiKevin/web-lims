<div class="ui segment">
  <h3><center><div class="ui pink horizontal label big"> CD4 Device: </div> {{ facility_dev_detail.serial_number }}</center></h3>
</div>

<div class="ui segment">
<form class="ui form">
		<div class="ui stackable grid">
			<div class="ui pink horizontal label big">Device Details</div><div class="field"></div>
			<div class="two fields">
		        <div class="field">
		        	<div class="ui horizontal label large">Device Serial Number</div><div class="field"></div>
		          	<input type="text" value="{{ facility_dev_detail.serial_number }}">
		        </div>
		        <div class="field">
		        	<div class="ui horizontal label large">Device Type</div><div class="field"></div>
		          	<input type="text" value="{{ facility_dev_detail.device_name }}">
		        </div>
	    	</div>
	    	<div class="two fields">
			    <div class="field">
		        	<div class="ui horizontal label large">Date Added</div><div class="field"></div>
		      		<input type="text" value="{{ facility_dev_detail.date_added }}">
			    </div>
			    <div class="field">
		        	<div class="ui horizontal label large">Roll Out Date</div><div class="field"></div>
			      	<input type="text" value="{{ facility_dev_detail.facility_rollout_date }}">
			    </div>
			</div>
			<div class="two fields">
			    <div class="field">
		      		<div class="ui horizontal label large">Roll Out Status</div>
		      		<input type="checkbox" ng-model="check_roll">
		      		<!-- <div class="ui toggle checkbox">
					    <input type="checkbox" ng-model="check_roll">  
					</div> -->
					<div class="field"></div>
			    </div>
			    <div class="field">
		        	<div class="ui horizontal label large" id="der" >Deactivation Reason</div><div class="field"></div>
			      	<input type="text" ng-show="deact_reason" value="{{ facility_dev_detail.deactivation_reason }}">
			    </div>
			</div>
		</div>
		<hr />
		<div class="ui stackable grid">
			<div class="ui pink horizontal label big">Facility Details</div><div class="field"></div>
			<div class="two fields">
		        <div class="field">
		          <div class="ui horizontal label large">Facility Name</div><div class="field"></div>
		          <!-- <div class="ui selection dropdown search" > -->
				        <input type="hidden" name="sub-county">
				       <!--  <i class="dropdown icon"></i> -->
				        <select ng-model="facility" ng-change="facility_change(facility.facility_id)" ng-options="facility as facility.facility_name for facility in facilities">
					        	<option value="">{{ facility_dev_detail.facility_name }}</option>
				        </select>
				        <!-- <div class="menu" ng-model="facilitya" ng-change="getDe()">
				          <div class="item" ng-repeat="facility in facilities" data-value="{{ facility.facility_id }}" >{{ facility.facility_name }}</div>
				        </div> -->
			      	<!-- </div> -->
		        </div>
		        <div class="field">
		        	<div class="ui horizontal label large">MFL Code</div><div class="field"></div>
		          	<input type="text" readonly value="{{ facility_dev_detail.facility_mfl_code }}">
		        </div>
	    	</div>
			<div class="two fields">
			    <div class="field">
		        	<div class="ui horizontal label large"> Sub County</div><div class="field"></div>
		      		<input type="text" readonly value="{{ facility_dev_detail.sub_county_name }}">
		    	</div>
		    	<div class="field">
	        		<div class="ui horizontal label large"> County </div><div class="field"></div>
			    	<input type="text" readonly value="{{ facility_dev_detail.county_name }}">
		    	</div>
			</div>

			<div class="two fields">
			    <div class="field">
		        	<div class="ui horizontal label large"> Partner </div><div class="field"></div>
		      		<input type="text" readonly value="{{ facility_dev_detail.partner_name }}">
			    </div>
			</div>
			<div class="field"></div><hr />
			<div class="field">
				<div class="ui primary button"> Save Details</div>
				<button class="ui button" ng-click="backDevices()"> Back To Devices </button>
			</div>
		
		<div style="height:50px">

		</div>
	</div>
</form>
</div>
<script type="text/javascript">
//$('.ui.toggle.checkbox').checkbox();

</script>