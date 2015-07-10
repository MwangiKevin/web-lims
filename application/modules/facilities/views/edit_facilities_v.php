<div class="ui segment">
  <h3><center><div class="ui yellow horizontal label big ">Facility Details: </div> {{facility_detail.facility_name}}</center></h3>
</div>
<div class="ui segment">
	<form class="ui form">
	    <div class="two fields">
	        <div class="field">
	          <div class="ui horizontal label large ">Facility Name</div><div class="field"></div>
	          <input type="text" value="{{ facility_detail.facility_name }}">
	        </div>
	        <div class="field">
	        	<div class="ui horizontal label large ">MFL Code</div><div class="field"></div>
	          	<input type="text" value="{{ facility_detail.facility_mfl_code }}">
	        </div>
	    </div>
	    <div class="two fields">
		    <div class="field">
	        	<div class="ui horizontal label large ">Email Address</div><div class="field"></div>
	      		<input type="text" value="{{ facility_detail.facility_email }}">
		    </div>
		    <div class="field">
	        	<div class="ui horizontal label large ">Phone</div><div class="field"></div>
		      	<input type="text" value="{{ facility_detail.facility_phone }}">
		    </div>
		</div>

		<div class="two fields">
		    <div class="field">
	        	<div class="ui horizontal label large "> Sub County</div><div class="field"></div>
			        <select ng-model="sub_county" ng-change="sub_county_change(sub_county.county_id)" ng-options="sub_county as sub_county.name for sub_county in sub_counties">
					        <option value="">{{ facility_detail.sub_county_name }}</option>
				    </select>
		    </div>
		    <div class="field">
	        	<div class="ui horizontal label large "> County </div><div class="field"></div>
			        <input type="text" name="county" readonly value="{{ facility_detail.county_name }}">
		    </div>
		</div>

		<div class="two fields">
		    <div class="field">
	        	<div class="ui horizontal label large "> Partner </div><div class="field"></div>
	      		<div class="ui selection dropdown search" >
				        <input type="hidden" name="partner">
				        <div class="text">{{ facility_detail.partner_name }}</div>
				        <i class="dropdown icon"></i>
				        <div class="menu">
				          <div class="item" ng-repeat="partner in partners" data-value="{{ partner.name }}" >{{ partner.name }}</div>
				        </div>
		      		</div>
		    </div>
		    <div class="field">
	        	<div class="ui horizontal label large "> Central Site</div><div class="field"></div>
		      	<input type="text" value="{{ facility_detail.central_site_name }}">
		    </div>
		</div>
	  	<div class="ui primary button"> Save Details </div>
		<button class="ui button" ng-click="backFacilities()"> Back To Facilities </button>
</form>
</div>
