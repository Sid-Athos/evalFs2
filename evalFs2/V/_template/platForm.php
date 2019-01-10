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
                        if(!empty($cats))
                        {
                            ?>
                            <form class="form" method="POST" action="index.php?page=platoons" autocomplete="false">
                                <div class="card-header text-center">
                                <div class="logo-container mb-3">
                                <img id="blah"  style="position:relative;width:250px;height:250px;border-radius:50%;opacity: 0.75;filter: alpha(opacity=50);font-size:30px;margin-left:-50px" alt="Preview">                                 
                                </div>
                                </div>
                                <div class="col-md-6 ml-auto mr-auto" style="width:500px">
                                    <input type="file"  placeholder="Avatar"
                                    name="platPreview" id="file" autocomplete="off" class="form-control" onchange="readURL(this)"
                                    style="text-decoration:none;opacity:0;height:0px;width:0px;">
                                    <button type="button" name="file" id="avatar" onclick="selectAvatar()" class="btn btn-primary" 
                                    style="border-radius:14px;width:200px;height:40px;background-color:#fa7a50;margin-left:-50px">
                                    Image de présentation
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div id="check">
                                    </div>
                                    <div class="input-group no-border input-lg">
                                        <div class="input-group-prepend" id="prep">
                                        <span class="input-group-text">
                                        <i class="now-ui-icons text_align-center" style="color:#FFFFFF"></i>
                                        </span>
                                        </div>
                                        
                                        <input type="text" class="form-control" placeholder="Nom du salon"  name="platName" id="0" onkeyup="checkPlatName(this.value)"
                                        value="<?php if(isset($flagName)){ echo $flagName; } ?>" style="color:#FFFFFF" required autocomplete="off">
                                    </div>
                                    <h5>Statut du salon</h5><br>
                                    <div class="form-check form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="platStatus" id="inlineRadio1" value="1"> Public
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="platStatus" id="inlineRadio2" value="0"> Privé
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div><br>
                                Sélectionez une ou plusieurs catégories de référencement :<br>
                                <?php
                                
                                    for($i = 0;$i < count($cats);$i++)
                                    {
                                        ?>
                                        <div class="form-check form-check-inline" style="margin-bottom:30px;margin-right:20px;cursor:pointer;width:120px">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" style="color:#FFFFFF" name="addCat[]" style="margin:auto"
                                                value="<?php echo $cats[$i]['ID']."-".$cats[$i]['Nom']; ?>">
                                                <span class="form-check-sign form-check-inline">
                                                </span>
                                            </label>
                                            <span><?php echo $cats[$i]['Nom']; ?></span>
                                        </div>  
                                        <?php
                                    }
                                ?>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-round btn-lg btn-block" onclick="subPlatoon(event)"
                                    name="choice" value="addPlat">Créer mon salon</button>
                                </form>
                                <div class="pull-right">
                                    <button type="button" class="sid"
                                    name="info" value="get" data-toggle="modal" data-target="#exampleModal">Besoin d'aide?
                                    </button>
                                </div>
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