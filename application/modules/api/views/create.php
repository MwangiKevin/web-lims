<html>
    <head>
        <script type="text/javascript" src="<?php echo base_url();?>/assets/bower_components/jquery/dist/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>/assets/bower_components/jquery/dist/jquery.min.js"></script>
    </head>
    <body>
    <?php

    ?>
    <script>
    $(document).ready(function(){
    	// $.post("<?php echo base_url(); ?>api/counties", {
    	//     json_string: JSON.stringify({name:"John", phone number:"+410000000"})
    	// });
    	var dataPath = {
                facility_id : "789",
                device_id : "1",
                status : "0",
                deactivation_reason : "Disfunctional",
                date_added : "2015-04-01",
                date_removed : "0000-00-00",
                serial_number : "1232"
        };
        
        console.log(dataPath);
        $.ajax({
            url  :'<?php echo base_url(); ?>api/facility_devices/1',
            type    :'PUT',
            dataType:'jsonp',
            data    : JSON.stringify(dataPath),
            contentType:"application/json",
            success: function(data, xhr){
                alert("Sukses Menggambar Genangan");
            },
            error:function(xhr, ajaxOptions, thrownError){
                // alert(thrownError);
                 console.log(thrownError);
            }
        });
    });
    </script>
    </body>
</html>