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
<div class="ui black medium launch right attached button" >
	<a ng-click="commons.toggleMenu()">
		<i class="icon list layout right"></i>
		<span class="text right" style="display:none;">Menu</span>
	</a>
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



<div class="ui page site section group" style="margin-top:6px">
	<div class="col span_2_of_12" ng-show="commons.getMenuShowStatus()">
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
			</div>
			<div class="item">
				<div class="ui small active  inverted header">Conventional CD4</div>
				<div class="menu">


				</div>
			</div>
		</div>
	</div>

	<div class="" ng-class="commons.getDashboardAreaClass()">
		<div class="ui grid">
			<div class="sixteen wide column">
				<div class="ui segment">
					<div class="ui cards">
						<div class="card">
							<div class="content">
								<div class="header">Elliot Fu</div>
								<div class="description">
									Elliot Fu is a film-maker from New York.
								</div>
							</div>
							<div class="ui bottom attached button blue">
								<i class="add icon"></i>
								Add Friend
							</div>
						</div>
						<div class="card">
							<div class="content">
								<div class="header">Veronika Ossi</div>
								<div class="description">
									Veronika Ossi is a set designer living in New York who enjoys kittens, music, and partying.
								</div>
							</div>
							<div class="ui bottom attached button yellow">
								<i class="add icon"></i>
								Add Friend
							</div>
						</div>
						<div class="card">
							<div class="content">
								<div class="header">Jenny Hess</div>
								<div class="description">
									Jenny is a student studying Media Management at the New School
								</div>
							</div>
							<div class="ui bottom attached button green">
								<i class="add icon"></i>
								Add Friend
							</div>
						</div>
						<div class="ui card">
							<div class="content">
								<i class="right floated like icon yellow"></i>
								<i class="right floated star icon pink"></i>
								<div class="header">Cute Dog</div>
								<div class="extra content">
									<span class="like">
										<i class="like icon red"></i>
										Like
									</span>
									<span class="star">
										<i class="star icon yellow"></i>
										Favorite
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




<style>
/*  SECTIONS  */
.section {
	clear: both;
	padding: 0px;
	margin: 0px;
}

/*  COLUMN SETUP  */
.col {
	display: block;
	float:left;
	margin: 1% 0 1% 1.6%;
}
.col:first-child { margin-left: 0; }

/*  GROUPING  */
.group:before,
.group:after { content:""; display:table; }
.group:after { clear:both;}
.group { zoom:1; /* For IE 6/7 */ }
/*  GRID OF TWELVE  */
.span_12_of_12 {
	width: 100%;
}

.span_11_of_12 {
	width: 91.53%;
}
.span_10_of_12 {
	width: 83.06%;
}

.span_9_of_12 {
	width: 74.6%;
}

.span_8_of_12 {
	width: 66.13%;
}

.span_7_of_12 {
	width: 57.66%;
}

.span_6_of_12 {
	width: 49.2%;
}

.span_5_of_12 {
	width: 40.73%;
}

.span_4_of_12 {
	width: 32.26%;
}

.span_3_of_12 {
	width: 23.8%;
}

.span_2_of_12 {
	width: 15.33%;
}

.span_1_of_12 {
	width: 6.866%;
}

/*  GO FULL WIDTH BELOW 480 PIXELS */
@media only screen and (max-width: 480px) {
	.col {  margin: 1% 0 1% 0%; }

	.span_1_of_12, .span_2_of_12, .span_3_of_12, .span_4_of_12, .span_5_of_12, .span_6_of_12, .span_7_of_12, .span_8_of_12, .span_9_of_12, .span_10_of_12, .span_11_of_12, .span_12_of_12 {
		width: 100%; 
	}
}
</style>



