<style>
	#col_1 {
		width: 20%;
		float: left;
	}
	#chart:hover {
		-webkit-box-shadow: 0 8px 6px -6px black;
		-moz-box-shadow: 0 8px 6px -6px black;
		box-shadow: 0 8px 6px -6px black;
	}
</style>
<!-- breadcrumbs -->
<ul class="breadcrumb">
	<?php
		foreach ($breadcrumbs as $key => $value) {
	?>
		<li class="<?php echo $value["class"];?>">
			<?php
			 	if($key==0){
			?>
			<i class="ace-icon fa fa-home home-icon"></i>
			<?php
				}
			?>
			<a href="<?php echo $value["link"]?>"><?php echo $value["title"]?></a>
		</li>
	<?php
		}
	?>
</ul>
<!-- breadcrumbs -->

<div class="ui purple segment">
	<div class="ui stacked segment" style="clear:both;">
		<h2>Selection Filter</h2>

	</div>

	<div class="ui stacked segment" style="clear:both;">
		<h2>Date Filter</h2>
	</div>
</div>

<div class="ui blue segment">
	<h2>Summaries/Charts</h2>
	<div class="ui accordion" style="width:100%;">
		<div class="title">
			<i class="dropdown icon"></i>
			General Overview
		</div>
		<div class="content">
			<!-- Charts for general over view begin -->
			<div class="ui three column grid">
				<div class="column" id="chart">
					<div class="ui segment">
						<h5 class="ui inverted blue block header">
						<center>
							Testing Trends
						</center></h5>

					</div>
				</div>
				<div class="column" id="chart">
					<div class="ui segment">
						<h5 class="ui inverted blue block header">
						<center>
							Critical Level (CD4)
						</center></h5>
					</div>
				</div>
				<div class="column" id="chart">
					<div class="ui segment">
						<h5 class="ui inverted blue block header">
						<center>
							Yearly CD4 Tests
						</center></h5>
					</div>
				</div>
			</div>
			<div class="ui two column grid">
				<div class="column" id="chart">
					<div class="ui segment">
						<h5 class="ui inverted blue block header">
						<center>
							CD4 Equipment (TABLE)
						</center></h5>
					</div>
				</div>
				<div class="column" id="chart">
					<div class="ui segment">
						<h5 class="ui inverted blue block header">
						<center>
							CD4 Equipment (Chart)
						</center></h5>
					</div>
				</div>
			</div>
			<div class="ui two column grid">
				<div class="column" id="chart">
					<div class="ui segment">
						<h5 class="ui inverted blue block header">
						<center>
							Equipment & CD4 Tests (TABLE)
						</center></h5>
					</div>
				</div>
				<div class="column" id="chart">
					<div class="ui segment">
						<h5 class="ui inverted blue block header">
						<center>
							CD4 Equipment (Chart)
						</center></h5>
					</div>
				</div>
			</div>
			<div class="column" id="chart">
				<div class="ui segment">
					<h5 class="ui inverted blue block header">
					<center>
						CD4 Tests For This Year(TABLE)
					</center></h5>
				</div>
			</div>
			<!-- Charts for general overview end-->
		</div>

		<div class="title" style="clear:both;">
			<i class="dropdown icon"></i>
			PIMA
		</div>
		<div class="content">
			<!-- PIMA content-->
			<div class="accordion" style="width:100%;">
				<div class="title">
					<i class="dropdown icon"></i>
					PIMA Tests
				</div>
				<div class="content">
					<!-- PIMA TEST charst begin-->
					<div class="ui two column grid">
						<div class="column" id="chart">
							<div class="ui segment">
								<h5 class="ui inverted blue block header">
								<center>
									PIMA Testing Trends
								</center></h5>
							</div>
						</div>
						<div class="column" id="chart">
							<div class="ui segment">
								<h5 class="ui inverted blue block header">
								<center>
									Tests VS Errors
								</center></h5>
							</div>
						</div>
					</div>

					<div class="ui two column grid">
						<div class="column" id="chart">
							<div class="ui segment">
								<h5 class="ui inverted blue block header">
								<center>
									PIMA Test Statistics For (YEAR)
								</center></h5>
							</div>
						</div>
						<div class="column" id="chart">
							<div class="ui segment">
								<h5 class="ui inverted blue block header">
								<center>
									Yearly PIMA Cd4 Tests
								</center></h5>
							</div>
						</div>
					</div>
					<!-- PIMA TEST charst end-->
				</div>
				<div class="title">
					<i class="dropdown icon"></i>
					PIMA Devices
				</div>
				<div class="content">
					<!-- PIMA Devices charts begin-->
					<div class="ui two column grid">
						<div class="column" id="chart">
							<div class="ui segment">
								<h5 class="ui inverted blue block header">
								<center>
									Expected Repoting Devices (PIMA) (GRAPH)
								</center></h5>
							</div>
						</div>
						<div class="column" id="chart">
							<div class="ui segment">
								<h5 class="ui inverted blue block header">
								<center>
									Expected Reporting Devices (PIMA)(CHART)
								</center></h5>
							</div>
						</div>
					</div>
					<!-- PIMA Devices charts end-->
				</div>
				<div class="title">
					<i class="dropdown icon"></i>
					PIMA Errors
				</div>
				<div class="content">
					<!-- PIMA Errors charts begin-->
					<div class="ui two column grid">
						<div class="column" id="chart">
							<div class="ui segment">
								<h5 class="ui inverted blue block header">
								<center>
									Error Trends (GRAPH)
								</center></h5>
							</div>
						</div>
						<div class="column" id="chart">
							<div class="ui segment">
								<h5 class="ui inverted blue block header">
								<center>
									PIMA Erros (CHART)
								</center></h5>
							</div>
						</div>
					</div>

					<div class="ui two column grid">
						<div class="column" id="chart">
							<div class="ui segment">
								<h5 class="ui inverted blue block header">
								<center>
									Error Details
								</center></h5>
							</div>
						</div>
						<div class="column" id="chart">
							<div class="ui segment">
								<h5 class="ui inverted blue block header">
								<center>
									Errors Encountered (CHART)
								</center></h5>
							</div>
						</div>
					</div>
					<div class="column" id="chart">
						<div class="ui segment">
							<h5 class="ui inverted blue block header">
							<center>
								PIMA Errors (Bar Graph)
							</center></h5>
						</div>
					</div>
					<!-- PIMA Errors charts end-->
				</div>
				<div class="title">
					<i class="dropdown icon"></i>
					PIMA Controls
				</div>
				<div class="content">
					<!-- PIMA controls charts begin-->
					<div class="ui two column grid">
						<div class="column" style="width: 100%;">
							<h5>Date Filter</h5>
							<div class="column">
								<a class="ui blue button" style="float: right;">Refresh</a>
							</div>
						</div>
						<hr/>
						<div class="column" id="chart" style="clear:both;">
							<div class="ui segment">
								<h5 class="ui inverted blue block header">
								<center>
									Successful vs Failed Controls (LINE GRAPH)
								</center></h5>
							</div>
						</div>
						<div class="column" id="chart">
							<div class="ui segment">
								<h5 class="ui inverted blue block header">
									<center>
										Failed vs Successful Controls (PIE CHART)
									</center>
								</h5>
							</div>
						</div>
					</div>
					<div class="ui two column grid">
						<div class="column" id="chart" style="clear:both;">
							<div class="ui segment">
								<h5 class="ui inverted blue block header">
									<center>
										Tests vs Controls (PIE CHART)
									</center>
								</h5>
							</div>
						</div>
						<div class="column" id="chart">
							<div class="ui segment">
								<h5 class="ui inverted blue block header">
									<center>
										Correct Against Errors (PIE CHART)
									</center>
								</h5>
							</div>
						</div>
					</div>
					<!-- PIMA controls charts end-->
				</div>
			</div>
			<!-- PIMA content-->
		</div>
	</div>
</div>

