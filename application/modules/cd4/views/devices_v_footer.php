<script>
$( document ).ready(function() {

	$('#uploads_table').dataTable({
		//"bProcessing": true,
		"iDisplayLength": 5,
		"bJQueryUI":true,
		"bSort":false,
		"bPaginate":true,
		"bLengthChange": false,
		"bJQueryUI":true, 
		//"sAjaxSource": "<?php echo base_url('poc/upload/ss_dt_upload_data'); ?>" ,
		"aoColumnDefs": [
		{ "bSortable": false, "aTargets": [ 0 ] }
		],
		"aaSorting": [[1, 'asc']]

	});
	
	// $('#view_device').click(function(){
		// $('.large.modal').modal('show');
	// });	
});
</script>