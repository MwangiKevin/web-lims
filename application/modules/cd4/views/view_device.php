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
	
	<li style="float:right; list-style: none; text-decoration: none;">
		<a href="<?php echo base_url('cd4/devices/register')?>">Register Device</a>
	</li>
</ul>
<!-- breadcrumbs -->

<div class="ui purple segment">
	<h1>View Device (Device Name)</h1>
	<div class="three column doubling ui grid">
		<div class="column">
			<div class="ui segment">
				<div class="field">
					<center><label>Equipment</label></center>
					<div class="ui fluid selection dropdown">
						<input type="hidden" name="gender">
						<div class="default text">
							Equipment
						</div>
						<i class="dropdown icon"></i>
						<div class="menu ui transition hidden">
							<div class="item" data-value="1">
								Equipment 1
							</div>
							<div class="item" data-value="0">
								Equipment 2
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="column">
			<div class="ui segment">
				<div class="field">
				<center><label>Facility</label></center>
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

			</div>
		</div>
		<div class="column">
			<div class="ui segment">
				<div class="field">
					<center><label>Equipment Serial</label></center>
					<div class="ui fluid selection dropdown">
						<input type="hidden" name="gender">
						<div class="default text">
							Equipment Serial
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
			</div>
		</div>
	</div>
	<div class="two column doubling ui grid">
		<div class="column">
				<center>
					<h4 class="ui inverted purple block header">
						Actions
					</h4>
					<div class="ui segment">
						<div class="ui basic button" style="padding-bottom: 10%; padding-left: 0px; width: 45%;">
							<i class="icon user"></i>
						  	Move to Another Facility
						</div>
						<div class="ui basic button" style="padding-bottom: 10%; padding-left: 0px;  width: 45%;">
							<i class="icon user"></i>
						  	Mark as Active
						</div>
						<div class="ui basic button" style="padding-bottom: 10%; padding-left: 0px;  width: 45%;">
							<i class="icon user"></i>
						  	Mark as disfunctional
						</div>
						<div class="ui basic button" style="padding-bottom: 10%; padding-left: 0px;  width: 45%;">
							<i class="icon user"></i>
						  	Mark as Obsolete
						</div>
					</div>
				</center>
		</div>
		<div class="column" >
			<center>
				<h4 class="ui inverted purple block header">
					Status
				</h4>
				<div class="ui segment">
	  				<label style="display: inline-block;">Functional</label> 
					<input name="fun" type="radio" style="display: inline-block;">
					<label style="display: inline-block;">Disfunctional</label>
	  				<input name="fun" type="radio" style="display: inline-block;">
	  				<label>Active</label>
	  				<input name="fun" type="radio"><br/>
				</div>
			</center>
		</div>
	</div>
</div>

<div class="ui blue segment">
	<div class="two column doubling ui grid">
		<div class="column">
			<center> 
				<h4 class="ui inverted blue block header">
					History
				</h4>
			</center>
			<div class="ui segment" style="overflow-y: hidden;">
  				<p>Was moved to a different facility</p><br/>
  				<p>Was rolled out</p><br/>
  				<p>Something else happened to this device</p><br/>
			</div>
		</div>
		<div class="column" >
			<center>
				<h4 class="ui inverted blue block header">
					Facility Movement History
				</h4>	
			</center>
			<div class="ui segment">
  				<p>More interesting stuff happened here</p><br/>
  				<p>More interesting stuff happened here</p>
			</div>
		</div>
	</div>
</div>


<div class="ui teal segment">
	<table id="uploads_table" class="data-table">
		<thead>				
				<th>#</th>
				<th style="width:15%">Date Uploaded</th>
				<th style="width:15%">Device Serial number</th>
				<th>Facility</th>
				<th>Uploaded by</th>
				<th style="font-size: 1.1em;color: #2d6ca2;" ># of total tests</th>
				<th style="font-size: 1.1em;color: #2aabd2;" ># of valid tests</th>
				<th style="font-size: 1.1em;color: #3e8f3e; width:15%;"># of tests &gt= 350 cells/mm3 </th>
				<th style="font-size: 1.1em;color: #eb9316; width:15%;"># of tests &lt 350 cells/mm3</th>
				<th style="font-size: 1.1em;color: #c12e2a;" ># of errors</th>
		</thead>
		<tbody>
			<td>asd</td>
			<td>asd</td>
			<td>asd</td>
			<td>asd</td>
			<td>asd</td>
			<td>asd</td>
			<td>asd</td>
			<td>asd</td>
			<td>asd</td>
			<td>asd</td>
		</tbody>
	</table>
</div>

<?php $this -> load -> view("devices_v_footer"); ?>
