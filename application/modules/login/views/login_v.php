<head>
	<link rel="stylesheet" href="<?php echo base_url('assets/sass_assets/stylesheets/style.css');?>">
	<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/semantic-ui/build/packaged/javascript/semantic.js');?>"></script>
	<script src="<?php echo base_url('assets/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js');?>"></script>
</head>

<script>
$(document).ready(function(){
	$("#register_widget").hide();
	$("#forgot_pass").hide();
	$("#change_pass_widget").hide();
	
	$("#register_l").click(function(){
		$("#login_widget").fadeOut(1000, function(){
	    	$("#register_widget").fadeIn(2000);
		});
  	});
  	$("#change_pass_l").click(function(){
  		$("#login_widget").fadeOut(1000, function(){
  			$("#change_pass_widget").fadeIn(1000);
  		});
  	})
  	
  	
  	$("#login_r").click(function(){
  		$("#register_widget").fadeOut(1000, function(){
  			$("#login_widget").fadeIn(1000);
  		});
  	});
  	$("#change_pass_r").click(function(){
  		$("#register_widget").fadeOut(1000, function(){
  			$("#change_pass_widget").fadeIn(1000);
  		})
  	}); 
  	
  	$("#login_cp").click(function(){
  		$("#change_pass_widget").fadeOut(1000, function(){
  			$("#login_widget").fadeIn(1000);
  		})
  	})
  	$("#register_cp").click(function(){
  		$("#change_pass_widget").fadeOut(1000, function(){
  			$("#register_widget").fadeIn(1000);
  		})
  	})
  	
  	
  	 	
});
	
</script>
<style>
	label{
		text-align: center;
	}
#login_widget	{
		-moz-box-shadow:    3px 3px 5px 6px #ccc;
	  	-webkit-box-shadow: 3px 3px 5px 6px #ccc;
	  	box-shadow:         3px 3px 5px 6px #ccc;
	}
#change_pass_widget	{
		-moz-box-shadow:    3px 3px 5px 6px #ccc;
	  	-webkit-box-shadow: 3px 3px 5px 6px #ccc;
	  	box-shadow:         3px 3px 5px 6px #ccc;
	}
#register_widget	{
		-moz-box-shadow:    3px 3px 5px 6px #ccc;
	  	-webkit-box-shadow: 3px 3px 5px 6px #ccc;
	  	box-shadow:         3px 3px 5px 6px #ccc;
	}	
#widget-footer{
	padding: 0px; 
	margin-top: 1%;
}	
#left-widget{
	width: 50%;
	float: left; 
	background-color:#CCCC99;
}
</style>


<body>
	<div class="col-md-6 head-title" style="margin-left: 10%; margin-top: 13%;">
		<h1 class="ui teal header"> WEB-LIMS</h1>
		<div class="row" style="width:100%">
			<div class="" style="width:20%;float:left;">
				<img width="" height="" style="height:100px;width:100px;" alt="" src="http://127.0.0.1/web-lims/assets/images/tz.png">
			</div>
			<div class="" style="width:60%;float:left;">
				<h5>The United Republic of Tanzania</h5>
			</div>
			<div class="" style="width:20%;float:left;">
				<img width="" height="" style="height:100px;width:105px;" alt="" src="http://127.0.0.1/web-lims/assets/images/nacp.png">
			</div>
		</div>
	</div>

<div class="ui two column grid">
	
  <div class="column" style="float: right; width: 30%; margin-top: 10%; margin-right: 8%;" id="login_widget">
    <div class="ui fluid form segment">
      <h3 class="ui header" value="login">Log-in</h3>
      	<form action="#" method="post">
      		<div class="field">
		        <label>Username</label>
		        <input placeholder="Username" type="text">
      		</div>
	      	<div class="field">
		        <label>Password</label>
		        <input type="password" placeholder="Password">
	      	</div>
      		<div class="ui blue submit button" style="padding: 2%;">Login</div>
      	</form>
      	<center>
      		<div id="widget-footer">
      			<div id="left-widget">
		      		<p id="change_pass_l"  style="padding: 0%; margin: 0%; font-size: smaller; cursor: pointer; color: #FF0000;">Forgot Password</p>
		      	</div>
		      	<div id="left-widget">
		      		<p id="register_l" style="padding: 0%; margin: 0%;font-size: smaller; cursor: pointer; color: #FF0000">Register</p>
				<div id="left-widget">		      	
	      	</div>
      	</center>      
    </div>
  </div>
  
<div class="column" style="float: right; width: 30%; margin-top: 13%; margin-right: 8%;" id="change_pass_widget">
    <div class="ui fluid form segment">
    	<form action="#" method="post">
    		<h3 class="ui header" value="login">Change Password</h3>
	      	<div class="field">
		        <label>Email Address</label>
		        <input placeholder="email" type="text">
	      	</div>
	      	<div class="ui blue submit button" style="padding: 2%;">Send</div>
      	</form>      	
      	<center>
      		<div  id="widget-footer">
      			<div id="left-widget">
      				<p id="register_cp" style="padding: 0%; margin: 0%;font-size: smaller; cursor: pointer; color: #FF0000">Register</p>	
      			</div>
      			<div id="left-widget">
      				<p id="login_cp" style="padding: 0%; margin: 0%; font-size: smaller; cursor: pointer; color: #FF0000">Login</p>
      			</div>
	      	</div>
      	</center>
    </div>
  </div>
<<<<<<< HEAD
  
=======
  <!--forgot pass form-->
  
  <!--Register form-->
>>>>>>> shohiek/feature/cd4
  <div class="column" id="register_widget" style="float:right; width: 30%;  margin-top: 10%; margin-right: 8%;">
    <div class="ui fluid form segment">
    	<form action="#" method="post">
    		<h3 class="ui header">Register</h3>
	        <div class="field">
	          <label>First Name</label>
	          <input placeholder="First Name" type="text">
	        </div>
	        <div class="field">
	          <label>Last Name</label>
	          <input placeholder="Last Name" type="text">
	        </div>
	      <div class="field">
	        <label>Username</label>
	        <input placeholder="Username" type="text">
	      </div>
	      <div class="field">
	        <label>Password</label>
	        <input placeholder="Password" type="password">
	      </div>
	      <div class="inline field">
	        <div class="ui checkbox">
	          <input id="conditions" type="checkbox">
	          <label for="conditions">I agree to the terms and conditions</label>
	        </div>
	      </div>
	      <div class="ui blue submit button" style="padding: 2%;">Submit</div>
      </form>
      	<center>
      		<div id="widget-footer">
      			<div id="left-widget">
		      		<p id="change_pass_r" style="padding: 0%; margin: 0%; font-size: smaller; cursor: pointer; color: #FF0000">Forgot Password</p>
		      	</div>
		      	<div id="left-widget">
		      		<p id="login_r" style="padding: 0%; margin: 0%;font-size: smaller; cursor: pointer; color: #FF0000">Login</p>
		      	</div>
	      	</div>
      	</center>      
      	
    </div>
  </div>
</div>
<div id="copyrights" style="position: absolute; left: 40%; right: 40%; bottom: 0%;">
	<?php echo $this->config->item("copyrights") ?>
</div>
</body>
