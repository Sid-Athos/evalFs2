<?php

    include('M/dbConnect.php');

    include('M/otherSql.php');

    $query =
    "INSERT INTO CONSULTATIONS(reason,mindState,phyState,temper,notes,weight,recommandations,appointmentID)
    VALUES(:set1,:set2,:set3,:set4,:set5,:set6,:set7,:set8);";

    for($i = 0; $i < 15; $i++){
        heightSets($db,$query,"dsdsq","fuisdtgriu","duysqduy","dsuqygdsuqyd","dsqdsqd","150,5","dsqdsqd",1);
    }
?>