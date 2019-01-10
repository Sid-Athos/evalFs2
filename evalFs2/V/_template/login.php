
    <div class="wrapper">
      <div class="page-header clear-filter" style="margin-top:0px">
          <div class="page-header-image" data-parallax="true" style="background-image:url('V/_template/assets/img/header.jpg');"></div>
          <div class="container">
          <?php if(isset($message)){ echo $message; }?>                            
            <div>
                <div class="content-center brand" style="margin-top:35%">
                  <div class="col-md-6 ml-auto mr-auto">
                      <div class="card-login">
                        <form class="form" method="POST" action="index.php?page=login" autocomplete="false">
                            
                            <div class="card-body" style="text-align:center">
                            <?php if(isset($actualDate)){ echo $actualDate;} ?>
                              <div class="input-group no-border input-lg">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="now-ui-icons users_circle-08" style="color:#FFFFFF"></i>
                                    </span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Adresse email ou pseudo"  name="mail" id="0" title="Adresse mail ou identifiant"
                                  value="<?php if(isset($flagMail)){ echo $flagMail; } ?>" style="color:#FFFFFF" autocomplete="false" required>
                              </div>
                              <div class="input-group no-border input-lg">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="now-ui-icons text_caps-small" style="color:#FFFFFF"></i></span>
                                  </div>
                                  <input type="password" placeholder="Mot de passe" name="password" id="1" class="form-control"
                                  value="<?php if(isset($flagPassword)){ echo $flagPassword; } ?>" style="color:#FFFFFF" required>
                              </div>
                            </div>
                            <div style="cursor:pointer;position:relative;width:180px" class="form-check ml-auto mr-auto" onclick="showPass()" >
                            <label class="form-check-label">
                                  <span onclick="showPass()">Afficher le mot de passe</span>
                                  <input type="checkbox" class="form-check-input" style="color:#FFFFFF" name="passwordCheck" 
                                  value="y">
                                  <span class="form-check-sign form-check-inline">
                                    </span>
                                  </label>
                              </div>
                            <div class="card-footer text-center">
                              <button type="submit" class="btn btn-primary btn-round btn-lg btn-block"
                              name="choice" value="connexion">Connexion</button>
                        </form>
                              <div class="pull-left">
                              <form method="POST" action="index.php?page=login">
                                  <button type="submit" class="sid"
                                  name="choice" value="register">S'inscrire</button>
                                </form>
                              </div>
                              <div class="pull-right">
                              <button type="button" class="sid"
                                    name="info" value="get"
                                    data-toggle="modal" data-target="#exampleModal"
                                >Besoin d'aide?</button>
                              </div>
                        </div>
                      </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>    
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="position:absolute;margin-top:100px;left:50px">
        <div class="modal-content" style="background-color:#333333;color:#FFFFFF">
          <div class="modal-header" style="text-align:center;white-space:pre-wrap;color:#ce943b">
          <form method="POST" id="reg" action="index.php?page=login">
            <h6 class="modal-title">Première visite? Pas d'inquiétude ;)</h6>
          </div>
          <div class="modal-body" style="text-align:center;white-space:pre-wrap;margin-top:-80px">
            Ton adresse mail ainsi que ton numéro de téléphone te serviront à récupérer ton compte facilement.<br>
            Aussi, ton mail peut tout autant te servir que ton pseudonyme pour te connecter! Ce dernier sera cependant le seul identifiant visible par les autres utilisateurs te concernant.<br>
            Si tu as perdu ton compte, saisis ton mail, nous te renverrons tes informations de connexion par mail et par message!
            Après ton inscription, il est nécessaire que tu choisisses des spécialisations et des horaires de travail avant de pouvoir ajouter des rendez-vous!
            <div class="input-group no-border input-lg">
              <div class="input-group-prepend">
                  <span class="input-group-text">
                  <i class="now-ui-icons ui-1_email-85" style="color:#FFFFFF"></i>
                  </span>
              </div>
              <input type="mail" class="form-control" style="color:#FFFFFF" pattern="^[a-zA-Z0-9\.]{2,16}@[a-z]{2,6}.[a-z]{2,5}$" 
               placeholder="Adresse email" autocomplete="off" id="2" name="recMail">
            </div>
            
            <div class="input-group no-border input-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-phone" style="color:#FFFFFF"></i>
                    </span>
                </div>
                <input type="phone" class="form-control" placeholder="N° de téléphone" id="3" pattern="^[0]{1}[1-9]{1}[0-9]{8,10}$" style="color:#FFFFFF" name="recPhone"
                value="" autocomplete="off">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="choice" value="recover">Récupérer mon compte</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</body>
