<div class="ui segment">
  <h3><center><div class="ui blue horizontal label big ">Partner Details: </div> {{partner.name}}</center></h3>
</div>

<div class="ui segment">
	<form class="ui form">
	    <div class="two fields">
	        <div class="field">
	          <div class="ui horizontal label large "> Partner Name </div><div class="field"></div>
	          <input type="text" ng-model="partner.name" value="{{ partner.name }}">
	        </div>
	        <div class="field">
	        	<div class="ui horizontal label large "> Phone </div><div class="field"></div>
	          	<input type="text" ng-model="partner.phone" value="{{ partner.phone }}">
	        </div>
	    </div>
	    <div class="two fields">
	        <div class="field">
	          <div class="ui horizontal label large "> Partner Email </div><div class="field"></div>
	          <input type="text" ng-model="partner.email" value="{{ partner.email }}">
	        </div>
	        <div class="field"></div>
	    </div>

	    <div class="ui primary button" ng-click="put_partner()"> Save Details</div>
		<button class="ui button" ng-click="backPartners()"> Back To Parnters </button>
	</form>
</div>