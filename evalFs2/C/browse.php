<?php
   
    $page = "Recherche";
    include('M/dbConnect.php');
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
    FROM SEX";

    $sex = fetchNoSets($db,$query);

    unset($query);

    $query =
    "SELECT ID, CONCAT(lastName,' ',firstName) as name
    FROM OWNERS";
    $query =
    "SELECT *
    FROM ORIGINS";

    $origins = fetchNoSets($db,$query);
    $owners = fetchNoSets($db,$query);
    $today = date('Y-m-j');
    $todays = date('Y-m-d',strtotime('+1 day'));
    include('V/_template/htmlTop.php');
    include('V/_template/navbar.php');
    switch(isset($_POST)):
        case(!empty($_POST)):
                if(isset($_POST['browseDate']) && isset($_POST['dateZone']))
                {
                    if($_POST['dateZone'] === "day"){
                        $query =
                        "SELECT APPOINTMENTS.ID as appId, APPOINTMENTS.name as appName, dayofmonth(APPOINTMENTS.appDay) as dayNum, monthname(appDay) as monthName, 
                        year(appDay) as years, dayname(appDay) as dayName, PATIENTS.ID as patID, APPOINTMENTS.startTime, APPOINTMENTS.place, APPOINTMENTS.notes, 
                        CATEGORYS.name, PATIENTS.patientName, PATIENTS.birthDate, OWNERS.email, OWNERS.lastName, OWNERS.firstName,
                        OWNERS.address, OWNERS.postCode, OWNERS.city, OWNERS.phone,APPOINTMENTS.status AS appStatus
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

                        $res = fetchTwoSets($db,$query,$_POST['browseDate'],$_SESSION['ID']);
                    } else if($_POST['dateZone'] === "week"){
                        $query =
                        "SELECT APPOINTMENTS.ID as appId, APPOINTMENTS.name as appName, dayofmonth(APPOINTMENTS.appDay) as dayNum, monthname(appDay) as monthName, 
                        year(appDay) as years, dayname(appDay) as dayName, PATIENTS.ID as patID, APPOINTMENTS.startTime, APPOINTMENTS.place, APPOINTMENTS.notes, 
                        CATEGORYS.name, PATIENTS.patientName, PATIENTS.birthDate, OWNERS.email, OWNERS.lastName, OWNERS.firstName,
                        OWNERS.address, OWNERS.postCode, OWNERS.city, OWNERS.phone,APPOINTMENTS.status AS appStatus
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

                        $res = fetchTwoSets($db,$query,$_POST['browseDate'],$_SESSION['ID']);

                    } else {
                        $query =
                        "SELECT APPOINTMENTS.ID as appId, APPOINTMENTS.name as appName, dayofmonth(APPOINTMENTS.appDay) as dayNum, monthname(appDay) as monthName, 
                        year(appDay) as years, dayname(appDay) as dayName, PATIENTS.ID as patID, APPOINTMENTS.startTime, APPOINTMENTS.place, APPOINTMENTS.notes, 
                        CATEGORYS.name, PATIENTS.patientName, PATIENTS.birthDate, OWNERS.email, OWNERS.lastName, OWNERS.firstName,
                        OWNERS.address, OWNERS.postCode, OWNERS.city, OWNERS.phone,APPOINTMENTS.status AS appStatus
                        FROM APPOINTMENTS 
                        JOIN BELONGS ON BELONGS.appointmentID = APPOINTMENTS.ID 
                        JOIN CATEGORYS ON BELONGS.categoryID = CATEGORYS.ID
                        JOIN PATIENT_HAS_APPOINTMENTS AS PHA ON PHA.appointmentID = APPOINTMENTS.ID
                        JOIN PATIENTS ON PHA.patientID = PATIENTS.ID
                        JOIN CLIENTS_HAS_PATIENTS AS CHP ON CHP.patientID = PATIENTS.ID
                        JOIN OWNERS ON OWNERS.ID = CHP.ownerID
                        JOIN USER_HAS_APPS ON APPOINTMENTS.ID = user_has_apps.appointmentID
                        WHERE MONTH(APPOINTMENTS.appDay) = MONTH(:set1)
                        AND USER_HAS_APPS.userID = :set2;";
                        $res = fetchTwoSets($db,$query,$_POST['browseDate'],$_SESSION['ID']);

                    }
                    include('V/_template/beforeCards.php');

                    include('V/_template/appWeekCards.php');
                    include('V/_template/afterCards.php');

                } else if(!empty($_POST['searchPseudo']) || !empty($_POST['searchPhone'])){
                    $query =
                    "SELECT PATIENTS.ID as patID, PATIENTS.patientName, PATIENTS.birthDate, OWNERS.email, OWNERS.lastName, OWNERS.firstName, SEX.name AS sexName,SEX.ID as sexID,
                    OWNERS.address, OWNERS.postCode, OWNERS.city, OWNERS.phone, PATIENTS.lifeStyle as lifeS, PATIENTS.food AS patFood, PATIENTS.breed as origins
                    FROM APPOINTMENTS 
                    JOIN BELONGS ON BELONGS.appointmentID = APPOINTMENTS.ID 
                    JOIN CATEGORYS ON BELONGS.categoryID = CATEGORYS.ID
                    JOIN PATIENT_HAS_APPOINTMENTS AS PHA ON PHA.appointmentID = APPOINTMENTS.ID
                    JOIN PATIENTS ON PHA.patientID = PATIENTS.ID
                    JOIN CLIENTS_HAS_PATIENTS AS CHP ON CHP.patientID = PATIENTS.ID
                    JOIN OWNERS ON OWNERS.ID = CHP.ownerID
                    JOIN USER_HAS_APPS ON APPOINTMENTS.ID = user_has_apps.appointmentID
                    JOIN SEX ON SEX.ID = PATIENTS.sexID
                    WHERE USER_HAS_APPS.userID = :set1 
                    AND (OWNERS.firstName = :set2 OR OWNERS.phone = :set3)
                    GROUP BY PATIENTS.ID
                    ORDER BY APPOINTMENTS.appDay,APPOINTMENTS.startTime
                    ;";

                    $res = fetchThreeSets($db,$query,$_SESSION['ID'],htmlspecialchars($_POST['searchPseudo']),htmlspecialchars($_POST['searchPhone']));
                    include('V/_template/showPatients.php');
                }
            break;
        default:
            include('V/_template/browser.php');
    endswitch;
    include('V/_template/appsModal.php');

?>