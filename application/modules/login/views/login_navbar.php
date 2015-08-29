<div class="computer tablet only row">
  <div class="ui inverted fixed menu navbar page grid main-navbar pointing">
    <a href="" class="item down" style="width:50px">
      <div ng-activity-indicator="CircledWhite"></div>
    </a>
    <a href="#dashboard" class="brand item"><big>CD4 LIMS</big></a>
    <div class="right menu">
      <a href="" class="active item"> 
        <center>
          <span class="user-info">
            <i class="fa fa-calendar fa-sm"></i>
            <b><?php echo '   '.Date("F d Y, l")?></b>          
          </span>
        </center>
      </a>
    </div>
  </div>
</div>

<div class="mobile only row">
  <div class="ui inverted navbar menu">
    <a href="#dashboard" class="brand item"><big>CD4 LIMS</big></a>
    <a href="" class="item down" style="width:50px">
      <div ng-activity-indicator="CircledWhite"></div>
    </a>
    <div class="right menu open">
      <a href="" class="inverted item" >
        <i class="icon list"></i>
      </a>
    </div>
  </div>
  </div>
</div>

<style>
.ai-circled{
  height: 19px !important;
  width: 19px !important;
}
</style>

<script>
$(document).ready(function(){
  $('.ui.vertical.menu.top').toggle();
  $('.right.menu.open').on("click",function(e){
    e.preventDefault();
    $('.ui.vertical.menu.top').toggle();
  });
  $('.ui.dropdown').dropdown();
});
</script>
