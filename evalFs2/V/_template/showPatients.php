 
                <?php 
                    if(isset($messages))
                    { 
                        if(!empty($messages))
                        {
                            for($i = count($messages) - 1; $i >= 0 ; $i--)
                            {
                                echo $messages[$i];
                            }
                        }
                    }
                ?>                            
                            <div class="row" style="margin-bottom:35px;margin-top:45px"  > 
                            <?php
                        if(!empty($res)){
                            for($z= 0;$z < 15; $z++){
                                for($i = 0;$i < count($res);$i++){
                                    ?>
                        <div class="col-md-6 col-xs-8  ml-auto mr-auto" style="max-width:500px">
                                <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse"  style="margin-top:90px" data-placement="right" title="Vos patients" data-toggle="tooltip">
                        <div class=" container" style="transform:scale(-1,1);background-color:rgba(16,16,16,0.4);height:auto" >
                        <div class="card-header" role="tab" id="heading<?php echo $z; ?>">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $z; ?>" aria-expanded="true" aria-controls="collapse<?php echo $z; ?>" style="color:#ED8F03;font-weight:850">
                            <?= $res[$i]['patientName']; ?>
                            <i class="now-ui-icons arrows-1_minimal-down"></i>
                            </a>
                    </div>

                    <div id="collapse<?php echo $z; ?>" class="collapse show" role="tabpanel" aria-labelledby="heading<?php echo $z; ?>">
                    <div class="card-body" style="color:#fff">
                                            <form action="index.php?page=patients" METHOD="POST">
                                            <h5 class="motto form-check-inline"> Sexe : </h5>

                                                <select name="sexID" class="form-control form-check-inline" style="max-width:260px" data-toggle="tooltil" data-placement="left" title="Sexe"
                                                style="text-align:center">
                                                    <option  style="color:#333333;position:relative;left:85px" value="<?php echo $res[$i]['sexID']; ?>"><?= $res[$i]['sexName']; ?></option>
                                                    <?php
                                                        for($s = 0;$s < count($sexes[$i]);$s++)
                                                        {
                                                            ?>
                                                                <option  style="color:#333333" value="<?php echo $sexes[$i][$s]['ID']; ?>"><?= $sexes[$i][$s]['name']; ?></option>

                                                            <?php
                                                        }

                                                    ?>
                                                </select>
                                                <div class="input-group no-border input-lg " style="max-width:460px">
                                                       <h5 class="motto form-check-inline"> Né(e) le </h5>
                                                    <input type="date" class="form-control" placeholder="<?php echo $res[$i]['birthDate']; ?>"  max="<?php echo $todays; ?>" name="birthDate" id="" data-toggle="tooltip" data-placement="right" 
                                                    title="Date de naissance"
                                                    value="" style="color:#FFFFFF" autocomplete="false" >
                                                </div>
                                                <div class="input-group no-border input-lg " style="max-width:460px">
                                                       <h5 class="motto form-check-inline"> Type </h5>
                                                    <input type="text" readonly class="form-control" placeholder="<?php echo $res[$i]['breed']; ?>" name="breed"
                                                    title="Type"
                                                    value="" style="color:#FFFFFF" autocomplete="false" >
                                                </div>
                                                <div class="input-group no-border input-lg " style="max-width:460px">
                                                       <h5 class="motto form-check-inline"> Origine </h5>
                                                    <input type="text" readonly class="form-control" placeholder="<?php echo $res[$i]['origin']; ?>" name="breed"
                                                    title="Type"
                                                    value="" style="color:#FFFFFF" autocomplete="false" >
                                                </div>
                                                <div class="input-group no-border input-lg " style="max-width:460px">
                                                       <h5 class="motto form-check-inline"> Mode de vie </h5>
                                                    <input type="text" class="form-control" placeholder="<?php echo $res[$i]['lifeS']; ?>"  name="patLs" id="" data-toggle="tooltip" data-placement="right" 
                                                    title="Mode de vie"
                                                    value="" style="color:#FFFFFF" autocomplete="false" >
                                                </div>
                                                <div class="input-group no-border input-lg " style="max-width:460px">
                                                       <h5 class="motto form-check-inline"> Alimentation </h5>
                                                    <input type="text" class="form-control" placeholder="<?php echo $res[$i]['patFood']; ?>"  name="patFood" id="" data-toggle="tooltip" data-placement="right" 
                                                    title="Alimentation"
                                                    value="" style="color:#FFFFFF" autocomplete="false" >
                                                </div>
                                                <div class="input-group no-border input-lg " style="max-width:460px">
                                                       <h5 class="motto form-check-inline"> Nom du représentant </h5>
                                                    <input type="text" class="form-control" placeholder="<?php echo $res[$i]['lastName']; ?> <?php echo $res[$i]['firstName']; ?>"  name="patResp" id="" data-toggle="tooltip" data-placement="right" 
                                                    title="Représentant légal (nom et prénom séparé d'un espace)"
                                                    value="" style="color:#FFFFFF" autocomplete="false" >
                                                </div>
                                                <div class="input-group no-border input-lg " style="max-width:460px">
                                                       <h5 class="motto form-check-inline"> Téléphone </h5>
                                                    <input type="phone" class="form-control" placeholder="<?php echo $res[$i]['phone']; ?>"  name="respPhone" id="" data-toggle="tooltip" data-placement="right" 
                                                    title="Représentant légal (nom et prénom séparé d'un espace)"
                                                    value="" style="color:#FFFFFF" autocomplete="false" >
                                                </div>
                                                <div class="input-group no-border input-lg " style="max-width:460px">
                                                       <h5 class="motto form-check-inline"> @ </h5>
                                                    <input type="mail" class="form-control" placeholder="<?php echo $res[$i]['email']; ?>"  name="respEmail" id="" data-toggle="tooltip" data-placement="right" 
                                                    title="Représentant légal (nom et prénom séparé d'un espace)"
                                                    value="" style="color:#FFFFFF" autocomplete="false" >
                                                </div>
                                                <button type="submit" name="modPat" class="btn btn-primary ml-auto mr-auto" style="background-color:rgba(25,25,25,.05);font-size:18px" value="<?php echo $res[$i]['patID'];?>">Modifier informations patient</button>                                                
                                                </form>
                                                <form method="POST">
                                                    <button type="submit" name="patientID" class="btn btn-primary" style="background-color:rgba(25,25,25,.05);font-size:18px" value="<?php echo $res[$i]['patID'];?>">Accéder à l'historique du patient</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                    
                                </div>
                                </div>
                                <?php
                            }
                        }}
                    ?>
                    
                    </div>
                    </div>
                </div>
                         <!-- Footer -->
        
    </body>
</html>