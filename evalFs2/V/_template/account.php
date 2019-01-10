
            <?php if(isset($messages)){ 
              for($i = count($messages)-1; $i > 0;$i--){
                echo $messages[$i];
              }
             }?>                            
                <div class="row" style="margin-top:9%">
                  <div class="col-md-6 ml-auto mr-auto">
                        <form class="form ml-auto mr-auto" method="POST" action="index.php?page=account" id="form" style="color:white;width:650px;" autocomplete="off"
                        enctype="multipart/form-data">
                            <div class="-header text-center">
                              <div class="logo-container mb-3">
                              </div>
                            </div>
                            <div class="-body ml-auto mr-auto" style="width:350px">
                              <div class="col-md-6 ml-auto mr-auto" style="width:500px">
                                <img id="blah"  style="max-width:250px;max-height:250px;border-radius:50%;opacity: 0.75;filter: alpha(opacity=50);z-index:99;position:absolute;left:-350px;top:70px;font-size:30px" alt="Preview">
                                <input type="file"  placeholder="Avatar"
                                name="avatar" id="file" autocomplete="off" class="form-control" onchange="readURL(this)"
                                style="text-decoration:none;opacity:0;height:0px;width:0px;">
                                <button type="button" name="file" id="avatar" onclick="selectAvatar()" class="btn btn-primary btn-round btn-lg btn-block ml-auto mr-auto" 
                                style="border-radius:25px;width:200px;height:50px;position:relative;right:22%;">
                                Avatar
                                </button>
                              </div>
                              <div class="input-group no-border input-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="now-ui-icons ui-1_email-85" style="color:#FFFFFF"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" style="color:#FFFFFF" autocomplete="off" id="3"
                                placeholder="<?php if(isset($res[0]['mail'])){ echo $res[0]['mail']; }?>" name="newMail"  pattern="^[a-zA-Z0-9\.]{2,18}@[a-z]{2,6}.[a-z]{2,5}$"
                                value="">
                              </div>
                              <div class="input-group no-border input-lg">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">
                                  <i class="now-ui-icons users_circle-08" style="color:#FFFFFF"></i>
                                  </span>
                                </div>
                                <input type="text" class="form-control" placeholder="<?php if(isset($res[0]['pseudo'])){ echo $res[0]['pseudo']; }?>" style="color:#FFFFFF" autocomplete="off" 
                                title="Alphanumériques, point, underscore, tirets et apostrophe uniquement, minimum 4 caractères" 
                                name="newPseudo"  pattern="/^[a-zA-Z0-9\_\'\.\-]{4,45]$/" id="4"
                                value="">
                              </div>
                              <div class="input-group no-border input-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fas fa-phone" style="color:#FFFFFF"></i>
                                    </span>
                                </div>
                                <input type="phone" class="form-control" placeholder="<?php if(isset($res[0]['phone'])){ if($res[0]['phone'] !== NULL){ echo $res[0]['phone']; } }?>" style="color:#FFFFFF" 
                                pattern="^[0-9]{10,12}$" name="newPhone" id="5"
                                value="" autocomplete="off">
                              </div>
                              <div class="input-group no-border input-lg">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="now-ui-icons text_caps-small" style="color:#FFFFFF"></i></span>
                                  </div>
                                  <input type="password" class="form-control password" placeholder="Ancien mot de passe" id="0" style="color:#FFFFFF" name="oldPassword" 
                                  title="Alphanumériques, point, underscore, tirets et apostrophe uniquement, minimum 4 caractères, 45 maximum" 
                                  value="" autocomplete="off">
                              </div>
                              <div class="input-group no-border input-lg">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="now-ui-icons text_caps-small" style="color:#FFFFFF"></i></span>
                                  </div>
                                  <input type="password" class="form-control password" placeholder="Nouveau mot de passe" id="1" style="color:#FFFFFF" name="newPassword" 
                                  title="Alphanumériques, point, underscore, tirets et apostrophe uniquement, minimum 4 caractères, 45 maximum" 
                                  value="" autocomplete="off">
                              </div>
                              <div class="input-group no-border input-lg">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="now-ui-icons text_caps-small" style="color:#FFFFFF"></i></span>
                                  </div>
                                  <input type="password" class="form-control password" id="2" placeholder="Confirmation du mot de passe" autocomplete="off" style="color:#FFFFFF" name="cNewPassword" 
                                  value="">
                              </div>
                              
                            <div class="form-check form-check-inline mlauto mr-auto" style="position:relative;left:45px;margin-bottom:30px;cursor:pointer">
                            <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" onclick="showPw()" style="color:#FFFFFF" name="password" style="margin:auto"
                                  value="y">
                                  <span class="form-check-sign form-check-inline">
                                    </span>
                                  </label>
                                  Afficher les mots de passe
                            </div>
                            </div>
                            <div class="-footer text-center">
                              <button type="submit" class="btn btn-primary btn-round btn-lg btn-block ml-auto mr-auto" 
                              style="cursor:pointer;width:auto" name="choice" value="mod"
                              onclick="check(event)">Modifier mes informations</button>
                        </form>
                        </div>
                      </div>
                  </div>
                </div>
            </div>