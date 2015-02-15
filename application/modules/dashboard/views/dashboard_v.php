<style>


@media (min-width: 300px) {
	#sidebar.affix-top {
		position: static;
		margin-top:30px;
		width:228px;
	}

	#sidebar.affix {
		position: fixed;
		top:70px;
		width:228px;
	}
}

#sidebar li.active {
	border:0 #eee solid;
	border-right-width: 4px;
	border-right-color: #428bca;
}


</style>
<!-- <div class="ui thin vertical inverted labeled icon left overlay sidebar menu" >abc</div> -->
<div class="ui black medium launch right attached button" ng-click="alert()">
	<i class="icon list layout right"></i>
	<span class="text right" style="display:none;">Menu</span>
</div>
<script>
$(".launch.button").mouseenter(function(){
	$(this).stop().animate({width: '100px'}, 300, 
		function(){$(this).find('.text').show();});
}).mouseleave(function (event){
	$(this).find('.text').hide();
	$(this).stop().animate({width: '70px'}, 300);
});
// $(".ui.overlay.sidebar").sidebar({overlay: true})
// .sidebar('attach events','.ui.launch.button');
</script>



<div class="ui vertical inverted  menu left uncover visible" id="toc">
	<div class="item active">
		<a href=""><b>Summary</b></a>
	</div>
	<a class="item" href="">
		<b>Testing Trends</b><i class="fa fa-line-chart " style="float:right"></i>
	</a>
	<a class="item" href="">
		<i class="map icon"></i> <b>Map</b>
	</a>
	<a class="item" href="/kitchen-sink.html">
		<b>FDRR Reporting </b><i class="fa fa-bar-chart " style="float:right"></i>
	</a>
	
	<div class="item">
		<div class="ui small active  inverted header">POC CD4</div>
		<div class="menu">
			<a class="item" href="">
				Button
			</a>
		</div>
	</div><div class="item">
	<div class="ui small active  inverted header">Conventional CD4</div>
	<div class="menu">


	</div>
</div>
</div>





<div class="row" style="border-color: #428bca;">

</div>
<div class="col-md-10">
	<div class="" ui-view></div>
</div>	
</div>


