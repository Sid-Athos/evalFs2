<?php

    include('C/Functions/PHP/messages.php');
    $messages = array();
    include('M/dbConnect.php');
    include('M/getSql.php');
    include('M/otherSql.php');

    switch(isset($_POST)):
        
        case(isset($_POST['getOwners'])):
               
            break;
        case(isset($_POST['eraseApp'])):
                if(preg_match("/^[0-9]+$/",$_POST['eraseApp'])){
                    
                    $query[0] = 
                    "DELETE 
                    FROM BELONGS 
                    WHERE BELONGS.appointmentID = :set1;";

                    $query[1] = 
                    "DELETE 
                    FROM USER_HAS_APPS 
                    WHERE USER_HAS_APPS.appointmentID = :set1;";

                    $query[2] = 
                    "DELETE 
                    FROM PATIENT_HAS_APPOINTMENTS 
                    WHERE PATIENT_HAS_APPOINTMENTS.appointmentID = :set1;";

                    $query[3] =
                    "DELETE 
                    FROM APPOINTMENTS 
                    WHERE APPOINTMENTS.ID = :set1
                    AND appDay > CURRENT_TIMESTAMP();";

                    for($i = 0; $i < count($query);$i++)
                    {
                        if(oneSet($db,$query[$i],$_POST['eraseApp']) === true){
                            if($i === 1){
                                $messages[] = success("Suppression confirmée");
                            }
                        } else {
                            $messages[] = alert("Erreur lors du traitement de la requête, veuillez réessayer plus tard.");
                        }
                    }
                    if(count($messages) > 0)
                    {
                        for($i = 0; $i < count($messages); $i++)
                        {
                            echo $messages[$i];
                        }
                        unset($messages);
                    }
                }
            break;
        case(isset($_POST['fetchApps'])):
                (preg_match("/^[0-9]{4}[-]{1}[0-1]{1}[0-9]{1}[-]{1}[0-3]{1}[0-9]{1}$/", $_POST['fetchApps']))? $messages = $messages : $messages[] = alert("Date incorrecte !");
                if(count($messages) === 0)
                {
                    $query =
                        "SELECT APPOINTMENTS.ID as appId, APPOINTMENTS.name as appName, dayofmonth(APPOINTMENTS.appDay) as dayNum, monthname(appDay) as monthName, 
                        year(appDay) as years, dayname(appDay) as dayName, PATIENTS.ID as patID, APPOINTMENTS.startTime, APPOINTMENTS.place, APPOINTMENTS.notes, 
                        CATEGORYS.name, PATIENTS.patientName,PATIENTS.breed as breed, PATIENTS.birthDate, OWNERS.email, OWNERS.lastName, OWNERS.firstName, ORIGINS.name as origin,
                        OWNERS.address, OWNERS.postCode, OWNERS.city, OWNERS.phone,APPOINTMENTS.status AS appStatus
                        FROM APPOINTMENTS 
                        JOIN BELONGS ON BELONGS.appointmentID = APPOINTMENTS.ID 
                        JOIN CATEGORYS ON BELONGS.categoryID = CATEGORYS.ID
                        JOIN PATIENT_HAS_APPOINTMENTS AS PHA ON PHA.appointmentID = APPOINTMENTS.ID
                        JOIN PATIENTS ON PHA.patientID = PATIENTS.ID
                        JOIN CLIENTS_HAS_PATIENTS AS CHP ON CHP.patientID = PATIENTS.ID
                        JOIN OWNERS ON OWNERS.ID = CHP.ownerID
                        JOIN USER_HAS_APPS ON APPOINTMENTS.ID = user_has_apps.appointmentID
                        JOIN ORIGINS ON ORIGINS.ID = PATIENTS.originID
                        WHERE APPOINTMENTS.appDay = :set1
                        AND USER_HAS_APPS.userID = :set2
                        ORDER BY APPOINTMENTS.appDay,APPOINTMENTS.startTime;";

                    $res = fetchTwoSets($db,$query,$_POST['fetchApps'],$_POST['usrID']);
                    include('V/_template/appDetailsCards.php');
                }
            break;
        case(isset($_POST['eraseDate'])):
                (preg_match("/^[0-9]{4}[-]{1}[0-1]{1}[0-9]{1}[-]{1}[0-3]{1}[0-9]{1}$/", $_POST['eraseDate']))? $messages = $messages : $messages[] = alert("Date incorrecte !");
                if(count($messages) === 0)
                {
                    
                    $query =
                    "SELECT APPOINTMENTS.ID as ID
                    FROM USER_HAS_APPS AS UHA JOIN APPOINTMENTS ON APPOINTMENTS.ID = UHA.appointmentID
                    WHERE UHA.userID = :set1
                    AND APPOINTMENTS.appDay LIKE :set2;";

                    if(!empty($res = fetchTwoSets($db,$query,$_POST['usrID'],$_POST['eraseDate']))){
                        unset($query);
                        for($j = 0; $j < count($res);$j++){
                            $query[0] = 
                                "DELETE 
                                FROM BELONGS 
                                WHERE BELONGS.appointmentID = :set1;";

                            $query[1] = 
                                "DELETE 
                                FROM USER_HAS_APPS 
                                WHERE USER_HAS_APPS.appointmentID = :set1;";

                            $query[2] = 
                                "DELETE 
                                FROM PATIENT_HAS_APPOINTMENTS 
                                WHERE PATIENT_HAS_APPOINTMENTS .appointmentID = :set1;";


                            $query[3] =
                                "DELETE 
                                FROM APPOINTMENTS 
                                WHERE APPOINTMENTS.ID = :set1
                                AND appDay > CURRENT_TIMESTAMP();";
                    

                            for($i = 0; $i < count($query);$i++)
                            {
                                if(oneSet($db,$query[$i],$res[$j]['ID']) === true){
                                    if($i === 3){
                                        $messages[] = success("Suppression confirmée");
                                    }
                                } else {
                                    $messages[] = alert("Erreur lors du traitement de la requête, veuillez réessayer plus tard.");
                                }
                            }
                        }
                    }
                  
                }
                if(count($messages) > 0)
                {
                    for($i = 0; $i < count($messages); $i++)
                    {
                        echo $messages[$i];
                    }
                    unset($messages);
                } 
            break;
        case(isset($_POST['appRecc'])):
                if($_POST['appRecc'] === "36")
                {

                    (preg_match("/^[0-9]{1}$/",$_POST['appCat'])) ? $messages = $messages : $messages[] = alert("Catégorie invalide !") ;

                    (!empty($_POST['appHour']) && (strtotime($_POST['appHour']) < strtotime("23:59:15")) && (strtotime($_POST['appHour']) >= strtotime("00:00:00"))) ? $messages = $messages: $messages[] = alert("L'heure n'est pas au format adéquat!");

                    (preg_match("/^[0-9]{4}[-]{1}[0-1]{1}[0-9]{1}[-]{1}[0-3]{1}[0-9]{1}$/", $_POST['appDate']))? $messages = $messages : $messages[] = alert("Date incorrecte !");
                    
                    (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['appName'])) ?  $messages = $messages : $messages[] = alert("Nom rdv incorrect !");
                    (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['cliName'])) ?  $messages = $messages : $messages[] = alert("Préom client incorrect !");
                    (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['cliFiName'])) ?  $messages = $messages : $messages[] = alert("Nom client incorrect !");
                    (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['cliAdress'])) ?  $messages = $messages : $messages[] = alert("Adresse incorrecte !");
                    (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['cliTown'])) ?  $messages = $messages : $messages[] = alert("Ville incorrecte !");
                    (preg_match("/^[0-9]{10}$/", $_POST['cliPhone'])) ?  $messages = $messages : $messages[] = alert("Téléphone incorrect !");
                    (preg_match("/^[0-9]{5}$/", $_POST['cliPost'])) ?  $messages = $messages : $messages[] = alert("Code postal incorrect !");
                    (preg_match("/^[a-zA-Z\d](?:[a-z\d]|_|.(?=[a-zA-Z\d])){0,38}$/", $_POST['cliMail'])) ?  $messages = $messages : $messages[] = alert("Format de mail invalide!");
                    (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['patName'])) ?  $messages = $messages : $messages[] = alert("Nom client incorrect !");
                    (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['patFi'])) ?  $messages = $messages : $messages[] = alert("Nom client incorrect !");
                    (preg_match("/^[0-9]{4}[-]{1}[0-1]{1}[0-9]{1}[-]{1}[0-3]{1}[0-9]{1}$/", $_POST['patBirth'])) ?  $messages = $messages : $messages[] = alert("Nom client incorrect !");
                    (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['patLstyle'])) ?  $messages = $messages : $messages[] = alert("Nom client incorrect !");
                    (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['patFood'])) ?  $messages = $messages : $messages[] = alert("Nom client incorrect !");
                      
                    $today = date('Y-m-j');
                    $today = strtotime($today);
                    $acDate = strtotime($_POST['appDate']);

                    if(count($messages) === 0){

                        $query =
                        "SELECT APPS.name, APPS.startTime
                        FROM APPOINTMENTS AS APPS
                        JOIN USER_HAS_APPS AS USAP ON APPS.ID = USAP.appointmentID
                        WHERE USAP.userID = :set1
                        AND APPS.appDay LIKE :set2
                        AND (APPS.startTime Between :set3 AND addtime(:set4,'00:29')
                        OR :set5 Between APPS.startTime  AND addtime(APPS.startTime,'00:29'));";

                        $query1 =
                        "SELECT *
                        FROM HOLIDAYS
                        WHERE userID = :set1
                        AND :set2 BETWEEN startsAt AND endsAt;";

                        if(!empty($res = fetchFiveSets(

                            $db,
                            $query,
                            $_POST['usrID'],
                            $_POST['appDate'],
                            ($_POST['appHour'].":00"),
                            ($_POST['appHour'].":00"),
                            ($_POST['appHour'].":00"))))
                        {
                            $messages[] = alert("Le rendez-vous ".$res[0]['name']." à ".$res[0]['startTime']." <br>a déjà été pris ce jour là.");
                        }
                        else 
                        {
                            
                            $query = 
                            "SELECT *
                            FROM SCHEDULES AS S
                            JOIN USER_HAS_SCHEDULE AS UHS ON S.ID = UHS.scheduleID
                            JOIN USERS ON USERS.ID =  UHS.userID
                            WHERE USERS.ID = :set1
                            AND S.workingDay LIKE DAYNAME(:set2)
                            AND S.fromTime < :set3
                            AND S.toTime > :set4;";

                            if(!empty(fetchFourSets($db,$query,$_POST['usrID'],$_POST['appDate'],($_POST['appHour'].":00"),($_POST['appHour'].":00")))){

                                $query =
                                "SELECT *
                                FROM HOLIDAYS
                                WHERE userID = :set1
                                AND :set2 BETWEEN startsAt AND endsAt;";
                                if(empty(fetchTwoSets($db,$query,$_POST['usrID'],$_POST['appDate']))){
                            unset($res);

                                $query0 =
                                "INSERT INTO OWNERS(email,lastName,firstName,address,postCode,city,phone)
                                VALUES(:set1,:set2,:set3,:set4,:set5,:set5,:set7);";

                                
                                $patName = $_POST['patName']." ".$_POST['patFi'];
                                $query1 = 
                                "INSERT INTO PATIENTS(patientName, breed, sexID,originID, birthDate,lifeStyle,food)
                                VALUES(:set1,:set2,:set3,:set4,:set5,:set6,:set7);";

                                $res0 = sevenSets($db,$query1,$patName,$_POST['patOr'],$_POST['patSex'],$_POST['patNature'],$_POST['patBirth'],$_POST['patLstyle'],$_POST['patFood']);
                                $patID = $db -> lastInsertId();                                

                                $res1 =
                                sevenSets(
                                $db,
                                $query0,
                                $_POST['cliMail'],
                                $_POST['cliName'],
                                $_POST['cliFiName'],
                                $_POST['cliAdress'],
                                $_POST['cliPost'],$_POST['cliTown'],$_POST['cliPhone']);
                                $ownID = $db -> lastInsertId();

                                if($res0 === true && $res1){

                                    (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['appPlace'])) ?  $_POST['appPlace'] : $_POST['appPlace'] = "Aucun endroit défini!";
                                    (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['appNotes']) || empty($_POST)) ?  $_POST['appNotes'] : $_POST['appPlace'] = "Aucune note défini!";
            
                                    if(($acDate - $today) >= 86400){
                                        $query =
                                        "INSERT INTO APPOINTMENTS(name, place, notes, appDay, startTime) 
                                        VALUES(:set1,:set2, :set3, (
                                        CASE appDay 
                                        WHEN DATEDIFF(DATE(CURRENT_TIMESTAMP()),:set4) > 0
                                        THEN :set5 ELSE NULL
                                        END),:set6);";
                                                
                                        if(sixSets(
                                            $db,$query,$_POST['appName'],$_POST['appPlace'],$_POST['appNotes'],
                                            $_POST['appDate'],$_POST['appDate'],($_POST['appHour'].":00")) == true){

                                            $messages[] = success("Rdv ajouté!");
                                            unset($query,$res);
                                            $id = $db -> lastInsertId();
                                            
                                            $query =
                                            "INSERT INTO BELONGS(appointmentID,categoryID)
                                            VALUES(:set1,:set2);";

                                            twoSets($db,$query,$id,$_POST['appCat']);
                                            unset($query);

                                            $query = 
                                            "INSERT INTO USER_HAS_APPS(userID, appointmentID)
                                            VALUES(:set1,:set2);";

                                            twoSets($db,$query,$_POST['usrID'],$id);

                                            

                                            $query =
                                            "INSERT INTO PATIENT_HAS_APPOINTMENTS(patientID,appointmentID) 
                                            VALUES (:set1,:set2);";

                                            twoSets($db,$query,$patID,$id);

                                            $query =
                                            "INSERT INTO CLIENTS_HAS_PATIENTS(ownerID,patientID) 
                                            VALUES (:set1,:set2);";
            
                                            twoSets($db,$query,$ownID,$patID);
            
                                        } else{
                                            $messages[] = alert("Erreur dans l'ajout du rdv!");
                                        }
                                    } else {
                                        $messages[] = alert("La date de rendez-vous ne peut être prise dans le passé!");
                                    }
                                } else {
                                    $messages[] = alert("L'utilisateur est déjà enregistré");
                                }
                            } else {
                                $messages [] = alert("Vous serez en vacances ce jour là.");
                            }
                        } else {
                            $messages [] = alert("L'heure et la date n'est pas dans vos disponibilités.");
                        }
                     }
                    }
                
                            
                }
                else if($_POST['appRecc'] === "35")
                {
                    (preg_match("/^[0-9]{1}$/",$_POST['appCat'])) ? $messages = $messages : $messages[] = alert("Catégorie invalide !") ;
                    (preg_match("/^[0-9]+$/",$_POST['appOwner'])) ? $messages = $messages : $messages[] = alert("Responsable invalide !") ;

                    (!empty($_POST['appHour']) && (strtotime($_POST['appHour']) < strtotime("23:59:15")) && (strtotime($_POST['appHour']) >= strtotime("00:00:00"))) ? $messages = $messages: $messages[] = alert("L'heure n'est pas au format adéquat!");

                    (preg_match("/^[0-9]{4}[-]{1}[0-1]{1}[0-9]{1}[-]{1}[0-3]{1}[0-9]{1}$/", $_POST['appDate']))? $messages = $messages : $messages[] = alert("Date incorrecte !");
                    
                    (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['appName'])) ?  $messages = $messages : $messages[] = alert("Nom rdv incorrect !");
                    (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['patName'])) ?  $messages = $messages : $messages[] = alert("Nom patient incorrect !");
                    (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['patFi'])) ?  $messages = $messages : $messages[] = alert("Prénom patient incorrect !");
                    (preg_match("/^[0-9]{4}[-]{1}[0-1]{1}[0-9]{1}[-]{1}[0-3]{1}[0-9]{1}$/", $_POST['patBirth'])) ?  $messages = $messages : $messages[] = alert("Nom client incorrect !");
                    (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['patLstyle'])) ?  $messages = $messages : $messages[] = alert("Nom client incorrect !");
                    (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['patFood'])) ?  $messages = $messages : $messages[] = alert("Nom client incorrect !");
                      
                    $today = date('Y-m-j');
                    $today = strtotime($today);
                    $acDate = strtotime($_POST['appDate']);

                    if(count($messages) === 0){
                        $query =
                        "SELECT APPS.name, APPS.startTime
                        FROM APPOINTMENTS AS APPS
                        JOIN USER_HAS_APPS AS USAP ON APPS.ID = USAP.appointmentID
                        WHERE USAP.userID = :set1
                        AND APPS.appDay LIKE :set2
                        AND (startTime Between :set3 AND addtime(:set4,'00:29:00')
                        OR :set5 Between startTime  AND addtime(startTime,'00:29:00'));";

                        $query1 =
                        "SELECT *
                        FROM HOLIDAYS
                        WHERE userID = :set1
                        AND :set2 BETWEEN startsAt AND endsAt;";

                        if(!empty($res = fetchFiveSets(
                            $db,
                            $query,
                            $_POST['usrID'],
                            $_POST['appDate'],
                            ($_POST['appHour'].":00"),
                            ($_POST['appHour'].":00"),
                            ($_POST['appHour'].":00"))))
                        {
                            $messages[] = alert("Le rendez-vous ".$res[0]['name']." à ".$res[0]['startTime']." <br>a déjà été pris ce jour là.");
                        }
                        else 
                        {
                            unset($res);

                            $query =
                            "SELECT *
                            FROM OWNERS 
                            JOIN CLIENTS_HAS_PATIENTS AS CHP ON CHP.ownerID = OWNERS.ID
                            JOIN PATIENTS ON PATIENTS.ID = CHP.patientID
                            WHERE OWNERS.ID = :set1
                            AND PATIENTS.patientName LIKE :set2;";
                            unset($res);
                            
                            $patName = $_POST['patName']." ".$_POST['patFi'];
                            if(empty(fetchTwoSets($db,$query,$_POST['appOwner'],$patName)))
                            {
                            $query1 = 
                            "INSERT INTO PATIENTS(patientName, breed, sexID, originID, birthDate,lifeStyle,food)
                            VALUES(:set1,:set2,:set3,:set4,:set5,:set6,:set7);";

                            $res0 = sevenSets($db,$query1,$patName,$_POST['patOr'],$_POST['patSex'],$_POST['patNature'],$_POST['patBirth'],$_POST['patLstyle'],$_POST['patFood']);
                            $patID = $db -> lastInsertId();                                

                            if($res0 === true){

                                (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['appPlace'])) ?  $_POST['appPlace'] : $_POST['appPlace'] = "Aucun endroit défini!";
                                (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['appNotes']) || empty($_POST)) ?  $_POST['appNotes'] : $_POST['appNotes'] = "Aucune note défini!";

                                $query = 
                                "SELECT *
                                FROM SCHEDULES AS S
                                JOIN USER_HAS_SCHEDULE AS UHS ON S.ID = UHS.scheduleID
                                JOIN USERS ON USERS.ID =  UHS.userID
                                WHERE USERS.ID = :set1
                                AND S.workingDay LIKE DAYNAME(:set2)
                                AND S.fromTime < :set3
                                AND S.toTime > ADDTIME(:set4,'00:30:00');";
    
                                    if(!empty(fetchFourSets($db,$query,$_POST['usrID'],$_POST['appDate'],($_POST['appHour'].":00"),($_POST['appHour'].":00")))){
        
                                        $query =
                                        "SELECT *
                                        FROM HOLIDAYS
                                        WHERE userID = :set1
                                        AND :set2 BETWEEN startsAt AND endsAt;";
                                        if(empty(fetchTwoSets($db,$query,$_POST['usrID'],$_POST['appDate']))){
            
                                            if(($acDate - $today) >= 86400){
                                                $query =
                                                "INSERT INTO APPOINTMENTS(name, place, notes, appDay, startTime) 
                                                VALUES(:set1,:set2, :set3, (
                                                CASE appDay 
                                                WHEN DATEDIFF(DATE(CURRENT_TIMESTAMP()),:set4) > 0
                                                THEN :set5 ELSE NULL
                                                END),:set6);";
                                                        
                                                if(sixSets(
                                                    $db,$query,$_POST['appName'],$_POST['appPlace'],$_POST['appNotes'],
                                                    $_POST['appDate'],$_POST['appDate'],($_POST['appHour'].":00")) == true){

                                                    $messages[] = success("Rdv ajouté!");
                                                    unset($query,$res);
                                                    $id = $db -> lastInsertId();
                                                    
                                                    $query =
                                                    "INSERT INTO BELONGS(appointmentID,categoryID)
                                                    VALUES(:set1,:set2);";

                                                    twoSets($db,$query,$id,$_POST['appCat']);
                                                    unset($query);

                                                    $query = 
                                                    "INSERT INTO USER_HAS_APPS(userID, appointmentID)
                                                    VALUES(:set1,:set2);";

                                                    twoSets($db,$query,$_POST['usrID'],$id);

                                                    

                                                    $query =
                                                    "INSERT INTO PATIENT_HAS_APPOINTMENTS(patientID,appointmentID) 
                                                    VALUES (:set1,:set2);";

                                                    twoSets($db,$query,$patID,$id);

                                                    $query =
                                                    "INSERT INTO CLIENTS_HAS_PATIENTS(ownerID,patientID) 
                                                    VALUES (:set1,:set2);";
                    
                                                    twoSets($db,$query,$_POST['appOwner'],$patID);
                    
                                                } else{
                                                    $messages[] = alert("Erreur dans l'ajout du rdv!");
                                                }
                                            } else {
                                                $messages[] = alert("La date de rendez-vous ne peut être prise dans le passé!");
                                            }
                                        } else {
                                            $messages [] = alert("Vous serez en vacances ce jour là.");

                                        }
                                    } else {
                                        $messages[] = alert("Vous ne travaillez pas ce jour-ci, veuillez changer vos disponibilités.");
                                    }
                                
                                } 
                            } else {
                                $messages[] = alert("Le patient est déjà enregistré");
                            }
                        }
                    }
                }
                else
                {
                    (preg_match("/^[0-9]{1}$/",$_POST['appCat'])) ? $messages = $messages : $messages[] = alert("Catégorie invalide !") ;

                    (!empty($_POST['appHour']) && (strtotime($_POST['appHour']) < strtotime("23:59:15")) && (strtotime($_POST['appHour']) >= strtotime("00:00:00"))) ? $messages = $messages: $messages[] = alert("L'heure n'est pas au format adéquat!");

                    (preg_match("/^[0-9]{4}[-]{1}[0-1]{1}[0-9]{1}[-]{1}[0-3]{1}[0-9]{1}$/", $_POST['appDate']))? $messages = $messages : $messages[] = alert("Date incorrecte !");
                    
                    (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['appName'])) ?  $messages = $messages : $messages[] = alert("Nom rdv incorrect !");
                    (preg_match("/^[0-9]{1,5}$/",$_POST['appPat'])) ? $messages = $messages : $messages[] = alert("Patient invalide !") ;
                      
                    if(count($messages === 0) && $_POST['appPat'] != "")
                    {
                        $today = date('Y-m-j');
                        $today = strtotime($today);
                        $acDate = strtotime($_POST['appDate']);

                        $query =
                        "SELECT APPS.name, APPS.startTime
                        FROM APPOINTMENTS AS APPS
                        JOIN USER_HAS_APPS AS USAP ON APPS.ID = USAP.appointmentID
                        WHERE USAP.userID = :set1
                        AND APPS.appDay LIKE :set2
                        AND (startTime Between :set3 AND addtime(:set4,'00:29:00')
                        OR :set5 Between startTime  AND addtime(startTime,'00:29:00'));";

                        $query1 =
                        "SELECT *
                        FROM HOLIDAYS
                        WHERE userID = :set1
                        AND :set2 BETWEEN startsAt AND endsAt;";

                        if(!empty($res = fetchFiveSets(
                            $db,
                            $query,
                            $_POST['usrID'],
                            $_POST['appDate'],
                            ($_POST['appHour'].":00"),
                            ($_POST['appHour'].":00"),
                            ($_POST['appHour'].":00"),
                            ($_POST['appHour']))))
                        {

                            $messages[] = alert("Le rendez-vous ".$res[0]['name']." à ".$res[0]['startTime']." <br>a déjà été pris ce jour là.");
                        }
                        else 
                        {

                            (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['appPlace'])) ?  $_POST['appPlace'] : $_POST['appPlace'] = "Aucun endroit défini!";
                            (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\.]+$/", $_POST['appNotes'])) ?  $_POST['appNotes'] : $_POST['appNotes'] = "Aucune note défini!";
        
                            $query = 
                            "SELECT *
                            FROM SCHEDULES AS S
                            JOIN USER_HAS_SCHEDULE AS UHS ON S.ID = UHS.scheduleID
                            JOIN USERS ON USERS.ID =  UHS.userID
                            WHERE USERS.ID = :set1
                            AND S.workingDay LIKE DAYNAME(:set2)
                            AND S.fromTime < :set3
                            AND S.toTime > ADDTIME(:set4,'00:30:00')";

                            if(!empty(fetchFourSets($db,$query,$_POST['usrID'],$_POST['appDate'],($_POST['appHour'].":00"),($_POST['appHour'].":00")))){

                                $query =
                                "SELECT *
                                FROM HOLIDAYS
                                WHERE userID = :set1
                                AND :set2 BETWEEN startsAt AND endsAt;";
                                if(empty(fetchTwoSets($db,$query,$_POST['usrID'],$_POST['appDate']))){

                                    if(($acDate - $today) >= 86400){
                                        $query =
                                        "INSERT INTO APPOINTMENTS(name, place, notes, appDay, startTime) 
                                        VALUES(:set1,:set2, :set3, (
                                        CASE appDay 
                                        WHEN DATEDIFF(DATE(CURRENT_TIMESTAMP()),:set4) > 0
                                        THEN :set5 ELSE NULL
                                        END),:set6);";
                                                
                                        if(sixSets(
                                            $db,$query,$_POST['appName'],$_POST['appPlace'],$_POST['appNotes'],
                                            $_POST['appDate'],$_POST['appDate'],($_POST['appHour'].":00")) == true){
        
                                            $messages[] = success("Rdv ajouté!");
                                            unset($query,$res);
                                            $id = $db -> lastInsertId();
                                            
                                            $query =
                                            "INSERT INTO BELONGS(appointmentID,categoryID)
                                            VALUES(:set1,:set2);";
        
                                            twoSets($db,$query,$id,$_POST['appCat']);
                                            unset($query);
        
                                            $query =
                                            "INSERT INTO PATIENT_HAS_APPOINTMENTS(patientID,appointmentID) 
                                            VALUES (:set1,:set2);";
        
                                            twoSets($db,$query,$_POST['appPat'],$id);
        
                                            unset($query);
                                            $query = 
                                            "INSERT INTO USER_HAS_APPS(userID, appointmentID)
                                            VALUES(:set1,:set2);";
        
                                            twoSets($db,$query,$_POST['usrID'],$id);
                                        }
                                    }
                                } else {
                                    $messages[] = alert("Vous êtes en congé");

                                }

                            } else {
                                $messages[] = alert("Horaire non admis dans le planning");
                            }
                        }
                    }
                }
                for($i = 0; $i < count($messages); $i++)
                {
                    echo $messages[$i];
                }
                unset($messages);
            break;
        case(isset($_POST['date'])):

                $timestamp = strtotime($_POST['date']);
                $todays = date("Y-m-d",strtotime('+1 day',$timestamp));
                echo $todays;
                
            break;
        default:
                echo alert("Try again.");
    endswitch;
//Ajouter le texte + index ligne 76
?>

