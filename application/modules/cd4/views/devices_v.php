<style>
	.ui.input label{
		padding:5%;
	}
</style>

<!-- breadcrumbs -->
<ul class="breadcrumb">
	<?php
		foreach ($breadcrumbs as $key => $value) {
	?>
		<li class="<?php echo $value["class"];?>">
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
	<div class="ui stacked segment" style="clear:both;">
		<h2>Date Filter</h2>
	</div>
</div>
<div class="ui blue segment">
	
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
					<th style="font-size: 1.1em;color: #c12e2a;" >View</th>
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
				<td>
					<a href="<?php echo base_url('cd4/devices/view_device');?>" id="view_device" style="text-decoration: none;">
					<i class="search icon"></i>
					View
					</a>
				</td>
			</tbody>
		</table>
</div>


<!-- View Modal-->
<div class="ui large modal" style="height: 80%;  overflow-y: hidden; overflow-x: hidden; padding:1%;">
<div class="ui two column grid">
	<h3 class="ui teal header">
		<center>
	  		Device View
	  		<i class="search icon"></i>
  		</center>
	</h3>
	<hr/>
  <div class="column" style="width:45%; margin-left: 5%;">
    <div class="ui segment">
    	<div class="ui input">
    		<label>Uploaded by</label>
	  		<input placeholder="Uploaded by" type="text" disabled="">
	  		<label># of total tests</label>
	  		<input placeholder="# of total tests" type="text" disabled="">
	  		<label># of valid tests</label>
	  		<input placeholder="# of valid tests" type="text" disabled="">
	  		<label># of errors</label>
	  		<input placeholder="device serial number" type="text" disabled="">
		</div>
    </div>
  </div>
  <div class="column" style="width: 45%;">
    <div class="ui segment">
    	<div class="ui input">
    		<label>Date Uploaded</label>
	  		<input placeholder="date uploaded" type="text" disabled="">
	  		<label>Device Serial number</label>
	  		<input placeholder="device serial number" type="text" disabled="">
	  		<label># of tests &gt= 350 cells/mm3 </label>
	  		<input placeholder="# of tests &gt= 350 cells/mm3 " type="text" disabled="">
	  		<label># of tests &lt 350 cells/mm3</label>
	  		<input placeholder="# of tests &lt 350 cells/mm3" type="text" disabled="">
		</div>  
    </div>
  </div>
</div>
</div>


<?php $this->load->view("devices_v_footer");?>