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
	<!-- <table id="test_table" class="display" cellspacing="0" width="1">
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
	</table> -->
	<table class="table table-bordered" id="tests_table" width="100%">
						<thead>
								<tr>
									
						            <th style="text-align: center" >Test ID</th>
						            <th style="text-align: center" >Patient ID</th>
						            <th style="text-align: center" >Facility</th>
						            <th style="text-align: center" >CD4 Count</th>
						           
						         </tr>
							</thead>
							<tbody>
								
									       
						<tr class="odd gradeX">
						 
						
						<td style="text-align: center"> </td>
						<td style="text-align: center"> </td>
						<td style="text-align: center"> </td>
						<td style="text-align: center">  </td>
						 
						 </tr>
						            
						
						      
						         
								
							</tbody>
						</table>
</body>
<script type="text/javascript">

$(document).ready(function(){
	// $('#example').dataTable( {
	// 	"processing":true,
	// 	"serverSide":true,
	// 	"sAjaxSource" : "tests/test_unparametized",
	// 	"oLanguage": {
	// 		"sLengthMenu": "Page length: _MENU_",
	// 		"sSearch": "Filter",
	// 		"sZeroRecords":"No records found"
	// 	} 
	// });

$("#tests_table").dataTable( {
"bProcessing": true,
"bServerSide": true,
'sAjaxSource': '<?php echo base_url();?>tests/get_sql',
"fnServerData": function ( sSource, aoData, fnCallback ) {
    $.ajax( {
        "dataType": 'json',
        "type": 'POST',
        "url": sSource,
        "data": aoData,
        "success": fnCallback
    } );
},
"bLengthChange": false,
"aaSorting": [[ 0, "asc" ]],
"iDisplayLength": 15,
"sPaginationType": "full_numbers",
"bAutoWidth": false,
"aoColumnDefs": [ 
    { "sName": "id", "aTargets": [ 0 ] },
    { "sName": "patient_id", "aTargets": [ 1 ] },
    { "sName": "name", "aTargets": [ 2 ] },
    { "sName": "cd4_count", "sWidth": "80px", "aTargets": [ 3 ] },
    { "sName": "cellphone", "sWidth": "100px", "aTargets": [ 4 ] },
    { "sName": "created", "sWidth": "120px", "aTargets": [ 5 ] },
    { "bSortable": false, "sName": "edit", "sWidth": "115px", "aTargets": [ 6 ] }
]
});

});
</script>

 
	
</div>
</html>