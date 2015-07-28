<div class="ui segment">
	<br/>
  <h3><center><div class="ui blue horizontal label big ">User Details: </div> {{user.user_name}}</center></h3>
</div>
<div class="ui grid">
  	<div class="eight wide column">
	  	<div class="ui segment">
			<form class="ui form">
		        <div class="field">
		          <div class="ui horizontal label large ">Name</div><div class="field"></div>
		          <input type="text" ng-model="user.user_name" >
		        </div>
		        <div class="field">
		        	<div class="ui horizontal label large ">E-mail Address</div><div class="field"></div>
		          	<input type="text" ng-model="user.email" >
		        </div>
			    <div class="field">
		        	<div class="ui horizontal label large ">Phone</div><div class="field"></div>
			      	<input type="text" ng-model="user.phone" >
			    </div>	
			    <div class="field">
			    	<div class="ui horizontal label large">banned?</div>
		      		<input type="checkbox" ng-model="banned">
					<div class="field"></div>
		        </div>		
			</form>
		</div>
  	</div>
  	<div class="seven wide column">
	  	<div class="ui segment">
			<form class="ui form">
				<h3><center>This user is linked to</center></h3>
		        <div class="field">
		          <div class="ui horizontal label large ">Search Entity</div><div class="field"></div>
		          <input type="text" ng-model="" >
		        </div>		        		
			</form>
		</div>
  	</div>
  	<div class="sixteen wide column"> 
  	<div class="ui segment">
		<!-- <br/>{{user}}<br/> -->
	  	<div class="ui primary button" ng-click="put_user()"> Save Details </div>
		<button class="ui button" ng-click="bac_users()"> Back To Facilities </button>
		<div style="height:150px"></div> 	
		</div>
  </div>
</div>