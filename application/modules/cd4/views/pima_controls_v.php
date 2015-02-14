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
	<li style="float:right;">
		<a href="<?php echo base_url('cd4/pima/errors'); ?>">Errors</a>&nbsp;&nbsp;
		<a href="<?php echo base_url('cd4/pima/tests'); ?>">Tests</a>
	</li>
</ul>
<!-- breadcrumbs -->

<div class="ui purple segment" style="overflow-x: hidden;">
	<div class="ui stacked segment" style="clear:both;">
		<h2>Date Filter</h2>
	</div>
</div>

<div class="ui blue segment">
	<table class="ui table segment">
		<thead>
			<tr><th>Name</th>
    <th>Status</th>
    <th>Notes</th>
  </tr></thead>
  <tbody>
    <tr>
      <td>John</td>
      <td>Approved</td>
      <td>None</td>
    </tr>
    <tr>
      <td>Jamie</td>
      <td>Approved</td>
      <td>Requires call</td>
    </tr>
    <tr>
      <td>Jill</td>
      <td>Denied</td>
      <td>None</td>
    </tr>
  </tbody>
  <tfoot>
    <tr><th colspan="3">
      <div class="ui blue labeled icon button"><i class="user icon"></i> Add User</div>
    </th>
  </tr></tfoot>
</table>
</div>