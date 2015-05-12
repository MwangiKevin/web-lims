<!DOCTYPE html>
<html>
<head>
	<title>MIGRATION FORM</title>
</head>
<body>
<div>
	<form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>example/migrate_csv/uploadcsv">
		<div>
			<input type="file" name="upload" id="upload"/>
		</div>
		<div>
			<button type="submit">Save File</button>
		</div>
	</form>
</div>

</body>
</html>