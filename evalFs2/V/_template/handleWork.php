
                <div class="container">
                    <div class="row" style="margin-top:150px">               
                        <div class="col-md-6" style="margin:auto">
                <?php
		for($m = count($messages)-1;$m > -1;$m--)
		{
			echo $messages[$m];
		}
	?>
                                <form class="form" method="POST" action="index.php?page=account" id="form" style="color:white;width:350px;margin-left:15%" autocomplete="off">
                                        <?php
                                if(!empty($workDays))
                                {
                                    ?>
                                    <h4 class="motto">Sélectionnez un jour de travail à supprimer</h4>
                                    <?php
                                    for($i = 0; $i < count($workDays);$i++)
                                    {
                                      ?>
                                      <div class="form-check form-check-inline" style="margin-bottom:30px;margin-right:20px;cursor:pointer">
                                          <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" style="color:#FFFFFF" name="workDays[]" style="margin:auto"
                                              value="<?php echo $workDays[$i]['ID']; ?>">
                                              <span class="form-check-sign form-check-inline">
                                              <?php echo $workDays[$i]['days']; ?> de <?php echo $workDays[$i]['De']; ?> à <?php echo $workDays[$i]['A']; ?>
                                                  </span>
                                              </label>
                                      </div>
                                      <?php
                                    }
                                }
                                    ?>
                                    <?php
                                        if(!empty($daysAvailable))
                                        {
                                            ?>
                                                <h4 clas="motto">Ajouter un jour de travail</h4>
                                                <select class="form-control"  name="addDayWork" style="text-align:center" id="exampleFormControlSelect1" data-toggle="tooltip" data-placement="left" title="Ajouter un jour de travail">
                                                <option value="choose">Choisir un jour</option>
                                            <?php 
                                                for($i = 0;$i < count($daysAvailable);$i++)
                                                {
                                            ?>
                                                <option value="<?php echo $daysAvailable[$i]; ?>"><?php echo $daysAvailable[$i]; ?></option>
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        <div class=" form-check-inline" style="position: relative;width:280px;top:10px">
                                            <div class="input-group no-border input-xs " style="left:7px">
                                                <div class="input-group-prepend " id="prep" style=" ">
                                                    <span class="input-group-text" style="height:46px">
                                                    <i class="now-ui-icons text_align-left" style="color:#FFFFFF"></i>
                                                    </span>
                                                </div>
                                                <input type="time" class=" form-check-inline form-control" 
                                                placeholder="Heure de début"  
                                                name="startDay" id="2" min="0" max="23"
                                                value="<?php if(isset($flagName)){ echo $flagName; } ?>" 
                                                data-toggle="tooltip" data-placement="top" 
                                                title="Horaire de début"
                                                style="height:46px;border-top-right-radius:0px;border-bottom-right-radius:0px;
                                                max-width:182px" 
                                                 autocomplete="off"> 
                                            </div>
                                            <div class="input-group no-border input-xs " style="left:7px">
                                                <div class="input-group-prepend " id="prep" style=" ">
                                                    <span class="input-group-text" style="height:46px">
                                                    <i class="now-ui-icons text_align-left" style="color:#FFFFFF"></i>
                                                    </span>
                                                </div>
                                                <input type="time" class=" form-check-inline form-control" 
                                                placeholder="Heure de fin"  
                                                name="endDay" id="3" min="0" max="23"
                                                value="<?php if(isset($flagName)){ echo $flagName; } ?>" 
                                                data-toggle="tooltip" data-placement="top" 
                                                title="Horaire de fin"
                                                style="height:46px;border-top-right-radius:0px;border-bottom-right-radius:0px;
                                                max-width:182px" 
                                                 autocomplete="off"> 
                                            </div>
                                        </div>
                                        <?php
                                        }
                                    ?>
                                        <h4 class="motto">Ajouter un congé</h4>
                                        <div class=" form-check-inline" style="position: relative;width:280px;top:10px">
                                            <div class="input-group no-border input-xs " style="left:7px">
                                                <div class="input-group-prepend " id="prep" style=" ">
                                                    <span class="input-group-text" style="height:46px">
                                                    <i class="now-ui-icons text_align-left" style="color:#FFFFFF"></i>
                                                    </span>
                                                </div>
                                                <input type="date" class=" form-check-inline form-control" 
                                                placeholder="Date de début"  
                                                name="startDate"  min="<?php echo $todays;?>"
                                                value="" 
                                                data-toggle="tooltip" data-placement="top" 
                                                title="Date de début"
                                                style="height:46px;border-top-right-radius:0px;border-bottom-right-radius:0px;
                                                max-width:182px" 
                                                 autocomplete="off"> 
                                            </div>
                                            <div class="input-group no-border input-xs " style="left:7px">
                                                <div class="input-group-prepend " id="prep" style=" ">
                                                    <span class="input-group-text" style="height:46px">
                                                    <i class="now-ui-icons text_align-left" style="color:#FFFFFF"></i>
                                                    </span>
                                                </div>
                                                <input type="date" class=" form-check-inline form-control" 
                                                placeholder="Date de fin"  
                                                name="endDate" id="3" min="<?php echo $twoDays;?>"
                                                value="<?php if(isset($flagName)){ echo $flagName; } ?>" 
                                                data-toggle="tooltip" data-placement="top" 
                                                title="Date de fin"
                                                style="height:46px;border-top-right-radius:0px;border-bottom-right-radius:0px;
                                                max-width:182px" 
                                                 autocomplete="off"> 
                                            </div>
                                        </div>
                                        <div class="ml-auto mr-auto">
                              <button type="button" class="sid"
                                    name="info" value="get"
                                    data-toggle="modal" data-target="#exampleModal" style="font-size:16px"
                                >Mes informations</button>
                                <button type="submit" class="btn btn-primary btn-round btn-lg btn-block ml-auto mr-auto" 
                                            style="cursor:pointer;width:auto" name="choice" value="modWork">Actualiser les informations</button>
                                </div>
                                    </div>
                                        <?php
                                        if(!empty($specs))
                                        {
                                            ?>
                                    <div class="col-md-6" style="color:#fff">  
                                            <h4 class="motto">Lier une spécialité</h4>
                                            <?php 
                                                for($i = 0;$i < count($specs);$i++)
                                                {
                                            ?>
                                        <div class="form-check form-check-inline" style="margin-bottom:30px;margin-right:20px;cursor:pointer">

                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" style="color:#FFFFFF" name="speccedIn[]" style="margin:auto"
                                            value="<?php echo $specs[$i]['ID']; ?>">
                                            <span class="form-check-sign form-check-inline">
                                                </span>
                                                <?php echo $specs[$i]['name']; ?>
                                            </label>
                                                </div>
                                                    
                                            <?php
                                                }
                                                ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        <div class="-footer text-center">
                                            
                                    </form>
                                   
                            </div>
                        </div>
                    </div>
                </div>
                                        </div>
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
      <div class="modal-dialog" role="document" style="position:absolute;margin-top:100px;left:50px">
        <div class="modal-content" style="background-color:#333333;color:#FFFFFF">
          <div class="modal-header" style="text-align:center;white-space:pre-wrap;color:#ce943b">
          <form method="POST" id="reg" action="index.php?page=login">
          </div>
          <div class="modal-body" style="text-align:center;white-space:pre-wrap;margin-top:-80px">
            <h3 class="motto"> Mes jours de travail </h3>
            <?php 
            if(!empty($workDays)){
                for($i=0;$i< count($workDays);$i++){
                    ?>
                    <center style="color:#decba4"><?php echo $workDays[$i]['days']; ?> de <?php echo $workDays[$i]['De']; ?> à <?php echo $workDays[$i]['A']; ?><br></center>
                    <?php
                }
            } else {
                echo "Aucun jour de travail ajouté";
            }
            ?>
            <h3 class="motto">Mes spécialisations</h3>
            <?php 
            if(!empty($mySpecs)){
                for($i=0;$i< count($mySpecs);$i++){
                    ?>
                    <center><?php echo $mySpecs[$i]['name']; ?> </center>
                    <?php
                }
            } else {
                echo "Aucune spécialisation ajoutée";
            }
            ?>

            <h3 class="motto">Mes Vacances</h3>
            <?php 
            if(!empty($holi)){
                for($i=0;$i< count($holi);$i++){
                    ?>
                    <center>Début le : <?php echo sqlDates($holi[$i]['startsAt']); ?>  Fin le : <?php echo sqlDates($holi[$i]['endsAt']); ?> </center>
                    <?php
                }
            } else {
                echo "Aucune vacances prévues";
            }
            ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </form>
          </div>
        </div>
      </div>
</div>