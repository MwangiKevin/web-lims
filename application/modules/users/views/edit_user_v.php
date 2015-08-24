<div class="ui segment">
	<br/>
  <h3><center><div class="ui blue horizontal label big ">User Details: </div> {{user.user_name}}</center></h3>
  <pre>{{user}}<pre/>
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
		        	<div class="ui horizontal label large ">Group</div><div class="field"></div>
		          	<select ng-model="user.default_user_group.group_id" convert-to-number>		          		
					  	<!-- <option value="0">*Choose one option*</option> -->
					  	<option ng-repeat ="group in user_groups" value="{{group.id}}">{{group.name}}</option>
					</select>
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
				<h3><center>This user is linked to:</center></h3>
		        <div class="field">
		          	<div class="ui horizontal label large ">Search Entity</div><div class="field"></div>
		          	<div class="left floated left aligned six wide column">
						<ui-select ng-model="user.linked_entity" theme="selectize" ng-disabled="(user.default_user_group.group_id == 0 ||user.default_user_group.group_id == 1 ||user.default_user_group.group_id == 2 || user.default_user_group.group_id == 8 ||user.default_user_group.group_id == 9)?true:false" reset-search-input="false" style="min-width: 500px;">
							<ui-select-match placeholder="Search For entity to link to">
								<div ng-show="(user.linked_entity.filter_type == -1 )?false:true " style="float:left;">{{user.linked_entity.name}}</div>
								<button style="padding-bottom: 3px;padding-top: 3px;padding-left: 3px;padding-right: 3px;float:right;" ng-show="(user.linked_entity.filter_type == -1 )?false:true " class="ui button blue" ng-click="clear_entity($event)">
									<i class="fa fa-remove fa-sm"></i>
								</button>
							</ui-select-match>
							<ui-select-choices group-by="'type'" repeat="entity in entities track by $index| limitTo:12"   refresh="refreshEntities($select.search)" refresh-delay="3" >
								<div ng-bind-html="entity.name | highlight: $select.search"></div>
								<small>
									email: {{entity.email}}
									phone: <span ng-bind-html="''+entity.phone | highlight: $select.search"></span>
								</small>
							</ui-select-choices>
						</ui-select>
					</div>
		        </div>		        		
			</form>
		</div>
  	</div>
  	<div class="sixteen wide column"> 
  	<div class="ui segment">
  		<!-- <pre>{{sess.user.default_user_group}}</pre> -->
  		<!-- <pre>{{user}}</pre> -->
	  	<div class="ui primary button" ng-click="put_user()"> Update Details </div>
		<button class="ui button" ng-click="back_users()"> Back To Users </button>
		<div style="height:50px"></div> 
	</div>	
  </div>
</div>