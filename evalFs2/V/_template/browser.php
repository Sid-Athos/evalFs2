
    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="wrapper">
      <div class="page-header clear-filter">
        
        <div class="page-header-image" data-parallax="true" 
        style="background-image:url('V/_template/assets/img/header.jpg');"></div>
        <div class="container">
            <?php if(isset($message)){ echo $message; }?>                            
                <div class="row" style="margin-top:10%">
                  <div class="col-md-6 ml-auto mr-auto" style="max-width:500px">
                      <div class="card-login">
                        <form class="form" method="POST" action="index.php?page=browse" id="form"  autocomplete="off">
                            <div class="card-body" style="text-align:center">
                            <h5 class="motto"><i class="now-ui-icons ui-1_zoom-bold" style="position:relative;right:20px"></i>Outil de recherche</h5>
                            <div class="dropdown-divider"></div>
                              <div class="input-group no-border input-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="now-ui-icons ui-1_email-85" style="color:#FFFFFF"></i>
                                    </span>
                                </div>
                                <input type="date" class="form-control" style="color:#FFFFFF" autocomplete="off" id="3"
                                data-toggle="tooltip" data-placement="top" title="Rechercher des rendez-vous"
                                placeholder="Date" name="browseDate"
                                value="<?php if(isset($mail)){ echo $mail; }?>">
                              </div>
                        <div class="form-check form-check-inline form-check-radio" style="margin-bottom:30px;margin-right:20px;cursor:pointer">

                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" style="color:#FFFFFF" name="dateZone" style="margin:auto"
                            value="day">
                            <span class="form-check-sign form-check-inline">
                                </span>
                               Rdv du jour
                            </label>
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" style="color:#FFFFFF" name="dateZone" style="margin:auto"
                            value="week">
                            <span class="form-check-sign form-check-inline">
                                </span>
                                Rdv de la semaine
                            </label>
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" style="color:#FFFFFF" name="dateZone" style="margin:auto"
                            value="month">
                            <span class="form-check-sign form-check-inline">
                                </span>
                                Rdv du mois
                            </label>
                            </div>
                              <div class="input-group no-border input-lg">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">
                                  <i class="now-ui-icons users_circle-08" style="color:#FFFFFF"></i>
                                  </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Pseudo à rechercher" style="color:#FFFFFF" autocomplete="off" 
                                data-toggle="tooltip" data-placement="top"
                                title="Alphanumériques, point, underscore, tirets et apostrophe uniquement, minimum 4 caractères" 
                                name="searchPseudo"  id="4"
                                value="<?php if(isset($pseudo)){ echo $pseudo; }?>">
                              </div>
                              <div class="input-group no-border input-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fas fa-phone" style="color:#FFFFFF"></i>
                                    </span>
                                </div>
                                <input type="phone" class="form-control" placeholder="Téléphone à rechercher" style="color:#FFFFFF" 
                                data-toggle="tooltip" data-placement="top" title="Numéro de téléphone, 10 à 12 caractères, peut être laissé vide."
                                pattern="^[0-9]{10,12}$" name="searchPhone" id="5"
                                value="<?php if(isset($phone)){ if($phone !== NULL){ echo $phone; } }?>" autocomplete="off">
                              </div>
                              
                            <div class="card-footer text-center">
                              <button type="submit" class="btn btn-primary btn-round btn-lg btn-block" 
                              style="cursor:pointer" name="choice" value="find"
                             >Rechercher</button>
                        </form>
                        
                        </div>
                      </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>    

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
      <div class="modal-dialog" role="document" style="position:absolute;margin-top:100px;left:50px">
        <div class="modal-content" style="background-color:#333333;color:#FFFFFF">
          <div class="modal-header" style="text-align:center;white-space:pre-wrap;color:#ce943b">
          <form method="POST" id="reg" action="index.php?page=login">
            <h5 class="modal-title" id="exampleModalLabel">Nom de compte perdu? Mot de passe oublié? Des questions sur le formulaire? Pas d'inquiétude ;)</h5>
          </div>
          <div class="modal-body" style="text-align:center;white-space:pre-wrap;margin-top:-80px">
            Ton adresse mail ainsi que ton numéro de téléphone te serviront à récupérer ton compte facilement.<br>
            Aussi, ton mail peut tout autant te servir que ton pseudonyme pour te connecter! Ce dernier sera cependant le seul identifiant visible par les autres utilisateurs te concernant.<br>
            Si tu as perdu ton compte, saisis ton mail, nous te renverrons tes informations de connexion par mail et par message!
            <div class="input-group no-border input-lg">
              <div class="input-group-prepend">
                  <span class="input-group-text">
                  <i class="now-ui-icons ui-1_email-85" style="color:#FFFFFF"></i>
                  </span>
              </div>
              <input type="mail" class="form-control" style="color:#FFFFFF"  id="6" pattern="^[a-zA-Z0-9\.]{2,18}@[a-z]{2,6}.[a-z]{2,5}$" placeholder="Adresse email" autocomplete="off" name="recMail">
            </div>
            <div class="input-group no-border input-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-phone" style="color:#FFFFFF"></i>
                    </span>
                </div>
                <input type="phone" class="form-control" placeholder="N° de téléphone" id="7" pattern="^[0-9]{10,12}$" style="color:#FFFFFF" name="recPhone"
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

    <!--   Core JS Files   -->
    <script src="V/_template/assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="V/_template/assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="V/_template/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="V/_template/assets/js/plugins/bootstrap-switch.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="V/_template/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
    <script src="V/_template/assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
    <script src="V/_template/assets/js/now-ui-kit.js?v=1.2.0" type="text/javascript"></script>
</body>