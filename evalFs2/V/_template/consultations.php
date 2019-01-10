<div class="wrapper">
    <div class="page-header clear-filter" style="margin-top:0px">
        <div class="page-header-image" data-parallax="true" style="background-image:url('V/_template/assets/img/header.jpg');"></div>
        <?php if(isset($message)){ echo $message; }?>                            
            <div class="row ml-auto mr-auto" style="max-width:950px;margin-top:8%">
                <div class="col-md-6" style="max-width:600px">
                    <form class="form" method="POST" action="index.php?page=apps" autocomplete="false">
                        <button type="button" class="sid"
                        name="insConsult" value="<?php echo $_POST['consult']; ?>" style="font-size:19px;font-weight:950"
                        data-toggle="modal" data-target="#exampleModal">Cliquez ici pour des informations complémentaires</button>
                        <div class="input-group no-border input-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="now-ui-icons users_circle-08" style="color:#FFFFFF"></i>
                                    </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Raison(s)"  name="consReas" id="" data-toggle="tooltip" data-placement="right" 
                            title="Raisons de la consultation"
                            value="<?php if(isset($flagMail)){ echo $flagMail; } ?>" style="color:#FFFFFF" autocomplete="false" required>
                        </div>
                        <div class="input-group no-border input-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="now-ui-icons users_circle-08" style="color:#FFFFFF"></i>
                                </span>
                            </div>
                            <textarea class="form-control" placeholder="Etat d'esprit"  name="consMind" id="" data-toggle="tooltip" data-placement="right" 
                            title="État d'esprit"
                            value="<?php if(isset($flagMail)){ echo $flagMail; } ?>" style="color:#FFFFFF" autocomplete="false" required></textarea>
                        </div>
                        <div class="input-group no-border input-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="now-ui-icons users_circle-08" style="color:#FFFFFF"></i>
                                </span>
                            </div>
                            <textarea class="form-control" placeholder="État physique"  name="consPhy" id="" data-toggle="tooltip" data-placement="right" 
                            title="Condition physique"
                            value="<?php if(isset($flagMail)){ echo $flagMail; } ?>" style="color:#FFFFFF" autocomplete="false" required></textarea>
                        </div>
                        <div class="input-group no-border input-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="now-ui-icons users_circle-08" style="color:#FFFFFF"></i>
                                </span>
                            </div>
                            <input type="number" class="form-control" placeholder="Poids" min="0" step="0.1" max="5000" name="consWeight" id="" data-toggle="tooltip" data-placement="right" 
                            title="Poids du patient"
                            value="<?php if(isset($flagMail)){ echo $flagMail; } ?>" style="color:#FFFFFF" autocomplete="false" required>
                        </div>
                        <div class="input-group no-border input-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="now-ui-icons users_circle-08" style="color:#FFFFFF"></i>
                                </span>
                            </div>
                            <textarea  class="form-control" placeholder="Tempérament"  name="consTemp" id="0" data-toggle="tooltip" data-placement="right" 
                            title="Tempérament"
                            value="<?php if(isset($flagMail)){ echo $flagMail; } ?>" style="color:#FFFFFF" autocomplete="false" required></textarea>
                        </div>
                        <div class="input-group no-border input-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="now-ui-icons users_circle-08" style="color:#FFFFFF"></i>
                                </span>
                            </div>
                            <textarea  class="form-control" placeholder="Remarques"  name="consNotes" id="0" data-toggle="tooltip" data-placement="right" 
                            title="Remarques"
                            value="<?php if(isset($flagMail)){ echo $flagMail; } ?>" style="color:#FFFFFF" autocomplete="false" required></textarea>
                        </div>
                        <div class="input-group no-border input-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="now-ui-icons users_circle-08" style="color:#FFFFFF"></i>
                                </span>
                            </div>
                            <textarea  class="form-control" placeholder="Diagnostic/recommandations"  name="diagnosis" id="0" data-toggle="tooltip" data-placement="right" 
                            title="Diagnostic et traitement"
                            value="<?php if(isset($flagMail)){ echo $flagMail; } ?>" style="color:#FFFFFF" autocomplete="false" required></textarea>
                        </div>
                </div>
                <div class="col-md-6" style="margin-top:170px">
                    <?php
                        if(!empty($zones))
                        {
                            ?>
                                <h4 class="motto">Zones traitées</h4>
                                    <div class="row">
                                <?php 
                                    for($i = 0;$i < count($zones);$i++)
                                    {
                                ?>
                                        <div class="col-md-3 form-check form-check-inline" style="margin-bottom:30px;margin-right:20px;cursor:pointer">

                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" style="color:#FFFFFF" name="zonesIn[]" style="margin:auto"
                                            value="<?php echo $zones[$i]['ID']; ?>">
                                            <span class="form-check-sign form-check-inline">
                                            </span>
                                            <?php echo $zones[$i]['name']; ?>
                                            </label>
                                        </div>
                                        
                                <?php
                                    }
                                    ?>
                                    </div>

                                    <?php
                                }
                                ?>
                            <div class="card-footer text-center" style="margin-bottom:150px">
                              <button type="submit" class="btn btn-primary btn-round btn-lg btn-block"
                              name="regCons" value="<?php echo $res[0]['appId']; ?>">Enregistrer la fiche</button>
                        
                            </div>
                            </form>
                              
                    </div>
                </div>
        </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="position:absolute;margin-top:100px;left:50px">
        <div class="modal-content" style="background-color:transparent;color:#FFFFFF">
          <?php
            if(!empty($res)){
                $compteur = 0;
                $card = 0;
                $where = intval($res[0]['dayNum']);
                $day = intval($res[0]['dayNum']);
                ?>
                <div class="card-container form-check-inline animated slideInDown" id="cardApps"  data-toggle="tooltip" data-placement="right" data-toggle="tooltip" data-placement="right" 
                title="Passez la souris par dessus la carte pour voir apparaître le planning" style="z-index:5;width:290px;margin:auto;background-color:transparent">
                        <div class="card" style="border:none;width:290px;position:relative;top:-200px">
                            <div class="front" style="background-color:#212529;border:none;border-top-left-radius:5px;border-top-right-radius:5px">
                                
                                <div class="header" style="background-color:rgba(44, 95, 255);text-align:center;z-index:99;border-top-left-radius:5px;border-top-right-radius:5px">
                                    <h2 class="text-center" style="z-index:99;color:rgba(255,255,255,1);font-size:20px">
                                        <?php echo ucfirst($res[0]['dayName']);?>, <?php echo $res[0]['dayNum'];?> <?php echo ucfirst($res[0]['monthName']);?> <?php echo ucfirst($res[0]['years']);?>
                                </div>
                                <div class="header" style="z-index:2;border:none">
                                    <img class="" src="<?php if($res[0]['name'] === 'Amoureux'){ echo 'https://media.giphy.com/media/LRVnPYqM8DLag/giphy.gif'; } else { echo 'V/_template/assets/img/header.jpg'; }?>" style="z-index:-2;border:none" style="z-index:-2;border:none;">
                                </div>
                                <div class="content">
                                    <div class="main" style="background-color:#212529;color:rgba(255,255,255,0.7)">
                                        <h5 class="motto" id="dateApp<?php echo $res[0]['appId'];?>"style="display:none"><?php echo $_POST['fetchApps']; ?></h5>
                                        <p class="profession">Au menu aujourd'hui</p>
                                        <p class="text-center">"I'm the new Sinatra, and since I made it here I can make it anywhere, yeah, they love me everywhere"</p>
                                    </div>
                                    
                                </div>
                            </div> <!-- end front panel -->
                            <div class="back" style="overflow-y:scroll;overflow-x:hidden;background-color:#212529;border-top-left-radius:5px;border-top-right-radius:5px">
                            
                    <?php
                    for($i = 0; $i <  count($res); $i++)
                    {
                        if($day !== (intval($res[($i)]['dayNum']))){
                            $day = intval($res[($i)]['dayNum']);
                            ?>
                <div class="card-container form-check-inline"  data-toggle="tooltip" data-placement="right" data-toggle="tooltip" data-placement="right" 
                title="Passez la souris par dessus la carte pour voir apparaître le planning" style="width:315px;min-width:300px">
                        <div class="card" style="border:none;width:350px;position:relative;top:-200px">
                            <div class="front" style="background-color:#212529;border:none;border-top-left-radius:5px;border-top-right-radius:5px">
                                <div class="header" style="background-color:rgba(44, 95, 255,0.2);text-align:center;z-index:99;border-top-left-radius:5px;border-top-right-radius:5px">
                                    <h2 class="text-center" style="z-index:99;color:rgba(255,255,255,1);font-size:20px">
                                        <?php echo ucfirst($res[$i]['dayName']);?>, <?php echo $res[$i]['dayNum'];?> <?php echo ucfirst($res[$i]['monthName']);?> <?php echo $res[$i]['years'];?>
                                </div>
                                <div class="user" style="z-index:2;border:none">
                                    <img class="img-circle" src="<?php if($res[0]['name'] === 'Amoureux'){ echo 'https://media.giphy.com/media/LRVnPYqM8DLag/giphy.gif'; } else { echo 'V/_template/assets/img/header.jpg'; }?>" style="z-index:-2;border:none">
                                </div>
                                <div class="content">
                                    <div class="main" style="background-color:#212529;color:rgba(255,255,255,0.7)">
                                        <h3 class="name">Au menu aujourd'hui</h3>
                                        <p class="text-center">"I'm the new Sinatra, and since I made it here I can make it anywhere, yeah, they love me everywhere"</p>
                                    </div>
                                    
                                </div>
                            </div> <!-- end front panel -->
                            <div class="back" style="overflow-y:scroll;overflow-x:hidden;background-color:#212529;border-top-left-radius:5px;border-top-right-radius:5px">
                            <?php
                        } else {
                        ?>
                                
                                <div class="content" id="rdv<?php echo $res[$i]['appId'];?>" style="border-top-left-radius:5px;border-top-right-radius:5px;font-size:16px">
                                
                                    <h5 class="motto" id="tooltip<?php echo $res[$i]['appId'];?>" data-toggle="tooltip" data-placement="top" 
                                    data-toggle="tooltip" data-placement="right" 
                                    title="Rendez-vous de <?php $hour = explode(":",$res[$i]['startTime']); $hour = $hour[0].":".$hour[1];  echo $hour; ?>, cliquez sur la croix pour supprimer" 
                                    style="z-index:99;color:rgba(255,255,255,1);font-size:20px"><?php echo $res[$i]['appName']; ?>
                                    </h5>
                                    <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse" >
                                        <div class="card-plain" style="background:transparent">
                                            <div class="card-header" role="tab" id="heading<?php echo $compteur; ?>" style="text-align:center;font-size:16px">
                                                <i class="now-ui-icons travel_info" style="color:#3d72b4"></i>
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $compteur; ?>" aria-expanded="false" aria-controls="collapse<?php echo $compteur; ?>">
                                                Infos pratiques
                                                <i class="now-ui-icons arrows-1_minimal-down"></i>
                                                </a>
                                            </div>
                                            <div id="collapse<?php echo $compteur; ?>" class="collapse hide" role="tabpanel" aria-labelledby="heading<?php echo $compteur; $compteur++?>">
                                                <div class="card-body" style="background:transparent;color:rgb(255,255,255,0.7);">
                                                    <h6 class="motto">Heure de début : <br><?= $hour; ?><br></h6>
                                                    <h6 class="motto">Situé à : <br><?php echo $res[$i]['place']; ?><br></h6>
                                                    <h6 class="motto">Catégorie : <br><?php if($res[$i]['name'] === 'Amoureux'){ echo '<i class="now-ui-icons ui-2_favourite-28" style="margin-right:10px;font-size:15px;color:#ee9ca7"></i>';} echo $res[$i]['name']; ?></h6>
                                                    <h6 class="motto">Notes : <br><?php echo $res[$i]['notes']; ?><br></h6>
                                                    <h6 class="motto">Addresse du patient : <br><?php echo $res[$i]['address']; ?> <?php echo $res[$i]['postCode']; ?> <?php echo $res[$i]['city']; ?><br></h6>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-plain" style="background:transparent">
                                            <div class="card-header" role="tab" id="heading<?php echo $compteur; ?>" style="text-align:center">
                                                <i class="now-ui-icons users_single-02" style="color:#3d72b4"></i>    
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $compteur; ?>" 
                                                aria-expanded="false" aria-controls="collapse<?php echo $compteur; ?>">
                                                Participant(s) 
                                                <i class="now-ui-icons arrows-1_minimal-down"></i>
                                                </a>
                                            </div>
                                            <div id="collapse<?php echo $compteur; ?>" class="collapse hide" role="tabpanel" aria-labelledby="heading<?php echo $compteur; $compteur++?>">
                                                <div class="card-body" style="background:transparent;color:rgb(255,255,255,0.7)">
                                                    <h6 class="motto">Patient : <br><?= $res[$i]['patientName']; ?><br></h6>
                                                    <h6 class="motto">Sexe : <br><?= $res[$i]['sexName']; ?><br></h6>
                                                    <h6 class="motto">Origine :<br> <?php echo $res[$i]['origin']; ?><br></h6>
                                                    <h6 class="motto">Détails origine :<br> <?php echo $res[$i]['breed']; ?><br></h6>
                                                    <h6 class="motto">Né(e) le :<br> <?php echo $res[$i]['birthDate']; ?><br></h6>
                                                    <h6 class="motto">Représentant légal : <br><?php echo $res[$i]['lastName']; ?> <?php echo $res[$i]['firstName']; ?></h6>
                                                    <h6 class="motto">Téléphone : <br><?php echo $res[$i]['phone']; ?><br></h6>
                                                    <h6 class="motto">@ : <br><?php echo $res[$i]['email']; ?><br></h6>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <?php
                                    if(!empty($prevCons)){
                                        ?>
                                                <h3 class="motto">Historique</h3>
                                        <?php
                                        for($p = 0;$p < count($prevCons);$p++)
                                        {
                                                $hours = explode(":",$prevCons[$p]['consH']);
                                                $hours = $hours[0].":".$hours[1];
                                                $datesC = explode("-",$prevCons[$p]['consDate']);
                                                $datesC = "$datesC[2]-$datesC[1]-$datesC[0]";
                                            ?>
                                                <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse" >
                                                    <div class="card-plain" style="background:transparent">
                                                        <div class="card-header" role="tab" id="heading<?php echo $compteur; ?>" style="text-align:center;font-size:16px">
                                                            <i class="now-ui-icons travel_info" style="color:#3d72b4"></i>
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $compteur; ?>" aria-expanded="false" aria-controls="collapse<?php echo $compteur; ?>">
                                                            Consultation du <?= $datesC;?> à <?= $hours; ?>
                                                            <i class="now-ui-icons arrows-1_minimal-down"></i>
                                                            </a>
                                                        </div>
                                                        <div id="collapse<?php echo $compteur; ?>" class="collapse hide" role="tabpanel" aria-labelledby="heading<?php echo $compteur; $compteur++?>">
                                                            <div class="card-body" style="background:transparent;color:rgb(255,255,255,0.7);">
                                                                <h6 class="motto">Intitulé : <br><?php echo $prevCons[$p]['appName']; ?><br></h6>
                                                                <h6 class="motto">Raison : <br><?php echo $prevCons[$p]['reason']; ?><br></h6>
                                                                <h6 class="motto">État mental : <br><?php echo $prevCons[$p]['mState']; ?><br></h6>
                                                                <h6 class="motto">État physique : <br><?php echo $prevCons[$p]['pState']; ?><br></h6>
                                                                <h6 class="motto">Tempérament : <br><?php echo $prevCons[$p]['temp']; ?></h6>
                                                                <h6 class="motto">Notes : <br><?php echo $prevCons[$p]['cNotes']; ?><br></h6>
                                                                <h6 class="motto">Poids : <br><?php echo $prevCons[$p]['weight']; ?> kg<br></h6> 
                                                                <h6 class="motto" style="underline:none">Zones opérées<br></h6> 
                                                                <?php
                                                                    if(!empty($prevZones[$p])){
                                                                        for($n = 0;$n < count($prevZones[$p]);$n++){
                                                                            ?>
                                                                            <h6 class="motto">=>  <?php echo $prevZones[$p][$n]['name']; ?><br></h6> 

                                                                            <?php
                                                                        }
                                                                    } else {
                                                                        ?>
                                                                            <h6 class="motto">Aucune<br></h6> 
                                                                        <?php

                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                
                                </div>
                    <?php
                    }
                }
                ?>
                                <div class="content" style="margin-bottom:-80px;background-color:transparent">
                                    <div class="main" style="background-color:transparent;color:#FFFFFF" >
                                    
                                        <h4 class="text-center">Planning du jour</h4>
                                        <p class="text-center">TimeStamped vous souhaite une excellente journée!</p>
                                    </div>
                                </div>
                                <div class="footer">
                                    <div class="social-links text-center">
                                        <a href="#" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                                        <a href="#" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                                        <a href="#" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                            </div>
                        </div>
                    </div>
                    <?php
            } else {
                echo alert("Aucun rendez-vous disponible");
            }
        ?>
        </div>
        </div>
          </div>
        </div>
      </div>
    </div>
</body>