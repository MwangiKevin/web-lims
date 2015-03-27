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
            name          : year,
            kawasan      : areal,
            path        : pathSend,
            idGenangan  : jmlRecord
        };
        console.log(dataPath);
        $.ajax({
            url  :'<?php echo base_url(); ?>api/counties',
            type    :'POST',
            dataType:'json',
            data    : JSON.stringify(dataPath),
            contentType:"application/json",
            success: function(data, xhr){
                alert("Sukses Menggambar Genangan");
            },
            error:function(xhr, ajaxOptions, thrownError){
                alert(thrownError);
            }
        });
    });
    </script>
    </body>
</html>