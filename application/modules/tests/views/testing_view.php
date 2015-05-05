<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- DataTables CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/bower_components/datatables/media/css/jquery.dataTables.css">
		  
		<!-- jQuery -->
		<script type="text/javascript" charset="utf8" src="<?php echo base_url();?>assets/bower_components/datatables/media/js/jquery.js"></script>
		  
		<!-- DataTables -->
		<script type="text/javascript" charset="utf8" src="<?php echo base_url();?>assets/bower_components/datatables/media/js/jquery.dataTables.js"></script>

</head>
<body>
	<table id="test_table" class="display" cellspacing="0" width="1">
		<thead>
			<tr>
				<th>Test ID</th>
				<th>Patient ID</th>
				<th>Facility Name</th>
				<th>CD4 Count</th>
			</tr>
		</thead>

		<tfoot>
			<tr>
				<th>Test ID</th>
				<th>Patient ID</th>
				<th>Facility Name</th>
				<th>CD4 Count</th>
			</tr>
		</tfoot>
		<tbody>
		
		</tbody> 
	</table>
</body>
<script type="text/javascript">
	$(document).ready(function(){
		$('#test_table').DataTable({
			// processing:true,
			serverSide: true,
		    ajax : {
		    	type: 'POST',
		    	url: '<?php echo base_url();?>tests/test_unparametized'
		    }
		    
		    // var oTable = $('#test_table').dataTable();

		   
    		
		});

		// var oTable = $('#test_table').dataTable();

		// $.ajax({
		// 	url: '<?php echo base_url();?>tests/test_unparametized',
		// 	dataType: 'json',
		// 	success: function(s){
		// 		console.log(s);
		// 		oTable.fnClearTable();
		// 		for (var i = 0; i < s.length; i++) {
		// 			oTable.fnAddData([
		// 				s[i][0],
		// 				s[i][1],
		// 				s[i][2],
		// 				s[i][3],
		// 				]);
		// 		}
		// 	},
		// 	error: function(e){
		// 		console.log(e.responseText);
		// 	}
		// });
		
	});
</script>

</html>