  <style>
	.bg-primary{
		background-color:#333333;
	}
	.dropdown-item{
		height:50px;
	}
	.dropdown-item.dropTop{
		height:40px;
	}
  </style>
  <style>
	.btn.form-control:hover{
		background-color:transparent;
	}
	.btn.form-control:focus{
		background-color:transparent;
	}
	.btn.form-control:active{
		background-color:transparent;
	}
	</style>
  <body class="index-page sidebar-collapse">
  	<!-- NAVBAR -->
  	<nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent" color-on-scroll="600">

		<div class="container">
			<div class="navbar-translate" style="background-color:transparent;color:#fff" >
<?php if(!empty($_SESSION['avPath'])){?><img class="nav-item rounded-circle" style="max-height:50px;max-width:50px,border-radius:50px" src="<?php echo $_SESSION['avPath'];?>" ><?php }?>
				<a class="navbar-brand" href="index.php?page=lobby" rel="tooltip" title="" data-placement="bottom" target="_self">
					<!--<img src="V/_template/assets/img/logo.png" height="50px" width="75px">-->
				</a>
					<?php if(isset($actualDate)){ echo $actualDate;} ?>
					<?php if(isset($time)){ echo $time;} ?>
				<button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
			   		<span class="navbar-toggler-bar top-bar"></span>
					<span class="navbar-toggler-bar middle-bar"></span>
					<span class="navbar-toggler-bar bottom-bar"></span>
			 	</button>
			</div>

		    <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="V/_template/assets/img/blurred-image-1.jpg">
				<ul class="navbar-nav">
					<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown">
							<i class="now-ui-icons design_bullet-list-67"></i>
							<p>Agenda</p>
						</a>
						  
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1">
							<form action="index.php?page=apps" method="POST">
								<button type="submit" class="dropdown-item" name="choice" value="todayApps">
									Aujourdh'ui
								</button>
							</form>
							<div class="dropdown-divider"></div>
							<form action="index.php?page=apps" method="POST">
								<button type="submit" class="dropdown-item" name="choice" value="weekApps">
									Évènements de la semaine
								</button>
							</form>
							<div class="dropdown-divider"></div>
							<form action="index.php?page=calendar" method="POST">
								<button type="submit" class="dropdown-item">
									Calendrier
								</button>
							</form>
					</div>
					</li>
	        		<li class="nav-item dropdown" data-toggle="tooltip" data-placement="bottom" title="Prise de rendez-vous rapide"> 
					<a class="nav-link" data-toggle="modal" data-target="#loginModal" style="cursor:pointer"> 
							<i class="now-ui-icons ui-1_simple-add" style="font-size:16px"  ></i>Rendez-vous 
							</a>
					</li>
					<li class="nav-item dropdown" data-toggle="tooltip" data-placement="bottom" title="Lise de mes patients, fiches consultations" >
					<a class="nav-link" href="index.php?page=patients" style="cursor:pointer"> 
					<i class="now-ui-icons users_single-02"></i>Mes patients
							</a>
					</li>
					<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown">
							<i class="now-ui-icons ui-1_settings-gear-63"></i>
							<p>Mon Compte</p>
						</a>
	          			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1" style="overflow:hidden;margin-top:15px">
							<form action="index.php?page=account" method="POST" style="margin-top:-13px;margin-bottom:-9px">
								<button type="submit" class="dropdown-item" name="mod" value="11" style="height:50px">
								<i class="now-ui-icons business_badge" style="margin-top:-13px;margin-bottom:-9px;margin-left:-13px;font-size:16px"></i>Modifier mes informations
								</button>
							</form>
							<div class="dropdown-divider"></div>
							<form action="index.php?page=account" method="POST"style="margin-top:-9px;margin-bottom:-9px">
								<button type="submit" class="dropdown-item" name="handleWork" value="1">
								<i class="now-ui-icons education_agenda-bookmark" style="margin-top:-13px;margin-bottom:-9px;margin-left:-13px;font-size:16px"></i>Gestion pro
								</button>
							</form>
							<div class="dropdown-divider"></div>
							<form action="index.php?page=logout" method="POST"style="margin-top:-9px;margin-bottom:-9px">
								<button type="submit" class="dropdown-item" name="choice" value="handlePlats">
								<i class="now-ui-icons media-1_button-power" style="margin-top:-13px;margin-bottom:-9px;margin-left:-13px;font-size:16px"></i>Déconnexion
								</button>
							</form>
							
						</div>
					</li>
					<form class="form-inline ml-auto" data-background-color action="index.php?page=browse" method="POST">
		                <div class="input-group" style="height:50px;top:-15px">
		                	<div class="input-group-prepend" style="max-height:40px;position:relative;top:10px">
		                    	<span class="input-group-text"><i class="now-ui-icons ui-1_zoom-bold"></i></span>
		                	</div>
		                	<button  class="btn form-control"  placeholder="Rechercher">Outil de recherche</button>
		                </div>
		            </form>
				</ul>
		    </div>
		</div>
	</nav>
	