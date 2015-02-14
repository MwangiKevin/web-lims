<div class="ui menu">
  <a class="item launch-menu" >    
    <i class="reorder icon"></i>
  </a>
  <div class="right menu">
    <a class="active item">
      <i class="fa-home icon"></i> Home
    </a>
    <a class="item">
      <i class="mail icon"></i> Notifications
    </a>
    <a class="item">
      <i class="fa-key icon"></i> Messages
    </a>
  </div>
</div>

<script>
$(".launch-menu").click(function(){

  $(".sidemenu").toggle(function(){

    if($('.sidemenu').is(':visible')) {
     $("#main").removeClass("col-md-12");
     $("#main").addClass("col-md-10");
   }else{    
     $("#main").removeClass("col-md-10");
     $("#main").addClass("col-md-12");
   }
 });  
})


</script>