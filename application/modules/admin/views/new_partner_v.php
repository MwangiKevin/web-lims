<div class="ui segment">
  <h3><center><div class="ui blue horizontal label big ">New Partner Details</div> (Fields marked with <i class="asterisk red icon"></i> are Required)</center></h3>
</div>

<div class="ui segment">
	<form class="ui form">
	    <div class="two fields">
	        <div class="field">
	          <div class="ui horizontal label large "> Partner Name <i class="asterisk red icon"></i></div><div class="field"></div>
	          <input type="text" ng-model="partner.name">
	        </div>
	        <div class="field">
	        	<div class="ui horizontal label large "> Phone </div><div class="field"></div>
	          	<input type="text" ng-model="partner.phone">
	        </div>
	    </div>
	    <div class="two fields">
	        <div class="field">
	          <div class="ui horizontal label large "> Partner Email </div><div class="field"></div>
	          <input type="text" ng-model="partner.email">
	        </div>
	        <div class="field"></div>
	    </div>

	    <div class="ui primary button" ng-click="save_partner()"> Save Details</div>
		<button class="ui button" ng-click="backPartners()"> Back To Parnters </button>
	</form>
	{{ partner }}
</div>