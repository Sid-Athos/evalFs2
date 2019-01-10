<?php 

    // Déjà on vacommencer par un copyright
    $timestamp = strtotime($ym);  
    if ($timestamp === false) {
        $ym = date('Y-m');
        $timestamp = strtotime($ym . '-01');
    }
    $today = date('Y-m-j');
    $todays = date('Y-m-d',strtotime('+1 day'));
    //$day = date('')
    $title = utf8_encode(ucfirst(strftime('%B,  %Y', $timestamp)));
    $prev = date('Y-m', strtotime('-1 month', $timestamp));
    $next = date('Y-m', strtotime('+1 month', $timestamp));
    // Number of days in the month
    $daysCount = date('t', $timestamp);
    // 1:Mon 2:Tue 3: Wed ... 7:Sun
    $str = date('N', $timestamp);
    $week = '';
    // Add empty cell(s)
    $week = $week.str_repeat('<td style=""></td>', $str - 1);
    $color = "none";
    $z = 0;
    $lazy = 0;
    for ($day = 1; $day <= $daysCount; $day++, $str++) {
        ($day < 10) ? $days = "0$day" : $days = $day;
        $date = "$ym-$day";
        $dates = "$ym-$days";
        if(isset($offs[$z]) && !empty($offs)){
            if(strtotime($date) >= strtotime($offs[$z]['starts'])
            && strtotime($date) <= strtotime($offs[$z]['ends'])) {
                        $week = $week."<td style='background-color:rgba(166, 148, 229, 0.6);min-width:200px;width:200px;height:120px;min-height:250px'
                        data-toggle='tooltip' data-placement='top' title='Congé'>$day</td>";
                    } else {
                        if(isset($offs[($z+1)])){
                            $z++;
                        }

                        if(!in_array(intval(date('N',strtotime($date))),$noApps)){
                            $week = $week."<td style='background-color:rgba(66, 66, 63, 0.2);min-width:190px'
                            data-toggle='tooltip' data-placement='top' title='Jour de repos'>$day</td>";
                            $lazy++;
                        } 
                        else 
                        {

                             if ($today == $date) {
                                 $week .= '<td class="today" data-toggle="tooltip" data-placement="left" title="Ajd" style="background-color:rgba(18,239,56,0.4);">';
                             } else {
                                 $week .= '<td style="">';
                             }
                             $found = false;
                             for($i = 0; $i < count($apps);$i++)
                             {
                                if($dates === $apps[$i]['appDay'])
                                {
                                    $color = "";
                                    $week = "$week
                                            <div class='row'>
                                                <div class='col-lg-12' style='margin:auto'>
                                                    <form method='post' class='form-check-inline' style='position: relative;top: 10px;'>
                                                        <button type='submit' class='btn btn-secondary form-check form-check-inline'  name='fetchApps' value='$date'
                                                        data-toggle='tooltip' data-placement='top' title='Afficher les évènements de la journée'
                                                        style='text-align:center;left:10px;font-size:14px' onclick='getMyApps($day,event);'>$day</button>
                                                        <button type='submit' class='btn btn-secondary form-check form-check-inline' name='addApps' value='$date' 
                                                        data-toggle='tooltip' data-placement='top' title='Ajouter un évènement' style='text-align:center;left:20px;font-size:14px;width:auto'
                                                        onclick='select($day,event);'>Ajouter un évènement <i class='now-ui-icons ui-1_simple-add form-check-inline' style='color:#4ca1af'></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-lg-12'>
                                                    <div class='alert alert-info ml-auto mr-auto' id='alert$day' role='alert' style='z-index:4;background-color:#833ab4;
                                                    text-align:center;height:85px;color:#FFFFFF;margin-bottom:-12px;vertical-align:bottom;width:102%;left:-2px;right:0px'>
                                                        <div class='alert-icon'>
                                                        </div>
                                                        <form method='post' id='fetchAllApps$day' class='form-check-inline'>
                                                            <i class='fa fa-circle' aria-hidden='true' id='past$dates' style='display:$color;margin-top:10px;color:#FDC830'></i>
                                                            <button type='submit' class='btn btn-secondary form-check form-check-inline bg-transparent ml-auto mr-auto' 
                                                            style='position:relative;box-sizing:unset;outline:inherit;color:#FFFFFF;vertical-align:bottom;top:25px;text-align:center;left:15px;'  
                                                            name='fetchApps'  value='$date' onclick='getMyApps($day,event);'
                                                            data-toggle='tooltip' data-placement='left' title='Afficher les évènements de la journée' id='date$day'>
                                                            <span id='apps$dates'>".$apps[$i]['compteur']."</span> évènement(s) prévu(s) 
                                                            </button>
                                                            <button type='button' class='close' id='kill$day'  style='position:relative;right:-15px;color:#FFFFFF' value='$date'
                                                            data-toggle='tooltip' data-placement='right' title='Supprimer tous les évènements de la journée' onclick='deleteApps(this.value,event)'>
                                                                <span aria-hidden='true' >
                                                                    <i class='now-ui-icons ui-1_simple-remove' ></i>
                                                                </span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>";
                                     $found = true;
                                    } 
                                } 
                                $color = "none";
                     
                                if($found === false)
                                {
                                    $week = "$week
                                        <div class='row'>
                                            <div class='col-lg-12' style='margin:auto'>
                                                <form method='post' class='form-check-inline'  style='position: relative;top: 10px;'>
                                                    <button type='submit' class='btn btn-secondary form-check form-check-inline'  name='fetchApps' value='$date'
                                                    data-toggle='tooltip' data-placement='top' title='Afficher les évènements de la journée'
                                                    style='text-align:center;left:10px;font-size:14px' onclick='getMyApps($day,event);'>$day</button>
                                                    <button type='submit' class='btn btn-secondary form-check form-check-inline' name='addApps' value='$date' 
                                                    data-toggle='tooltip' data-placement='top' title='Ajouter un évènement' style='text-align:center;left:20px;font-size:14px;width:auto'
                                                    onclick='select($day,event);'>Ajouter un évènement <i class='now-ui-icons ui-1_simple-add form-check-inline' style='color:#4ca1af'></i></button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-lg-12'>
                                                <div class='alert alert-info ml-auto mr-auto' id='alert$day' role='alert' style='z-index:4;
                                                text-align:center;height:85px;color:#FFFFFF;margin-bottom:-12px;vertical-align:bottom;width:102%;left:-2px;right:0px'>
                                                    <div class='alert-icon'>
                                                    </div>
                                                    <form method='post'  class='form-check-inline'>
                                                        <i class='fa fa-circle' aria-hidden='true' id='past$dates' style='display:$color;margin-top:10px;color:#FDC830'></i>
                                                        <button type='submit' class='btn btn-secondary form-check form-check-inline bg-transparent ml-auto mr-auto' 
                                                        style='position:relative;box-sizing:unset;outline:inherit;color:#FFFFFF;vertical-align:bottom;top:25px;text-align:center;left:15px;'  name='fetchApps'  value='$date'
                                                        data-toggle='tooltip' data-placement='left' title='Afficher les évènements de la journée' id='date$day' onclick='getMyApps($day,event);'>
                                                        <span id='apps$dates'>0</span> évènement(s) prévu(s) 
                                                        </button>
                                                        <button type='button' class='close' id='kill$day'  style='position:relative;right:-15px;color:#FFFFFF'
                                                        data-toggle='tooltip' data-placement='right' value='$date' title='Supprimer tous les évènements de la journée' onclick='deleteApps(this.value,event)'>
                                                            <span aria-hidden='true' >
                                                                <i class='now-ui-icons ui-1_simple-remove' ></i>
                                                            </span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>";
                                }
                        }
                         
                        
               
    
                }

            } else {
                if(!in_array(intval(date('N',strtotime($date))),$noApps)){
                    $week = $week."<td style='background-color:rgba(66, 66, 63, 0.2);min-width:190px'
                    data-toggle='tooltip' data-placement='top' title='Jour de repos'>$day</td>";
                    $lazy++;
                } else {
                            if ($today == $date) {
                                $week .= '<td class="today" data-toggle="tooltip" data-placement="left" title="Ajd" style="background-color:rgba(18,239,56,0.4);">';
                            } else {
                                $week .= '<td style="">';
                            }
                            $found = false;
                            for($i = 0; $i <count($apps);$i++)
                            {
                                if($dates === $apps[$i]['appDay'])
                                {
                                    $color = "";
                                    $week = "$week
                                    <div class='row'>
                                        <div class='col-lg-12' style='margin:auto'>
                                            <form method='post' class='form-check-inline'>
                                                <button type='submit' class='btn btn-secondary form-check form-check-inline'  name='fetchApps' value='$date'
                                                data-toggle='tooltip' data-placement='top' title='Afficher les évènements de la journée'
                                                style='text-align:center;left:10px;font-size:14px' onclick='getMyApps($day,event);'>$day</button>
                                                <button type='submit' class='btn btn-secondary form-check form-check-inline' name='addApps' value='$date' 
                                                data-toggle='tooltip' data-placement='top' title='Ajouter un évènement' style='text-align:center;left:20px;font-size:14px;width:auto'
                                                onclick='select($day,event);'>Ajouter un évènement <i class='now-ui-icons ui-1_simple-add form-check-inline' style='color:#4ca1af'></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-lg-12'>
                                            <div class='alert alert-info ml-auto mr-auto' id='alert$day' role='alert' style='z-index:4;background-color:#833ab4;
                                            text-align:center;height:85px;color:#FFFFFF;margin-bottom:-12px;vertical-align:bottom;width:102%;left:-2px;right:0px'>
                                                <div class='alert-icon'>
                                                </div>
                                                <form method='post' id='fetchAllApps$day' class='form-check-inline'>
                                                    <i class='fa fa-circle' aria-hidden='true' id='past$dates' style='display:$color;margin-top:10px;color:#FDC830'></i>
                                                    <button type='submit' class='btn btn-secondary form-check form-check-inline bg-transparent ml-auto mr-auto' 
                                                    style='position:relative;box-sizing:unset;outline:inherit;color:#FFFFFF;vertical-align:bottom;top:25px;text-align:center;left:15px;'  
                                                    name='fetchApps'  value='$date' onclick='getMyApps($day,event);'
                                                    data-toggle='tooltip' data-placement='left' title='Afficher les évènements de la journée' id='date$day'>
                                                    <span id='apps$dates'>".$apps[$i]['compteur']."</span> évènement(s) prévu(s) 
                                                    </button>
                                                    <button type='button' class='close' id='kill$day'  style='position:relative;right:-15px;color:#FFFFFF' value='$date'
                                                    data-toggle='tooltip' data-placement='right' title='Supprimer tous les évènements de la journée' onclick='deleteApps(this.value,event)'>
                                                        <span aria-hidden='true' >
                                                            <i class='now-ui-icons ui-1_simple-remove' ></i>
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>";
                                    $found = true;
                                } 
                            }    
                            $color = "none";
            
                            if($found === false)
                            {
                                $week = "$week
                                    <div class='row'>
                                        <div class='col-lg-12' style='margin:auto'>
                                            <form method='post' class='form-check-inline'>
                                                <button type='submit' class='btn btn-secondary form-check form-check-inline'  name='fetchApps' value='$date'
                                                data-toggle='tooltip' data-placement='top' title='Afficher les évènements de la journée'
                                                style='text-align:center;left:10px;font-size:14px' onclick='getMyApps($day,event);'>$day</button>
                                                <button type='submit' class='btn btn-secondary form-check form-check-inline' name='addApps' value='$date' 
                                                data-toggle='tooltip' data-placement='top' title='Ajouter un évènement' style='text-align:center;left:20px;font-size:14px;width:auto'
                                                onclick='select($day,event);'>Ajouter un évènement <i class='now-ui-icons ui-1_simple-add form-check-inline' style='color:#4ca1af'></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-lg-12'>
                                            <div class='alert alert-info ml-auto mr-auto' id='alert$day' role='alert' style='z-index:4;
                                            text-align:center;height:85px;color:#FFFFFF;margin-bottom:-12px;vertical-align:bottom;width:102%;left:-2px;right:0px'>
                                                <div class='alert-icon'>
                                                </div>
                                                <form method='post'  class='form-check-inline'>
                                                    <i class='fa fa-circle' aria-hidden='true' id='past$dates' style='display:$color;margin-top:10px;color:#FDC830'></i>
                                                    <button type='submit' class='btn btn-secondary form-check form-check-inline bg-transparent ml-auto mr-auto' 
                                                    style='position:relative;box-sizing:unset;outline:inherit;color:#FFFFFF;vertical-align:bottom;top:25px;text-align:center;left:15px;'  name='fetchApps'  value='$date'
                                                    data-toggle='tooltip' data-placement='left' title='Afficher les évènements de la journée' id='date$day' onclick='getMyApps($day,event);'>
                                                    <span id='apps$dates'>0</span> évènement(s) prévu(s) 
                                                    </button>
                                                    <button type='button' class='close' id='kill$day'  style='position:relative;right:-15px;color:#FFFFFF'
                                                    data-toggle='tooltip' data-placement='right' value='$date' title='Supprimer tous les évènements de la journée' onclick='deleteApps(this.value,event)'>
                                                        <span aria-hidden='true' >
                                                            <i class='now-ui-icons ui-1_simple-remove' ></i>
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>";
                            }
                        }
                    }
            


        // end else if intvaldaten

        
        if ($str % 7 == 0 || $day == $daysCount) {
            if ($day == $daysCount && $str % 7 != 0) {
                $week = $week.str_repeat('<td style=""></td>', 7 - $str % 7);
            }
            $weeks[] = "<tr>$week</tr>";
            $week = '';
        }
    }
        
?>