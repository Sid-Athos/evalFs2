	<div class="wrapper" >
		<!-- Img -->
		<div class="page-header clear-filter" filter-color="orange">
		    <div class="page-header-image" data-parallax="true" style="background-image: url('V/_template/assets/img/header.jpg'); transform: translate3d(0px, 33.666666666666664px, 0px);">
		    </div>
	    	<div class="container">
	    		<?php if(isset($message)){ echo $message; }?>
			  	<div class="row">
			    	<div class="col-sm" style="text-align:left;margin-top:5%;margin-right:10%">
			            <h1 class="h1-seo">Loin des yeux près de l'écran.</h1>
			            <h3>Aujourd'hui Glance vous propose "Nom" du mec le plus populaires.</h3>
			            <h6 style="word-break:break-word">Description du salon blalbalbalblablablbalbalbalalbalbalbalblablablbalbalablbalbalbabalblbalbabalbalbalblabalblblablablablablablablbalbalbabalbalbalbalblablablablablablablab</h6>
			    	</div>
			    	<div class="col-sm" id="player" style="text-align:left;margin-top:5%;">
			    		<h2>Nom du Saloun du keumé</h2>
			    		<img src="V/_template/assets/img/ryan.jpg" alt="Salon le plus populaires" width="640px" height="340px">
			    	</div>
			  	</div>
		    </div>
		</div>
		<!-- Platoons -->
		<div class="main">
			<div class="section" id="basic-elements" style="padding:30px" data-background-color="black">
				<h2>Les Populaires</h2>
				<div style="height:250px;overflow:auto;white-space:nowrap;overflow-y:hidden;width:auto;">
					<div class="card" style="width:270px;box-shadow:none" data-background-color="black">
					  	<div class="card-title" style="height:15px">
					    	<h4 style="color:#fa825b;">Sid Room</h4>
					  	</div>
						<form action="V/_template/chat.php" method="POST" style="">
							<button type="submit" style="background-image:url('V/_template/assets/img/ryan.jpg');width:270px;height:130px;background-size:270px 130px;background-repeat:no-repeat;border:2px outset black" name="Sid Room" value="1">
							</button>
						</form>
					</div>
					<div class="card" style="width:270px;" data-background-color="black">
					  	<div class="card-title" style="height:15px">
					    	<h4 style="color:#fa825b;">Nom du Salon</h4>
					  	</div>
					  	<img class="card-img-bottom" src="V/_template/assets/img/ryan.jpg" alt="Card image cap" style="width:270px;height:130px;">
					</div>
				</div>
			</div>
			<div class="section" id="basic-elements" style="padding:30px" data-background-color="black">
				<?php
				if ($subP != false) 
				{
					?>
					<h2>Mes Préférences</h2>
					<div style="height:200px;overflow:auto;border:none;white-space:nowrap;overflow-y:hidden;width:auto;">
						<?php
						//var_dump($subP);
						for ($i=0; $i < count($subP); $i++) 
						{ 
							?>
							<div class="card" style="width:270px;box-shadow: none;" data-background-color="black">
							  	<div class="card-title" style="height:15px">
							    	<h4 style="color:#fa825b;"><?php echo $subP[$i]['name']; ?></h4>
							  	</div>
								<form action="#" method="POST" style="">
									<button type="submit" style="background-image:url('V/_template/assets/img/ryan.jpg');width:270px;height:130px;background-size:270px 130px;background-repeat:no-repeat;border:2px outset black;box-shadow: 5px 3px 6px black;" name="platoon" value="<?php echo $subP[$i]['ID']; ?>">
									</button>
								</form>
							</div>
							<?php
						}
						?>
					</div>
					<?php
				}
				else
				{
					?>
					<h2>Vous n'avez pas encore de Préférences.</h2>
					<div style="height:200px;overflow:auto;border:none;white-space:nowrap;overflow-y:hidden;width:auto;">
					<?php
				}
				?>
			</div>
			<div class="section" id="basic-elements" style="padding:30px" data-background-color="black">
				<h2>Catégorie 1</h2>
				<div style="height:200px;overflow:auto;border:none;white-space:nowrap;overflow-y:hidden;width:auto;">
					<div class="card" style="width:270px;" data-background-color="black">
					  	<div class="card-title" style="height:15px">
					    	<h4 style="color:#fa825b;">Nom du Salon</h4>
					  	</div>
					  	<img class="card-img-bottom" src="V/_template/assets/img/ryan.jpg" alt="Card image cap" style="width:270px;height:130px;">
					</div>
					<div class="card" style="width:270px;" data-background-color="black">
					  	<div class="card-title" style="height:15px">
					    	<h4 style="color:#fa825b;">Nom du Salon</h4>
					  	</div>
					  	<img class="card-img-bottom" src="V/_template/assets/img/ryan.jpg" alt="Card image cap" style="width:270px;height:130px;">
					</div>
				</div>
			</div>
			<div class="section" id="basic-elements" style="padding:30px" data-background-color="black">
				<h2>Catégorie 2</h2>
				<div style="height:200px;overflow:auto;border:none;white-space:nowrap;overflow-y:hidden;width:auto;">
					<div class="card" style="width:270px;" data-background-color="black">
					  	<div class="card-title" style="height:15px">
					    	<h4 style="color:#fa825b;">Nom du Salon</h4>
					  	</div>
					  	<img class="card-img-bottom" src="V/_template/assets/img/ryan.jpg" alt="Card image cap" style="width:270px;height:130px;">
					</div>
					<div class="card" style="width:270px;" data-background-color="black">
					  	<div class="card-title" style="height:15px">
					    	<h4 style="color:#fa825b;">Nom du Salon</h4>
					  	</div>
					  	<img class="card-img-bottom" src="V/_template/assets/img/ryan.jpg" alt="Card image cap" style="width:270px;height:130px;">
					</div>
				</div>
			</div>
			<div class="section" id="basic-elements" style="padding:30px" data-background-color="black">
				<?php
				if ($myP != false) 
				{
					?>
					<h2>Mes Salons</h2>
					<div style="height:200px;overflow:auto;border:none;white-space:nowrap;overflow-y:hidden;width:auto;">
						<?php
						//var_dump($myP);
						for ($i=0; $i < count($myP); $i++) 
						{ 
							?>
							<div class="card" style="width:270px;box-shadow: none;" data-background-color="black">
							  	<div class="card-title" style="height:15px">
							    	<h4 style="color:#fa825b;"><?php echo $myP[$i]['name']; ?></h4>
							  	</div>
								<form action="#" method="POST" style="">
									<button type="submit" style="background-image:url('V/_template/assets/img/ryan.jpg');width:270px;height:130px;background-size:270px 130px;background-repeat:no-repeat;border:none;cursor:pointer" name="room" value="<?php echo $myP[$i]['ID']; ?>">
									</button>
								</form>
							</div>
							<?php
						}
						?>
					</div>
					<?php
				}
				else
				{
					?>
					<h2>Vous n'avez pas encore de Salons.</h2>
					<div style="height:200px;overflow:auto;border:none;white-space:nowrap;overflow-y:hidden;width:auto;">
					<?php
				}
				?>
			</div>	
		</div>