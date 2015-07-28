<div class="ui segment">
  <h3><center><div class="ui yellow horizontal label big ">User Details: </div> {{user.user_name}}</center></h3>
</div>
<div class="ui segment">
	<form class="ui form">
	    <div class="three fields">
	        <div class="field">
	          <div class="ui horizontal label large ">Name</div><div class="field"></div>
	          <input type="text" ng-model="user.user_name" value="{{ user.user_name }}">
	        </div>
	        <div class="field">
	        	<div class="ui horizontal label large ">E-mail Address</div><div class="field"></div>
	          	<input type="text" ng-model="user.email" value="{{ user.email }}">
	        </div>
	    </div>
	    <div class="three fields">
		    <div class="field">
	        	<div class="ui horizontal label large ">Phone</div><div class="field"></div>
		      	<input type="text" ng-model="user.phone" value="{{ user.phone }}">
		    </div>
		  <!--   <div class="field">
	        	<div class="ui horizontal label large ">Phone</div><div class="field"></div>
		      	<input type="text" ng-model="user.phone" value="{{ user.phone }}">
		    </div> -->
		</div>
		<!-- <br/>{{user}}<br/> -->
	  	<div class="ui primary button" ng-click="put_user()"> Save Details </div>
		<button class="ui button" ng-click="bac_users()"> Back To Facilities </button>
		<div style="height:150px"></div>
	</form>
</div>
