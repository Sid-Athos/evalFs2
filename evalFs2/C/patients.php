<?php

    $page = "Patients";
    include('M/dbConnect.php');
    include('M/getSql.php');
    include('M/otherSql.php');
    include('C/Functions/PHP/messages.php');
    $actualDate = actualDate($db);
    include('V/_template/htmlTop.php');
    include('V/_template/navbar.php');
    $query = 
    "SELECT *
    FROM CATEGORYS;";
    
    $cats = fetchNoSets($db,$query);
    $query =
    "SELECT PATIENTS.patientName as name, PATIENTS.ID as ID,OWNERS.lastName as owName, OWNERS.firstName as owFirst, OWNERS.phone as owPhone
    FROM PATIENTS
    JOIN CLIENTS_HAS_PATIENTS AS CHP ON PATIENTS.ID = CHP.patientID
    JOIN OWNERS ON CHP.ownerID = OWNERS.ID;";

    $patients = fetchNoSets($db,$query);
    
    unset($query);

    $query =
    "SELECT *
    FROM SEX";

    $sex = fetchNoSets($db,$query);

    unset($query);

    $query =
    "SELECT ID, CONCAT(lastName,' ',firstName) as name
    FROM OWNERS";

    $owners = fetchNoSets($db,$query);
    $query =
    "SELECT *
    FROM ORIGINS";

    $origins = fetchNoSets($db,$query);
    $today = date('Y-m-j');
    $todays = date('Y-m-d',strtotime('+1 day'));
    $messages = array();
    switch(isset($_POST)):
                case(isset($_POST['modPat'])):
                if(!empty($_POST['birthDate']))
                {
                (preg_match("/^[0-9]{4}[-]{1}[0-1]{1}[0-9]{1}[-]{1}[0-3]{1}[0-9]{1}$/", $_POST['birthDate'])) ?  $messages = $messages : $messages[] = alert("Date de naissance incorrecte incorrect !");
                }
                if(!empty($_POST['patLs']))
                {
                (preg_match("/^[A-Za-z0-9\s\'\-\+]+$/", $_POST['patLs'])) ?  $messages = $messages : $messages[] = alert("Mode de vie incorrect !");
                }
                if(!empty($_POST['patFood']))
                {

                    (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\+]+$/", $_POST['patFood'])) ?  $messages = $messages : $messages[] = alert("Mode de vie client incorrect !");
                }
                foreach($_POST as $key => $val)
                {
                    $_POST[$key] = htmlspecialchars($_POST[$key]);
                }
                if(count($messages) === 0){
                    if(!empty($_POST['birthDate'])){
                    $query =
                    "UPDATE PATIENTS
                    SET birthDate = :set1
                    WHERE ID = :set2";
                    if(twoSets($db,$query,$_POST['birthDate'],$_POST['modPat'])){
                        $messages[] = success("Date de naissance modifiée");
                    }
                }
                    if(!empty($_POST['patLs'])){
                    $query =
                    "UPDATE PATIENTS
                    SET lifeStyle = :set1
                    WHERE ID = :set2;";
                    if(twoSets($db,$query,$_POST['patLs'],$_POST['modPat'])){
                        $messages[] = success("Date de naissance modifiée");
                    }}

                    if(!empty($_POST['patFood'])){
                    $query =
                    "UPDATE PATIENTS
                    SET food = :set1
                    WHERE ID = :set2";
                    if(twoSets($db,$query,$_POST['patFood'],$_POST['modPat'])){
                        $messages[] = success("Date de naissance modifiée");
                    }
                }
                    if(!empty($_POST['sexID'])){

                        $query =
                        "UPDATE PATIENTS
                        SET sexID = :set1
                        WHERE ID = :set2";
                        if(twoSets($db,$query,$_POST['sexID'],$_POST['modPat'])){
                            $messages[] = success("Sexe modifié");
                        }
                    }

                    if(!empty($_POST['respPhone'])){
                        if(preg_match("/^[0-9]{10}$/",$_POST['respPhone'])){
                        $query =
                        "UPDATE OWNERS
                        SET phone = :set1
                        WHERE ID = ANY(SELECT DISTINCT OWNERS.ID
                        FROM OWNERS JOIN CLIENTS_HAS_PATIENTS AS CHP ON CHP.ownerID = OWNERS.ID WHERE CHP.patientID = :set2);";
                        if(twoSets($db,$query,$_POST['respPhone'],$_POST['modPat'])){
                            $messages[] = success("Date de naissance modifiée");
                        }
                    }
                }

                if(!empty($_POST['respEmail'])){
                    if(preg_match("/^[a-zA-Z0-9\.]{2,26}@[a-z]{2,6}[.]{1}[a-z]{2,5}$/",$_POST['respEmail'])){
                    $query =
                    "UPDATE OWNERS
                    SET email = :set1
                    WHERE ID = ANY(SELECT DISTINCT CHP.ownerID
                    FROM CLIENTS_HAS_PATIENTS AS CHP WHERE CHP.patientID = :set2);";
                    if(twoSets($db,$query,$_POST['respEmail'],$_POST['modPat'])){
                        $messages[] = success("Date de naissance modifiée");
                    }
                }
            }

                }
                $query =
                    "SELECT PATIENTS.ID as patID, PATIENTS.patientName, PATIENTS.birthDate, OWNERS.email, OWNERS.lastName, OWNERS.firstName, SEX.name AS sexName,SEX.ID as sexID,
                    OWNERS.address, OWNERS.postCode, OWNERS.city, OWNERS.phone, PATIENTS.lifeStyle as lifeS, PATIENTS.food AS patFood, PATIENTS.breed as origins, ORIGINS.name AS origin, PATIENTS.breed as breed
                    FROM APPOINTMENTS 
                    JOIN BELONGS ON BELONGS.appointmentID = APPOINTMENTS.ID 
                    JOIN CATEGORYS ON BELONGS.categoryID = CATEGORYS.ID
                    JOIN PATIENT_HAS_APPOINTMENTS AS PHA ON PHA.appointmentID = APPOINTMENTS.ID
                    JOIN PATIENTS ON PHA.patientID = PATIENTS.ID
                    JOIN CLIENTS_HAS_PATIENTS AS CHP ON CHP.patientID = PATIENTS.ID
                    JOIN OWNERS ON OWNERS.ID = CHP.ownerID
                    JOIN USER_HAS_APPS ON APPOINTMENTS.ID = user_has_apps.appointmentID
                    JOIN SEX ON SEX.ID = PATIENTS.sexID
                    JOIN ORIGINS ON ORIGINS.ID = PATIENTS.originID
                    WHERE USER_HAS_APPS.userID = :set1 GROUP BY PATIENTS.ID
                    ORDER BY APPOINTMENTS.appDay,APPOINTMENTS.startTime
                    ;";

                    $res = fetchOneSet($db,$query,$_SESSION['ID']);
                    for($i = 0;$i < count($res);$i++)
                    {
                        $query =
                        "SELECT SEX.ID, SEX.name
                        FROM SEX 
                        WHERE SEX.ID != :set1;";
            
                        $sexes[] = fetchOneSet($db,$query,$res[$i]['sexID']);
                    }
                    
                    include('V/_template/showPatients.php');
            break;
        case(isset($_POST['patientID'])):
                $query = 
                "SELECT APPOINTMENTS.ID as appId, APPOINTMENTS.name as appName, dayofmonth(APPOINTMENTS.appDay) as dayNum, monthname(appDay) as monthName,  PATIENTS.breed as breed,
                year(appDay) as years, dayname(appDay) as dayName, PATIENTS.ID as patID, APPOINTMENTS.startTime, APPOINTMENTS.place, APPOINTMENTS.notes, CONSULTATIONS.ID as consID, ORIGINS.name AS origin,
                CONSULTATIONS.reason, CONSULTATIONS.food, CONSULTATIONS.mindState as mState,CONSULTATIONS.phyState AS pState, CONSULTATIONS.temper as temp,CONSULTATIONS.notes as cNotes, 
                CONSULTATIONS.weight, CONSULTATIONS.recommandations AS recs, DATE(CONSULTATIONS.consDate) AS consDate, TIME(CONSULTATIONS.consDate) as consH
                FROM APPOINTMENTS 
                JOIN CONSULTATIONS AS CONSULTATIONS ON CONSULTATIONS.appointmentID = APPOINTMENTS.ID
                JOIN PATIENT_HAS_APPOINTMENTS AS PHA ON PHA.appointmentID = APPOINTMENTS.ID
                JOIN PATIENTS ON PHA.patientID = PATIENTS.ID
                JOIN ORIGINS ON ORIGINS.ID = PATIENTS.originID
                JOIN USER_HAS_APPS ON APPOINTMENTS.ID = USER_HAS_APPS.appointmentID
                JOIN SEX ON SEX.ID = PATIENTS.sexID
                WHERE PATIENTS.ID = :set1
                AND USER_HAS_APPS.userID = :set2
                ORDER BY DATE(CONSULTATIONS.consDate), TIME(CONSULTATIONS.consDate) DESC;";

                $prevCons = fetchTwoSets($db,$query,$_POST['patientID'],$_SESSION['ID']);
                
                $query =
                "SELECT ZONES.name, ZONES.zonePath as zonePath
                FROM ZONES
                JOIN ZONE_HANDLED ON ZONES.ID = ZONE_HANDLED.zoneID
                WHERE ZONE_HANDLED.consultationID = :set1;";
                $zones = array();
                for($z = 0;$z < count($prevCons);$z++){
                    $zones[] = fetchOneSet($db,$query,$prevCons[$z]['consID']);
                }
                include('V/_template/showConsults.php');
            break;
        default:
            $query =
            "SELECT PATIENTS.ID as patID, PATIENTS.patientName, PATIENTS.birthDate, OWNERS.email, OWNERS.lastName, OWNERS.firstName, SEX.name AS sexName,SEX.ID as sexID,
            OWNERS.address, OWNERS.postCode, OWNERS.city, OWNERS.phone, PATIENTS.lifeStyle as lifeS, PATIENTS.food AS patFood, ORIGINS.name AS origin, PATIENTS.breed as breed
            FROM APPOINTMENTS 
            JOIN BELONGS ON BELONGS.appointmentID = APPOINTMENTS.ID 
            JOIN CATEGORYS ON BELONGS.categoryID = CATEGORYS.ID
            JOIN PATIENT_HAS_APPOINTMENTS AS PHA ON PHA.appointmentID = APPOINTMENTS.ID
            JOIN PATIENTS ON PHA.patientID = PATIENTS.ID
            JOIN CLIENTS_HAS_PATIENTS AS CHP ON CHP.patientID = PATIENTS.ID
            JOIN OWNERS ON OWNERS.ID = CHP.ownerID
            JOIN USER_HAS_APPS ON APPOINTMENTS.ID = user_has_apps.appointmentID
            JOIN SEX ON SEX.ID = PATIENTS.sexID
            JOIN ORIGINS ON ORIGINS.ID = PATIENTS.originID
            WHERE USER_HAS_APPS.userID = :set1 GROUP BY PATIENTS.ID
            ORDER BY APPOINTMENTS.appDay,APPOINTMENTS.startTime
            ;";

            $res = fetchOneSet($db,$query,$_SESSION['ID']);
            for($i = 0;$i < count($res);$i++)
            {
                $query =
                "SELECT SEX.ID, SEX.name
                FROM SEX 
                WHERE SEX.ID != :set1;";
    
                $sexes[] = fetchOneSet($db,$query,$res[$i]['sexID']);
            }
            
            include('V/_template/showPatients.php');
    endswitch;
    include('V/_template/appsModal.php');

?>