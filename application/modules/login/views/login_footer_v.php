<script>
$(document).ready(function(){
	$("#register_widget").hide();
	$("#forgot_pass").hide();
	$("#change_pass_widget").hide();
	
	$("#register_l").click(function(){
		$("#login_widget").fadeOut(1000, function(){
	    	$("#register_widget").fadeIn(2000);
		});
  	});
  	$("#change_pass_l").click(function(){
  		$("#login_widget").fadeOut(1000, function(){
  			$("#change_pass_widget").fadeIn(1000);
  		});
  	})
  	
  	
  	$("#login_r").click(function(){
  		$("#register_widget").fadeOut(1000, function(){
  			$("#login_widget").fadeIn(1000);
  		});
  	});
  	$("#change_pass_r").click(function(){
  		$("#register_widget").fadeOut(1000, function(){
  			$("#change_pass_widget").fadeIn(1000);
  		})
  	}); 
  	
  	$("#login_cp").click(function(){
  		$("#change_pass_widget").fadeOut(1000, function(){
  			$("#login_widget").fadeIn(1000);
  		})
  	})
  	$("#register_cp").click(function(){
  		$("#change_pass_widget").fadeOut(1000, function(){
  			$("#register_widget").fadeIn(1000);
  		})
  	})
  	
//login form  	
  	$("#login_form").submit(function(e){
  		 e.preventDefault(); 	
  		 var form_data = $('#login_form').serializeArray();
  		 $.ajax({
			url:"<?php echo base_url()?>/login/login/login_func",
			type: 'POST',
			data:form_data,
			success:function(success){
	    		 $("#alert-l").html(success);
	    		// console.log("done",success);
  			}
  		});
  	});
//login form  
  	
  //register form
  	$("#register_form").submit(function(e){
		e.preventDefault();
  		var form_data = $('#register_form').serializeArray();
  	
		$.ajax({
			url:"<?php echo base_url()?>/login/login/register_user",
			type: 'POST',
			data:form_data,
			success:function(success){
	    		 $("#alert-r").html(success);
	    		// console.log("done",success);
  			}
  		});
	});
	//register form
	
//forgot password form
	$("#forgot_pass_form").submit(function(e){
		e.preventDefault();
		var form_data = $('#forgot_pass_form').serializeArray();
		
		
		$.ajax({
			url:"<?php echo base_url()?>/login/login/send_verification",
			type: 'POST',
			data:form_data,
			success:function(success){
	    		 //$("#alert-f").html(success);
	    		 console.log("done",success);
  			}
  		});
	});

		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
  	
  	
  	
  	
  	 	
});
	
</script>