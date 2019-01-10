<?php
/* Je ne veux QUE les jours de disponibles. C'est MA fonction. Copyright */
    function daysAvailable($workDays){
        if(!empty($workDays)){
            for($i=0;$i<count($workDays);$i++){
                $workingDays[] = implode("",$workDays[$i]);
            }
            $workingDays = implode("",$workingDays);
            $days = array("Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
            for($i=0;$i<count($days);$i++){
                if(!strchr($workingDays,$days[$i])){
                    $daysAvailable[] = $days[$i];
                }
            }
            return $daysAvailable;
        } else {
        $days = array("Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
        return $days;
        }
    }
?>