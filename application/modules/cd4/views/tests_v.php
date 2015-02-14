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
	
	<li style="float: right">
		<a href="<?php echo base_url('cd4/tests/pima_tests') ?>">PIMA Tests Only</a>
	</li>
</ul>
<!-- breadcrumbs -->

<div class="ui purple segment">
	<div class="ui stacked segment" style="clear:both;">
		<h2>Date Filter</h2>
	</div>
</div>
<div class="ui teal segment">
	<hr/>
	<table id="tests_table">
		<thead>
			<tr>
				<th rowspan = "2" >#</th>
				<th rowspan = "1" colspan= "2" style="width:27%">
				<center>
					Dates
				</center></th>
				<th rowspan = "2" ># Facilities Reported</th>
				<th rowspan = "2" style="font-size: 1.0em;color: #2d6ca2;" ># of total tests</th>
				<th rowspan = "2" style="font-size: 1.0em;color: #2aabd2;" ># of valid tests</th>
				<th rowspan = "2" style="font-size: 1.0em;color: #3e8f3e; width:15%;"># of tests &gt= 350 cells/mm3 </th>
				<th rowspan = "2" style="font-size: 1.0em;color: #eb9316; width:15%;"># of tests &lt 350 cells/mm3</th>
				<th rowspan = "2" style="font-size: 1.0em;color: #c12e2a;" ># of errors</th>
			</tr>
			<tr>
				<th>From </th>
				<th> To </th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>
<?php $this->load->view("tests_v_footer");?>