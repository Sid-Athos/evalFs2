            <?php 
            //var_dump($zones);
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
                                <?php
                                    if(!empty($prevCons)){
                                        ?>
                            <div class="row" style="margin-bottom:35px;margin-top:45px"> 

                                        <?php
                                        for($i = 0;$i < count($prevCons);$i++){
                                            $hours = explode(":",$prevCons[$i]['consH']);
                                        $hours = $hours[0].":".$hours[1];
                                        $datesC = explode("-",$prevCons[$i]['consDate']);
                                        $datesC = "$datesC[2]-$datesC[1]-$datesC[0]";
                                            ?>
                        <div class="col-md-6 col-xs-8  ml-auto mr-auto" data-toggle="tooltip" style="max-width:500px" data-placement="right" title="Les consultations">

                            <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse"  style="margin-top:90px;">
                                <div class=" container" style="transform:scale(-1,1);background-color:rgba(16,16,16,0.4);height:auto" >
                                    <div class="card-header" role="tab" id="heading<?php echo $i; ?>">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>" style="color:#ED8F03;font-weight:850">
                                        Consultation du <?= $datesC;?> à <?= $hours; ?>
                                        <i class="now-ui-icons arrows-1_minimal-down"></i>
                                        </a>
                                    </div>

                                    <div id="collapse<?php echo $i; ?>" class="collapse show" role="tabpanel" aria-labelledby="heading<?php echo $i; ?>">
                                        <div class="card-body" style="color:#fff">
                                        <?php  
                                                if(!empty($zones[$i]))
                                                {
                                        ?>
                                        <h6 class="motto form-check-inline" style="color:rgba(242, 112, 156, 0.7)">Zones opérées :</h6>  
                                                <div class="row">                      
                                                    <?php
                                                        for($z = 0 ;$z< count($zones[$i]);$z++)
                                                        {
                                                            ?>
                                                        
                                                                <div class="col-md-3"> 
                                                                    <?php echo $zones[$i][$z]['name'];?>
                                                                    <?php if(!empty($zones[$i][$z]['zonePath'])){?> 
                                                                    <img style="max-height:65px,max-width:65px;height:55px;width:55px" src="<?php echo $zones[$i][$z]['zonePath'];?>">   
                                                                    <?php }?>
                                                                </div>
                                                            <?php

                                                        }
                                                    ?>
                                                </div>
                                                    <?php
                                                }
                            
                        
                                        ?>
                                    <div class="row" style="margin-top:10px">
                                        
                                        <div class="col-md-6"><h6 class="motto form-check-inline" style="color:rgba(242, 112, 156, 0.7)">Intitulé : </h6><?php echo $prevCons[$i]['appName']; ?></div>
                                        <div class="col-md-6"><h6 class="motto form-check-inline" style="color:rgba(242, 112, 156, 0.7)">Raison : </h6><?php echo $prevCons[$i]['reason']; ?></div>
                                        <div class="col-md-6"><h6 class="motto form-check-inline" style="color:rgba(242, 112, 156, 0.7)">État mental :</h6> <?php echo $prevCons[$i]['mState']; ?></div>
                                        <div class="col-md-6"><h6 class="motto form-check-inline" style="color:rgba(242, 112, 156, 0.7)">État physique :</h6> <?php echo $prevCons[$i]['pState']; ?></div>
                                        <div class="col-md-6"><h6 class="motto form-check-inline" style="color:rgba(242, 112, 156, 0.7)">Tempérament :</h6> <?php echo $prevCons[$i]['temp']; ?></div>
                                        <div class="col-md-6"><h6 class="motto form-check-inline" style="color:rgba(242, 112, 156, 0.7)">Notes :</h6> <?php echo $prevCons[$i]['cNotes']; ?></div>
                                        <div class="col-md-6"><h6 class="motto form-check-inline" style="color:rgba(242, 112, 156, 0.7)">Poids :</h6> <?php echo $prevCons[$i]['weight']; ?> kg   </div>
                                    </div> 
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
                                <?php 
                                }
                                ?>
</div>

<?php
                        }else {
                            echo alert("Aucune consultation effectuée avec ce patient");
                        }
                        ?>
                        
                </div>

               </div>