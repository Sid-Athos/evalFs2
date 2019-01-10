<?php
    function sqlDates($date){
        $date = explode("-",$date);
        $date = $date[2]."-".$date[1]."-".$date[0];
        return $date;
    }
?>