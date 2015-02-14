<style>
	label {
		padding: 2%;
	}
</style>
<!-- breadcrumbs -->
<ul class="breadcrumb">
	<?php
		foreach ($breadcrumbs as $key => $value) {
	?>
		<li class="<?php echo $value["class"]; ?>">
			<?php
			 	if($key==0){
			?>
			<i class="ace-icon fa fa-home home-icon"></i>
			<?php
			}
			?>
			<a href="<?php echo $value["link"]?>"><?php echo $value["title"]?></a>
		</li>
	<?php
	}
	?>
</ul>
<!-- breadcrumbs -->

<div class="ui purple segment" style="overflow-x: hidden;">
	<h4 class="ui inverted purple block header" style="margin-bottom: 0%;">
		<center>
			Facility
		</center>		
	</h4>
	
	<div class="two column doubling ui grid">
		<div class="column">
			<center>
				<h3 class="ui purple header" style="font-size: 100%;">
					Details
				</h3>
			</center>
			<div class="ui segment">
				<div class="ui input">
					<label>Name</label>
					<input placeholder="Facility name" type="text">
					<label>District </label>
					<input placeholder="District" type="text">
					<label>Partner </label>
					<input placeholder="Partner" type="text">
					<label>E-mail </label>
					<input placeholder="E-mail" type="text">
					<label>Phone</label>
					<input placeholder="Phone" type="text">
				</div>
			</div>
		</div>
		
		<div class="column">
			<center>
				<h3 class="ui purple header" style="font-size: 100%;">
					Facility Control Panel
				</h3>
			</center>
			<div class="ui segment">
				<center>
					<h3 class="ui purple header" style="font-size: 100%; padding-bottom: 0px;">
						Actions
					</h3>
					
					<div class="ui basic button" style="padding-bottom:5%;">
					<i class="icon user"></i>
					Rollout
				</div>
				<div class="ui basic button" style="padding-bottom:5%;">
					<i class="icon user"></i>
					Unenroll
				</div>
				<div class="ui basic button" id="register_facility"  style="padding-bottom:5%;">
					<i class="icon user"></i>
					Register
				</div>
				</center>
			</div>
			<div class="ui segment">
				<center>
					<h3 class="ui purple header" style="font-size: 100%;">
						CD4 devices currently in use
					</h3>
				</center>
				<table class="ui table segment">
				  <thead>
				    <tr>
				    	<th></th>
				    	<th>Name</th>
				    	<th>Status</th>
				  	</tr>
				  </thead>
				  <tbody>
				    <tr>
				    	<td>1</td>
				      <td>ALERE PIMA</td>
				      <td>Approved</td>
				    </tr>
				    <tr>
				    	<td>2</td>
				      <td>FAC</td>
				      <td>Approved</td>
				    </tr>
				    <tr>
				    	<td>3</td>
				      <td>DBS Conventional</td>
				      <td>Denied</td>
				    </tr>
				  </tbody>
				</table>
			</div>
			<div class="ui segment">
				<center>
					<h3 class="ui purple header" style="font-size: 100%;">
						Active Users
					</h3>
				</center>
				<table class="ui table segment">
				  <thead>
				    <tr>
				    	<th></th>
				    	<th>Name</th>
				    	<th>Status</th>
				  	</tr>
				  </thead>
				  <tbody>
				    <tr>
				    	<td>1</td>
				      <td>John</td>
				      <td>Approved</td>
				    </tr>
				    <tr>
				    	<td>2</td>
				      <td>Jamie</td>
				      <td>Approved</td>
				    </tr>
				    <tr>
				    	<td>3</td>
				      <td>Jill</td>
				      <td>Denied</td>
				    </tr>
				  </tbody>
				</table>
			</div>
			
		</div>
	</div>
</div>


<!-- register facility modal -->
<div class="ui large modal" style="height: 90%; width: 70%;">
	<div class="ui blue segment" style="width:90%; margin-left: 5%; margin-top: 2%;">
		<h4 class="ui inverted blue block header">
			<center>
				Register a new facility
			</center>
		</h4>
		<form>
			<div class="ui segment">
				<div class="ui input">
					<label>District</label>
					<input placeholder="District" id="district" name="district" type="text">
					<label>Partner</label>
					<input placeholder="Partner" id="partner" name="partner" type="text">
					<label>Facility</label>
					<input placeholder="Facility" id="facility" name="facility" type="text">
					<label>E-mail</label>
					<input placeholder="E-mail" id="email" name="email" type="text">
					<label>Phone No.</label>
					<input placeholder="Contact" id="phone_no" name="phone_no" type="text">
				</div>
				<a class="ui blue button" style="padding-bottom: 4%; margin-top: 2%;">Blue Button</a>
			</div>
		</form>
	</div>
</div>
<!-- register facility modal -->
<?php $this -> load -> view("view_facilities_v_footer"); ?>




	