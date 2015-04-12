<style>
	h1{
		padding:0px;
	}	
	h3{
		padding:0px;
	}
	body{
		background-color:#F2F1EF;
	}
	#form-container{
		background-color:#556676;/*#C5EFF7*/
		color:#fff;
		padding:1%;
		-moz-border-radius: 5%;
		-webkit-border-radius: 5%;
		border-radius: 5%; 
		-khtml-border-radius: 5%;
		margin-left:25%; 
		margin-top:5%;
		width: 50%;
	}
	#loginfm{
		background-color:#C5EFF7;/*#E4F1FE*/
		padding:2%;
		color:#000;
		-moz-border-radius: 2%;
		-webkit-border-radius: 2%;
		border-radius: 2%; 
		-khtml-border-radius: 2%;
		width: 80%;
		margin-left:10%; 
		margin-top:2%;
		text-align: center;
	}
	input.ng-invalid.ng-dirty{
		border:1px solid red;
	}
	.form-control{
		width:90%;
		height: 27px;
		margin:5%;
	}
	.form-group{
		padding:5%;
	}

</style>
<div id="form-container">
	<center>
		<h1>{{Title}}</h1>
		<img src="<?php echo base_url('assets/images/coat_of_arms.png'); ?>" style="width 100px; height: 100px;" /><br/>
		<h3>{{application}}</h3>
	</center>
	
	<div id="alerts" style="background-color: #1BBC9B; width: 100%; text-align: center;"><p></p></div>
	
	<form ng-submit="onLogin()" name="login_fm" id="loginfm">
		<div class="ui input">
			<label>
				Username
			</label>
			<input type="text" ng-model='user.username'  id="username" name="username" placeholder="Username" required>
		</div><br/>
		<div class="ui input">
			<label>
				Password
			</label>
			<input type="password" ng-model="user.password" id="password" name="password" placeholder="Password" required  ng-minlength = "5">
			<!-- <span ng-show="login_fm.password.$dirty && login_fm.password.$error.minlength">Too short</span> -->
		</div>
		<center style="padding-top: 5%;">
			<input type="submit" ng-disabled="login_fm.$invalid" class="btn btn-info" value="Login" style="background-color: #000;">
		</center>
	</form>
</div>