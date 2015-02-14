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
			Register
		</center>		
	</h4>
	<div class="two column doubling ui grid">
		<div class="column">
			<center>
				<h3 class="ui purple header" style="font-size: 100%;">
					New CD4 Device to a facility
				</h3>
			</center>
			<div class="ui segment">
				<div class="ui input">
					<div class="field">
						<label>Equipment</label>
						<div class="ui fluid selection dropdown">
							<input type="hidden" name="gender">
							<div class="default text">
								Equipment
							</div>
							<i class="dropdown icon"></i>
							<div class="menu ui transition hidden">
								<div class="item" data-value="1">
									Equipment Serial 1
								</div>
								<div class="item" data-value="0">
									Equipment Serial 2
								</div>
							</div>
						</div>
					</div>
					<div class="field">
						<label>Facility</label>
						<div class="ui fluid selection dropdown">
							<input type="hidden" name="gender">
							<div class="default text">
								Facility
							</div>
							<i class="dropdown icon"></i>
							<div class="menu ui transition hidden">
								<div class="item" data-value="1">
									Facility 1
								</div>
								<div class="item" data-value="0">
									Facility 2
								</div>
							</div>
						</div>
					</div>
					<label>Device Serial</label>
					<input placeholder="Equipment name" type="text">
					<label>CTC ID No.</label>
					<input placeholder="Equipment name" type="text">
				</div>
			</div>
		</div>
		
		<div class="column">
			<center>
				<h3 class="ui purple header" style="font-size: 100%;">
					Register new CD4 device type
				</h3>
			</center>
			<div class="ui segment">
				<div class="ui input">
					<label>Device Description</label>
					<input placeholder="e.g Alere PIMA" type="text">
				</div>
			</div>
			
			<div class="ui segment">
				<center>
					<h3 class="ui purple header" style="font-size: 100%;">
						Description
					</h3>
					<table class="ui celled table segment">
					  <thead>
					    <tr>
					    	<th></th>
					    	<th>Description</th>
					  	</tr>
					  </thead>
					  <tbody>
					    <tr>
					      <td>1</td>
					      <td>DB Description</td>
					    </tr>
					    <tr>
					      <td>2</td>
					      <td>FACS</td>
					    </tr>
					    <tr>
					      <td>3</td>
					      <td>Parlec</td>
					    </tr>
					    <tr>
					      <td>4</td>
					      <td>PIMA</td>
					    </tr>
					  </tbody>
					</table>
				</center>
			</div>
		</div>
	</div>
</div>