    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="wrapper">
      <div class="page-header clear-filter" filter-color="orange">
          <div class="page-header-image" data-parallax="true" style="background-image:url('V/_template/assets/img/header.jpg');"></div>
          <div class="container">
          <?php if(isset($message)){ echo $message; }?>                            
            <div>
                <div class="content-center brand">
                  <div class="col-md-6 ml-auto mr-auto">
                      <div class="card card-login card-plain">
                      <?php
                        if($res !== false)
                        {
                            ?>
                            <form class="form" method="POST" action="index.php?page=platoons" autocomplete="false">
                                <div class="card-body">
                                    <div class="input-group no-border input-lg">
                                        <div class="input-group-prepend" id="prep">
                                            
                                        <span class="input-group-text">
                                        <i class="now-ui-icons text_align-center" style="color:#FFFFFF"></i>
                                        </span>
                                        </div>
                                        
                                        <input type="text" class="form-control" placeholder="Rechercher parmis mes salons..."  name="platName" id="0" 
                                        title="Rechercher un salon" onkeyup="searchSelect()"
                                        value="<?php if(isset($flagName)){ echo $flagName; } ?>" style="color:#FFFFFF" autocomplete="off">
                                    </div>
                                Sélectionnez le salon à administrer :<br>
                                <div class="form-group ml-auto mr-auto" style="margin-bottom:30px;margin-right:20px;cursor:pointer;width:190px;text-align:center">
                                <select name="choosePlatHandle" class="form-control" id="select" style="text-align:center">
                                <?php
                                    for($i = 0;$i < count($res);$i++)
                                    {
                                        ?>
                                                <option style="color:#FFFFFF"  style="margin:auto"
                                                value="<?php echo $res[$i]['name']."-".$res[$i]['ID']; ?>">
                                            <?php echo $res[$i]['name']; ?></option>
                                            <?php
                                    }
                                    ?>
                                </select>
                                </div>  
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-round btn-lg btn-block" onclick="subPlatoon(event)"
                                    name="choice" value="platToHandle">Gérer mon salon</button>
                                </form>
                                <div class="pull-right">
                                    <button type="button" class="sid"
                                    name="info" value="get" data-toggle="modal" data-target="#exampleModal">Besoin d'aide?
                                    </button>
                                </div>
                            <?php
                        }
                        else 
                        {
                            ?>
                                Souhaitez vous créer un salon? C'est par ici!
                                <form action="index.php?page=platoons" method="POST" style="margin-top:-9px;margin-bottom:-9px">
                                    <button type="submit" class="dropdown-item" name="choice" value="createPlat">
                                        <i class="now-ui-icons ui-1_simple-add" style="margin-left:-13px;margin-bottom:4px;font-weight:950"></i>Créer un salon
                                    </button>
							    </form>
                            <?php
                        }
                        ?>
                        </div>
                      </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>    
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
      <div class="modal-dialog" role="document" style="position:absolute;margin-top:20%;left:50px">
        <div class="modal-content" style="background-color:#333333;color:#FFFFFF">
          <div class="modal-header" style="text-align:center;color:#ce943b;margin:auto;font-size:24px">
            Le mot de l'équipe
          </div>
          <div class="modal-body" style="text-align:center;white-space:pre-wrap;margin-top:0px">
            Les règles qui régissent le choix du nom de la room sont les mêmes que celles qui s'appliquent au pseudonyme<br>(Aucun caractère spécial autorisé sauf les -,-,')
          </div>
        </div>
      </div>
    </div>