    <!--   Core JS Files   -->
    <script src="V/_template/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="V/_template/assets/js/now-ui-kit.js?v=1.2.0" type="text/javascript"></script>
    <script src="V/_template/assets/js/app.js"></script>
    <script>
        $("#appsModal").show('modal');
    </script>
    <div id="eraseAppAnswer" style="position:absolute;top:-50px;left:-150px">
    </div>
        <?php
            if(!empty($res)){
                $compteur = 0;
                $card = 0;
                $where = intval($res[0]['dayNum']);
                $day = intval($res[0]['dayNum']);
                ?>
                <div class="card-container form-check-inline animated slideInDown" id="cardApps"  data-toggle="tooltip" data-placement="right" title="Passez la souris par dessus la carte pour voir apparaître le planning" style="z-index:5;width:290px;margin:auto;background-color:transparent">
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
                            <div class="form-check-inline" style="color:#FFFFFF;max-height:10px;" >
                            <button onclick="document.getElementById('cardApps').remove();" class="btn btn-neutral" style="background-color:transparent;position:relative;text-align:center;left:40%;font-size:15px">Fermer la carte</button>
                                </div>
                    <?php
                    for($i = 0; $i <  count($res); $i++)
                    {
                        if($day !== (intval($res[($i)]['dayNum']))){
                            $day = intval($res[($i)]['dayNum']);
                            ?>
                <div class="card-container form-check-inline"  data-toggle="tooltip" data-placement="right" title="Passez la souris par dessus la carte pour voir apparaître le planning" style="width:315px;min-width:300px">
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
                            <div class="content" id="rdv<?php echo $res[$i]['appId'];?>" style="border-top-left-radius:5px;border-top-right-radius:5px;font-size:16px">

                       <h5 onclick="document.getElementById('cardApps').remove();" class="btn btn-neutral motto" style="background-color:transparent;">Fermer la carte</h5>
                            </div>
                            <?php
                        } else {
                        ?>
                                
                                <div class="content" id="rdv<?php echo $res[$i]['appId'];?>" style="border-top-left-radius:5px;border-top-right-radius:5px;font-size:16px">
                                
                                    <h5 class="motto" id="tooltip<?php echo $res[$i]['appId'];?>" data-toggle="tooltip" data-placement="top" 
                                    title="Rendez-vous de <?php $hour = explode(":",$res[$i]['startTime']); $hour = $hour[0].":".$hour[1];  echo $hour; ?>, cliquez sur la croix pour supprimer" 
                                    style="z-index:99;color:rgba(255,255,255,1);font-size:20px"><?php echo $res[$i]['appName']; ?>
                        <?php if($res[$i]['appStatus'] === "1"){?><i class="now-ui-icons ui-1_simple-remove" onclick="killApp(<?php echo $res[$i]['appId'];?>);" style="cursor:pointer;font-size:18px"></i><?php } else {?>, Rendez-vous effectué<?php }?>
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
                                                    <h6 class="motto">Né(e) le :<br> <?php echo $res[$i]['birthDate']; ?><br></h6>
                                                    <h6 class="motto">Origine :<br> <?php echo $res[$i]['origin']; ?><br></h6>
                                                    <h6 class="motto">Détails origine :<br> <?php echo $res[$i]['breed']; ?><br></h6>
                                                    <h6 class="motto">Représentant légal : <br><?php echo $res[$i]['lastName']; ?> <?php echo $res[$i]['firstName']; ?></h6>
                                                    <h6 class="motto">Téléphone : <br><?php echo $res[$i]['phone']; ?><br></h6>
                                                    <h6 class="motto">@ : <br><?php echo $res[$i]['email']; ?><br></h6>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <?php
                                    if(intval($res[$i]['appStatus']) === 1){?>
                                <div class="form-check-inline" style="background-color:transparent;color:#FFFFFF;max-height:10px;min-height:10px;height:10px;margin-left:25px;position:relative;top:20px;margin-bottom:30px" >
                                    <form method="post" action="index.php?page=apps">
                                        <button type="submit" name="editApp" value="<?php echo $res[$i]['appId']; ?>" class="btn sid form-check-inline"
                                        style="left:50px;">
                                        Modifier l'évènement
                                        </button>
                                        <button type="submit" name="consult" value="<?php echo $res[$i]['appId']; ?>" class="btn sid form-check-inline"
                                        style="left:50px;margin-top:-5px;margin-bottom:15px">
                                        Gérer la consultation
                                        </button>
                                    </form>
                                </div>
                                    <?php }?>
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
                                        <button onclick="document.getElementById('cardApps').remove();" class="btn btn-neutral" style="background-color:transparent;">Fermer la carte<i class="now-ui-icons ui-1_simple-remove"></i></button>
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

       <style>
        .btn.sid:hover{
            background-color:transparent;
        }
        .btn.sid:focus{
            background-color:transparent;
        }
        .btn.sid:active{
            background-color:transparent;
        }

       </style>
