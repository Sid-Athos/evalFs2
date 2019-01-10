<?php

    $page = "Calendrier";
    include('M/dbConnect.php');
    include('M/getSql.php');
    include('M/otherSql.php');
    include('C/Functions/PHP/messages.php');
    include('C/Functions/PHP/sessionCheck.php');
    $actualDate = actualDate($db);
    include('C/Functions/PHP/daysAvailable.php');
    
    $query = 
    "SELECT *
    FROM CATEGORYS;";
    
    $cats = fetchNoSets($db,$query);
    if (isset($_GET['ym'])) { // l'utilisateur a cliqué sur mois suivant ou mois précédent
        $ym = $_GET['ym'];
    } else {
        $ym = date('Y-m');
    }
    unset($query);
    $date = "$ym%";

    $query =
    "SELECT APPOINTMENTS.appDay, dayOfmonth(APPOINTMENTS.appDay), COUNT(APPOINTMENTS.ID) as compteur
    FROM APPOINTMENTS
    JOIN USER_HAS_APPS AS UHA ON UHA.appointmentID = APPOINTMENTS.ID
    JOIN USERS ON USERS.ID = UHA.userID
    WHERE USERS.ID = :set1
    AND APPOINTMENTS.appDay LIKE :set2
    GROUP BY APPOINTMENTS.appDay
    ORDER BY APPOINTMENTS.appDay;";

    $apps = fetchTwoSets($db,$query,$_SESSION['ID'],$date);

    $days = array("Lundi" => 1, "Mardi" => 2, "Mercredi" => 3, "Jeudi" => 4, "Vendredi" => 5, "Samedi" => 6, "Dimanche" => 7);

    $query =
    "SELECT SCHEDULES.workingDay
    FROM SCHEDULES
    JOIN USER_HAS_SCHEDULE AS UHS ON UHS.scheduleID = SCHEDULES.ID
    WHERE UHS.userID = :set1;";

    $noApps = array();

    $works = fetchOneSet($db,$query,$_SESSION['ID']);
    for($i = 0;$i < count($works);$i++){
        if(array_key_exists($works[$i]['workingDay'],$days)){
            $noApps[] = $days[$works[$i]['workingDay']];
        } 
    }
    

    $query =
    "SELECT DATE(startsAt) as starts, DATE(endsAt) as ends
    FROM HOLIDAYS
    WHERE userID = :set1
    AND (startsAt LIKE :set2
    OR endsAt Like :set3)
    ORDER BY startsAt;";

    $offs = fetchThreeSets($db,$query,$_SESSION['ID'],$date,$date);
    ($offs);
    $query =
    "SELECT *
    FROM ORIGINS";

    $origins = fetchNoSets($db,$query);
    
    unset($query);

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

    include('V/_template/htmlTop.php');
    include('V/_template/navbar.php');
    include('C/Functions/PHP/calendar.php');
    if($lazy === $day - 1){
        echo "<div style='position:absolute;top:100px;left:35%'>".
        success("Afin de pouvoir utiliser notre calendrier, vous devez ajouter un jour de travail dans l'onglet <br>Mon Compte => Gestion pro").
        "</div>";
    }
    include('V/_template/appsModal.php');
    include('V/_template/calendar.php');
    include('V/_template/footer.html');
?>