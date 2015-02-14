<div class="sidemenu" >
	<div class="ui vertical menu min " style="width: 13rem;">
		<div class="item">
			<div class="ui input">
				<input type="text" placeholder="Search...">
			</div>
		</div>
		<div class="item">
			<i class="home icon"></i> Home
		</div>
		<div class="item">
			<div class="ui accordion">
				<div class="title">
					<i class="dropdown icon"></i>
					EID<i style="float:right;" class="fa-flask icon"></i>
				</div>
				<div class="content">
					Dashboard
				</div>
				<div class="title">
					<i class="dropdown icon"></i>
					Viral Load<i style="float:right;" class="fa-flask icon"></i>
				</div>
				<div class="content">
					Dashboard
				</div>
				<!-- cd4 menu-->
				<?php
					if($menu1 == "cd4"){						
				?>
					<div class="title active">
				<?php
					}else{
				?>
					<div class="title">
				<?php
					} 
				?>
					<i class="dropdown icon"></i>
					CD4<i style="float:right;" class="fa-flask icon"></i>
				</div>
				<?php
					if($menu1 == "cd4"){
				?>
					<div class="content active">
				<?php 
					}else{
				?>
					<div class="content">
				<?php
					}
				?>
					<div class="ui accordion">
						<!-- dashboard-->
						<?php
							if($cd4_menu == "dashboard"){
						?>
							<div class="title active">
						<?php
						}else{
						?>
							<div class="title">
						<?php 
							}
						?>
							<a href="<?php echo base_url()?>cd4/dashboard" class="item"> Dashboard </a>
						</div>
						<!-- dashboard-->
						
						<!-- Tests -->
						<?php 
							if($cd4_menu == "tests"){
						?>
							<div class="title active">
						<?php
							}else{
						?>
							<div class="title">
						<?php
							}
						?>
							<a href="<?php echo base_url()?>cd4/tests" class="item"> Tests </a>
						</div>
						<!-- Tests -->
						
						<!-- Devices-->
						<?php 
							if($cd4_menu == "devices"){
						?>
							<div class="title active">
						<?php 
						}else{
						?>
							<div class="title">	
						<?php
							}
						?>
							<a href="<?php echo base_url()?>cd4/devices" class="item"> Devices </a>
						</div>
						<!-- Devices-->
						
						<!-- PIMA-->
						<?php 
							if($cd4_menu == "pima"){
						?>
							<div class="title active">
						<?php 
						}else{
						?>
							<div class="title">	
						<?php
							}
						?>
							<a href="<?php echo base_url()?>cd4/pima" class="item"> PIMA </a>
						</div>
						<!-- PIMA-->
						
					</div>
				</div>
			</div>
			<!-- cd4 menu-->
		</div>
		<?php
			if($menu1 == "facility"){
		?>
			<div class="item active">
		<?php
			}else{
		?>		
			<div class="item">
		<?php
			}
		?>
			<i class="fa-hospital-o icon"></i> 
			<a href="<?php echo base_url('facilities/facilities'); ?>" style="text-decoration: none;"> Facilities</a>
		</div>
		<div class="item">
			<i class=" fa-file-text-o icon"></i> CDRR
		</div>
		<div class="item">
			<i class="fa-files-o icon"></i> Reports
		</div>
		<div class="ui  item">
			<div class="ui dropdown fluid selection">
				More <i class="dropdown icon"></i>
				<div class="menu">
					<a class="item"><i class="edit icon"></i> Edit Profile</a>
					<a class="item"><i class="globe icon"></i> Choose Language</a>
					<a class="item"><i class="settings icon"></i> Account Settings</a>
				</div>
			</div>
		</div>
	</div>
</div>

