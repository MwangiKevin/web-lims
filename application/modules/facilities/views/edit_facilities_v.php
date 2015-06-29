<div class="ui segment">
  <h3><center>Edit Facility Details for {{facility_detail.facility_name}}</center></h3>
</div>
<div class="ui segment">
	<form class="ui form">
	    <div class="two fields">
	        <div class="field">
	          <div class="ui teal horizontal label">Facility Name</div><div class="field"></div>
	          <input type="text" value="{{ facility_detail.facility_name }}">
	        </div>
	        <div class="field">
	        	<div class="ui teal horizontal label">MFL Code</div><div class="field"></div>
	          	<input type="text" value="{{ facility_detail.facility_mfl_code }}">
	        </div>
	    </div>
	    <div class="two fields">
		    <div class="field">
	        	<div class="ui teal horizontal label">Email Address</div><div class="field"></div>
	      		<input type="text" value="{{ facility_detail.facility_email }}">
		    </div>
		    <div class="field">
	        	<div class="ui teal horizontal label">Phone</div><div class="field"></div>
		      	<input type="text" value="{{ facility_detail.facility_email }}">
		    </div>
		</div>

		<div class="two fields">
		    <div class="field">
	        	<div class="ui teal horizontal label"> Sub County</div><div class="field"></div>
	      		<div class="ui selection dropdown search" >
			        <input type="hidden" name="sub-county">
			        <div class="text">{{ facility_detail.sub_county_name }}</div>
			        <i class="dropdown icon"></i>
			        <div class="menu">
			          <div class="item" ng-repeat="sub_county in sub_counties" data-value="{{ sub_county.name }}" >{{ sub_county.name }}</div>
			        </div>
		      	</div>
		    </div>
		    <div class="field">
	        	<div class="ui teal horizontal label"> County </div><div class="field"></div>
			    <div class="ui selection dropdown search" >
			        <input type="hidden" name="county">
			        <div class="text">{{ facility_detail.county_name }}</div>
			        <i class="dropdown icon"></i>
			        <div class="menu">
			          <div class="item" ng-repeat="county in counties" data-value="{{ county.name }}" >{{ county.name }}</div>
			        </div>
		      	</div>
		    </div>
		</div>

		<div class="two fields">
		    <div class="field">
	        	<div class="ui teal horizontal label"> Partner </div><div class="field"></div>
	      		<input type="text" value="{{ facility_detail.partner_name }}">
		    </div>
		    <div class="field">
	        	<div class="ui teal horizontal label"> Central Site</div><div class="field"></div>
		      	<input type="text" value="{{ facility_detail.central_site_name }}">
		    </div>
		</div>
	  	<div class="ui primary button"> Save Details</div>
		<button class="ui button" ng-click="backFacilities()"> Back To Facilities </button>
</form>
</div>
