<?php
    $page = "Rendez-vous";
    include('M/getSql.php');
    include('M/otherSql.php');
    include('C/Functions/PHP/messages.php');
    include('C/Functions/PHP/sessionCheck.php');
    $actualDate = actualDate($db);

    $messages = array();
    
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
    FROM ORIGINS";

    $origins = fetchNoSets($db,$query);
    $query =
    "SELECT *
    FROM SEX";

    $sex = fetchNoSets($db,$query);

    unset($query);

    $query =
    "SELECT ID, CONCAT(lastName,' ',firstName) as name
    FROM OWNERS";

    $owners = fetchNoSets($db,$query);
    $today = date('Y-m-j');
    $todays = date('Y-m-d',strtotime('+1 day'));
    switch(isset($_POST)):
        case(isset($_POST['consult'])):
                $query = 
                "SELECT APPOINTMENTS.ID as appId, APPOINTMENTS.name as appName, dayofmonth(APPOINTMENTS.appDay) as dayNum, monthname(appDay) as monthName, 
                year(appDay) as years, dayname(appDay) as dayName, PATIENTS.ID as patID, APPOINTMENTS.startTime, APPOINTMENTS.place, APPOINTMENTS.notes, 
                CATEGORYS.name, PATIENTS.patientName, PATIENTS.birthDate, OWNERS.email, OWNERS.lastName, OWNERS.firstName, SEX.name AS sexName,
                OWNERS.address, OWNERS.postCode, OWNERS.city, OWNERS.phone, PATIENTS.lifeStyle as lifeS, PATIENTS.food AS patFood,  ORIGINS.name AS origin, PATIENTS.breed as breed
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
                WHERE APPOINTMENTS.ID = :set1
                AND APPOINTMENTS.status = 1
                ORDER BY APPOINTMENTS.appDay,APPOINTMENTS.startTime;";
                include('V/_template/htmlTop.php');
                include('V/_template/navbar.php');
                $res = fetchOneSet($db,$query,$_POST['consult']);
                $_SESSION['app'] = $_POST['consult'];

                $query = 
                "SELECT APPOINTMENTS.ID as appId, APPOINTMENTS.name as appName, dayofmonth(APPOINTMENTS.appDay) as dayNum, monthname(appDay) as monthName, CONSULTATIONS.ID as consID,
                year(appDay) as years, dayname(appDay) as dayName, PATIENTS.ID as patID, APPOINTMENTS.startTime, APPOINTMENTS.place, APPOINTMENTS.notes, ORIGINS.name AS origin, PATIENTS.breed as breed,
                CONSULTATIONS.reason, CONSULTATIONS.food, CONSULTATIONS.mindState as mState,CONSULTATIONS.phyState AS pState, CONSULTATIONS.temper as temp,CONSULTATIONS.notes as cNotes, CONSULTATIONS.weight, CONSULTATIONS.recommandations AS recs, DATE(CONSULTATIONS.consDate) AS consDate, TIME(CONSULTATIONS.consDate) as consH
                FROM APPOINTMENTS 
                JOIN CONSULTATIONS AS CONSULTATIONS ON CONSULTATIONS.appointmentID = APPOINTMENTS.ID
                JOIN PATIENT_HAS_APPOINTMENTS AS PHA ON PHA.appointmentID = APPOINTMENTS.ID
                JOIN PATIENTS ON PHA.patientID = PATIENTS.ID
                JOIN USER_HAS_APPS ON APPOINTMENTS.ID = USER_HAS_APPS.appointmentID
                JOIN SEX ON SEX.ID = PATIENTS.sexID
                JOIN ORIGINS ON ORIGINS.ID = PATIENTS.originID
                WHERE PATIENTS.ID = :set1
                AND APPOINTMENTS.status = 1
                AND USER_HAS_APPS.userID = :set2
                ORDER BY DATE(CONSULTATIONS.consDate), TIME(CONSULTATIONS.consDate) DESC;";

                $prevCons = fetchTwoSets($db,$query,$res[0]['patID'],$_SESSION['ID']);
                $query = 
                "SELECT ZONES.name
                FROM ZONE_HANDLED AS ZH
                JOIN ZONES ON ZONES.ID = ZH.zoneID
                WHERE ZH.consultationID = :set1;";
                $prevZones = array();
                for($i = 0;$i < count($prevCons);$i++)
                {
                    $prevZones[] = fetchOneSet($db,$query,$prevCons[$i]['consID']);     
                }
                $query =
                "SELECT ID, name
                FROM ZONES;";

                $zones = fetchNoSets($db,$query);
                include('V/_template/consultations.php');

            break;
        case(isset($_POST['choice'])):
                $today = date('Y-m-j');
                if($_POST['choice'] ==='todayApps')
                {
                    $query = 
                    "SELECT APPOINTMENTS.ID as appId, APPOINTMENTS.name as appName, dayofmonth(APPOINTMENTS.appDay) as dayNum, monthname(appDay) as monthName, 
                    year(appDay) as years, dayname(appDay) as dayName, PATIENTS.ID as patID, APPOINTMENTS.startTime, APPOINTMENTS.place, APPOINTMENTS.notes, 
                    CATEGORYS.name, PATIENTS.patientName, PATIENTS.birthDate, OWNERS.email, OWNERS.lastName, OWNERS.firstName,
                    OWNERS.address, OWNERS.postCode, OWNERS.city, OWNERS.phone
                    FROM APPOINTMENTS 
                    JOIN BELONGS ON BELONGS.appointmentID = APPOINTMENTS.ID 
                    JOIN CATEGORYS ON BELONGS.categoryID = CATEGORYS.ID
                    JOIN PATIENT_HAS_APPOINTMENTS AS PHA ON PHA.appointmentID = APPOINTMENTS.ID
                    JOIN PATIENTS ON PHA.patientID = PATIENTS.ID
                    JOIN CLIENTS_HAS_PATIENTS AS CHP ON CHP.patientID = PATIENTS.ID
                    JOIN OWNERS ON OWNERS.ID = CHP.ownerID
                    JOIN USER_HAS_APPS ON APPOINTMENTS.ID = user_has_apps.appointmentID
                    WHERE APPOINTMENTS.appDay = :set1
                    AND USER_HAS_APPS.userID = :set2
                    ORDER BY APPOINTMENTS.appDay,APPOINTMENTS.startTime;";

                    $res = fetchTwoSets($db,$query,$today,$_SESSION['ID']);
                    include('V/_template/htmlTop.php');
                    include('V/_template/navbar.php');
                    include('V/_template/beforeCards.php');
                    include('V/_template/appDetailsCards.php');
                    include('V/_template/afterCards.php');
                    echo "</div>";
                } else if($_POST['choice'] === 'weekApps'){
                    $query = 
                    "SELECT APPOINTMENTS.ID as appId, APPOINTMENTS.name as appName, dayofmonth(APPOINTMENTS.appDay) as dayNum, monthname(appDay) as monthName, 
                    year(appDay) as years, dayname(appDay) as dayName, PATIENTS.ID as patID, APPOINTMENTS.startTime, APPOINTMENTS.place, APPOINTMENTS.notes, 
                    CATEGORYS.name, PATIENTS.patientName, PATIENTS.birthDate, OWNERS.email, OWNERS.lastName, OWNERS.firstName,
                    OWNERS.address, OWNERS.postCode, OWNERS.city, OWNERS.phone
                    FROM APPOINTMENTS 
                    JOIN BELONGS ON BELONGS.appointmentID = APPOINTMENTS.ID 
                    JOIN CATEGORYS ON BELONGS.categoryID = CATEGORYS.ID
                    JOIN PATIENT_HAS_APPOINTMENTS AS PHA ON PHA.appointmentID = APPOINTMENTS.ID
                    JOIN PATIENTS ON PHA.patientID = PATIENTS.ID
                    JOIN CLIENTS_HAS_PATIENTS AS CHP ON CHP.patientID = PATIENTS.ID
                    JOIN OWNERS ON OWNERS.ID = CHP.ownerID
                    JOIN USER_HAS_APPS ON APPOINTMENTS.ID = user_has_apps.appointmentID
                    WHERE WEEK(APPOINTMENTS.appDay) = WEEK(:set1)
                    AND USER_HAS_APPS.userID = :set2
                    ORDER BY APPOINTMENTS.appDay,APPOINTMENTS.startTime;";
                
                    $res = fetchTwoSets($db,$query,$today,$_SESSION['ID']);
                    include('V/_template/htmlTop.php');
                    include('V/_template/navbar.php');
                    include('V/_template/beforeCards.php');
                    include('V/_template/appWeekCards.php');
                    echo "</div>";
                } else {
                    header("Location: index.php?page=error");
                }
            break;
        case(isset($_POST['regCons'])):
                $count = 0;
                
                foreach($_POST as $key => $val){
                    if($_POST[$key] === "consWeight"){
                        if(preg_match("/^[0-9\,\.]+$/",$_POST[$key])){
                            $count++;
                        }
                    } else if($key === "zonesIn") {
                        $count++;
                    }else {
                        if(preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\+]+$/",$_POST[$key]))
                        {
                            $count++;
                        }
                    }
                }
                if($count === count($_POST)){
                    $query =
                    "INSERT INTO CONSULTATIONS(reason,mindState,phyState,temper,notes,weight,recommandations,appointmentID)
                    VALUES(:set1,:set2,:set3,:set4,:set5,:set6,:set7,:set8);";
                    if(heightSets($db,$query,$_POST['consReas'],$_POST['consMind'],$_POST['consPhy'],$_POST['consTemp'],$_POST['consNotes'],$_POST['consWeight'],$_POST['diagnosis'],$_POST['regCons'])){
                        $_SESSION['app'] = 1;
                        echo success("Consultation enregistrée");
                        $consID = $db -> lastInsertId();

                        $query = 
                        "INSERT INTO ZONE_HANDLED(zoneID,consultationID)
                        VALUES(:set1,:set2);";

                        if(isset($_POST['zonesIn'])){
                            for($i = 0;$i < count($_POST['zonesIn']);$i++){
                                twoSets($db,$query,$_POST['zonesIn'][$i],$_POST['regCons']);
                            }
                        }
                        
                        $query =
                        "UPDATE APPOINTMENTS SET status = 0
                        WHERE ID = :set1;";

                        oneSet($db,$query,$_SESSION['app']);

                        header("Location: index.php?page=calendar");
                        echo success("Consultation enregistrée");
                    } 
                } else {
                    include('V/_template/htmlTop.php');
                        include('V/_template/navbar.php');
                    echo alert("Erreur dans le formulaire");
                }
            break;
        case(isset($_POST['modApp']) && preg_match("/^[0-9]+$/",$_POST['modApp'])):

                if(preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\+]+$/",$_POST['newName'])){
                    $query =
                    "UPDATE APPOINTMENTS
                    SET name = :set1
                    WHERE ID = :set2;";

                    if(twoSets($db,$query,$_POST['newName'],$_POST['modApp']))
                    {
                        $messages[] = success("Nom modifié, le nouveau nom est ".$_POST['newName']."!");
                    } else {
                        $messages[] = alert("Erreur lors de la requête...");
                    }
                } else {
                    $messages[] = alert("Catégorie invalide !") ;
                }

                if(preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\+]+$/",$_POST['newNotes'])){
                    $query =
                    "UPDATE APPOINTMENTS
                    SET notes = :set1
                    WHERE ID = :set2;";

                    if(twoSets($db,$query,$_POST['newNotes'],$_POST['modApp']))
                    {
                        $messages[] = success("Notes modifiées!");
                    } else {
                        $messages[] = alert("Erreur lors de la requête...");
                    }
                } else {
                    $messages[] = alert("Notes invalides !") ;
                }

                if(preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\+]+$/",$_POST['newPlace'])){
                    $query =
                    "UPDATE APPOINTMENTS
                    SET place = :set1
                    WHERE ID = :set2;";

                    if(twoSets($db,$query,$_POST['newPlace'],$_POST['modApp']))
                    {
                        $messages[] = success("Lieu modifié, le nouvel endroit est situé au ".$_POST['newPlace']."!");
                    } else {
                        $messages[] = alert("Erreur lors de la requête...");
                    }
                } else {
                    $messages[] = alert("Catégorie invalide !") ;
                }


                if((!empty($_POST['newTime']) && (strtotime($_POST['newTime']) < strtotime("23:59:15")) && (strtotime($_POST['newTime']) >= strtotime("00:00:00")))){
                    $query =
                        "SELECT APPOINTMENTS.ID as appId, APPOINTMENTS.name as appName, dayofmonth(APPOINTMENTS.appDay) as dayNum, monthname(appDay) as monthName, 
                        year(appDay) as years, dayname(appDay) as dayName, PATIENTS.ID as patID, APPOINTMENTS.startTime, APPOINTMENTS.place as place, APPOINTMENTS.notes, 
                        CATEGORYS.name AS appCat, CATEGORYS.ID as catId, PATIENTS.patientName, PATIENTS.birthDate, OWNERS.email, OWNERS.lastName, OWNERS.firstName,
                        OWNERS.address, OWNERS.postCode, OWNERS.city, OWNERS.phone, APPOINTMENTS.appDay as appDay
                        FROM APPOINTMENTS 
                        JOIN BELONGS ON BELONGS.appointmentID = APPOINTMENTS.ID 
                        JOIN CATEGORYS ON BELONGS.categoryID = CATEGORYS.ID
                        JOIN PATIENT_HAS_APPOINTMENTS AS PHA ON PHA.appointmentID = APPOINTMENTS.ID
                        JOIN PATIENTS ON PHA.patientID = PATIENTS.ID
                        JOIN CLIENTS_HAS_PATIENTS AS CHP ON CHP.patientID = PATIENTS.ID
                        JOIN OWNERS ON OWNERS.ID = CHP.ownerID
                        JOIN USER_HAS_APPS ON APPOINTMENTS.ID = user_has_apps.appointmentID
                        WHERE userID = :set1
                        AND appDay = :set2
                        AND (:set3 BETWEEN startTime AND addtime(startTime,'00:30:00')
                        OR startTime Between :set4 AND addtime(:set5,'00:30:00'))
                        AND ID != :set6
                        ORDER BY startTime;";

                        if(!empty($res = fetchSixSets(
                            $db,
                            $query,
                            $_SESSION['ID'],
                            $_POST['newDate'],
                            ($_POST['newTime'].":00"),
                            ($_POST['newTime'].":00"),
                            ($_POST['newTime'].":00"),
                            $_POST['modApp'])))
                        {
                            $messages[] = alert("Le rendez-vous ".$res[0]['name']." à ".$res[0]['startTime']." <br>a déjà été pris ce jour là.");
                            
                        }
                        else 
                        {
                            if(preg_match("/^[0-9]{4}[-]{1}[0-1]{1}[0-9]{1}[-]{1}[0-3]{1}[0-9]{1}$/",$_POST['newDate'])){
                                $query =
                                "UPDATE APPOINTMENTS
                                SET appDay = (
                                    CASE
                                    WHEN :set1 > CURRENT_TIMESTAMP() 
                                    THEN :set1 
                                    ELSE NULL END
                                    )
                                WHERE ID = :set2;";
            
                                if(twoSets($db,$query,$_POST['newDate'],$_POST['modApp']))
                                {
                                    $messages[] = success("Date modifiée, nouvelle date le ".$_POST['newDate']."!");
                                    $query =
                                        "UPDATE APPOINTMENTS
                                        SET startTime = :set1
                                        WHERE ID = :set2;";
        
                                    if(twoSets($db,$query,($_POST['newTime'].":00"),$_POST['modApp']))
                                    {
                                        $messages = success("Heure modifiée, nouvelle date le ".$_POST['newDate']."!");
                                    } else {
                                        $messages[] = alert("Erreur lors de la requête de modification de l'heure et de la durée...");
                                    }
                                } else {
                                    $messages[] = alert("Erreur lors de la requête de modification de la date...");
                                }
                            } else {
                                $messages[] = alert("Date invalide !") ;
                            }

                        }
                } else {
                    $messages[] = alert("La nouvelle heure ou la durée n'est pas au format adéquat !") ;
                }

                $query =
                "SELECT APPOINTMENTS.ID as appId, APPOINTMENTS.name as appName, dayofmonth(APPOINTMENTS.appDay) as dayNum, monthname(appDay) as monthName, 
                year(appDay) as years, dayname(appDay) as dayName, PATIENTS.ID as patID, APPOINTMENTS.startTime, APPOINTMENTS.place as place, APPOINTMENTS.notes, 
                CATEGORYS.name AS appCat, CATEGORYS.ID as catId, PATIENTS.patientName, PATIENTS.birthDate, OWNERS.email, OWNERS.lastName, OWNERS.firstName,
                OWNERS.address, OWNERS.postCode, OWNERS.city, OWNERS.phone, APPOINTMENTS.appDay as appDay
                FROM APPOINTMENTS 
                JOIN BELONGS ON BELONGS.appointmentID = APPOINTMENTS.ID 
                JOIN CATEGORYS ON BELONGS.categoryID = CATEGORYS.ID
                JOIN PATIENT_HAS_APPOINTMENTS AS PHA ON PHA.appointmentID = APPOINTMENTS.ID
                JOIN PATIENTS ON PHA.patientID = PATIENTS.ID
                JOIN CLIENTS_HAS_PATIENTS AS CHP ON CHP.patientID = PATIENTS.ID
                JOIN OWNERS ON OWNERS.ID = CHP.ownerID
                JOIN USER_HAS_APPS ON APPOINTMENTS.ID = user_has_apps.appointmentID
                WHERE APPOINTMENTS.ID = :set1
                ORDER BY APPOINTMENTS.appDay,APPOINTMENTS.startTime;";
                
                
                $res = fetchOneSet($db,$query,$_POST['modApp']);
                unset($query);

                $query = 
                "SELECT CATEGORYS.ID, CATEGORYS.name
                FROM CATEGORYS
               WHERE CATEGORYS.ID != ALL(
                   SELECT BELONGS.categoryID 
                   FROM BELONGS 
                   WHERE BELONGS.appointmentID = :set1);";
                if(isset($messages))
                {

                    for($i = 0;$i <count($messages);$i++){
                        echo $messages[$i];
                    }
                }
                $cats = fetchOneSet($db,$query,$_POST['modApp']);
                include('V/_template/htmlTop.php');
                include('V/_template/navbar.php');
                include('V/_template/editAppsForm.php');
                include('V/_template/appsModal.php');

            break;
        case(isset($_POST['fetchApps'])):
                
                (preg_match("/^[0-9]{4}[-]{1}[0-1]{1}[0-9]{1}[-]{1}[0-3]{1}[0-9]{1}$/", $_POST['fetchApps'])) ? 
                $messages = $messages : $messages[] = alert("Date incorrecte !");

                if(count($messages === 0))
                {
                    $query =
                        "SELECT APPOINTMENTS.ID, APPOINTMENTS.name as appName, dayofmonth(APPOINTMENTS.appDay) as dayNum, monthname(appDay) as monthName, 
                        year(appDay) as years, dayname(appDay) as dayName, APPOINTMENTS.startTime, APPOINTMENTS.place, APPOINTMENTS.notes, APPOINTMENTS.duration
                        ,CATEGORYS.name
                        FROM APPOINTMENTS JOIN CATEGORYS ON APPOINTMENTS.appCat = CATEGORYS.ID
                        WHERE APPOINTMENTS.appDay = :set1
                        AND APPOINTMENTS.userID = :set2
                        ORDER BY APPOINTMENTS.appDay,APPOINTMENTS.startTime;";

                    $res = fetchTwoSets($db,$query,$_POST['fetchApps'],$_SESSION['ID']);

                    include('V/_template/htmlTop.php');
                    include('V/_template/navbar.php');
                    include('V/_template/appDetailsCards.php');
                }

            break;
        case(isset($_POST['editApp'])):

                    if(preg_match("/^[0-9]+$/",$_SESSION['ID']) && preg_match("/^[0-9]+$/",$_POST['editApp']))
                    {
                        $query =
                        "SELECT APPOINTMENTS.ID as appId, APPOINTMENTS.name as appName, dayofmonth(APPOINTMENTS.appDay) as dayNum, monthname(appDay) as monthName, 
                        year(appDay) as years, dayname(appDay) as dayName, PATIENTS.ID as patID, APPOINTMENTS.startTime, APPOINTMENTS.place as place, APPOINTMENTS.notes, 
                        CATEGORYS.name AS appCat, CATEGORYS.ID as catId, PATIENTS.patientName, PATIENTS.birthDate, OWNERS.email, OWNERS.lastName, OWNERS.firstName,
                        OWNERS.address, OWNERS.postCode, OWNERS.city, OWNERS.phone, APPOINTMENTS.appDay as appDay
                        FROM APPOINTMENTS 
                        JOIN BELONGS ON BELONGS.appointmentID = APPOINTMENTS.ID 
                        JOIN CATEGORYS ON BELONGS.categoryID = CATEGORYS.ID
                        JOIN PATIENT_HAS_APPOINTMENTS AS PHA ON PHA.appointmentID = APPOINTMENTS.ID
                        JOIN PATIENTS ON PHA.patientID = PATIENTS.ID
                        JOIN CLIENTS_HAS_PATIENTS AS CHP ON CHP.patientID = PATIENTS.ID
                        JOIN OWNERS ON OWNERS.ID = CHP.ownerID
                        JOIN USER_HAS_APPS ON APPOINTMENTS.ID = user_has_apps.appointmentID
                        WHERE APPOINTMENTS.ID = :set1
                        ORDER BY APPOINTMENTS.appDay,APPOINTMENTS.startTime;";
                        
                        
                        $res = fetchOneSet($db,$query,$_POST['editApp']);
                        unset($query);

                        $query = 
                        "SELECT CATEGORYS.ID, CATEGORYS.name
                        FROM CATEGORYS
                       WHERE CATEGORYS.ID != ALL(
                           SELECT BELONGS.categoryID 
                           FROM BELONGS 
                           WHERE BELONGS.appointmentID = :set1);";

                        $cats = fetchOneSet($db,$query,$_POST['editApp']);
                        include('V/_template/htmlTop.php');
                        include('V/_template/navbar.php');
                        include('V/_template/editAppsForm.php');
                        include('V/_template/appsModal.php');
                    } else {
                        header("Location: index.php?page=login");
                    }
                break;
        default:
            header('Location: index.php?page=error');
    endswitch;
    include('V/_template/appsModal.php');
   
?>