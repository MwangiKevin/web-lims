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
			Facilities
		</center>		
	</h4>
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
				<th> View </th>
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
				<a href="<?php echo base_url('facilities/facilities/view');?>" id="view_device" style="text-decoration: none;">
				<i class="search icon"></i>
				View
				</a>
			</td>
		</tbody>
	</table>
</div>

<?php $this -> load -> view("facilities_v_footer"); ?>