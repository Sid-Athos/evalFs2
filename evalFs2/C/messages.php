<?php
    
    $page = "Messagerie";
    include('M/dbConnect.php');
    include('M/getSql.php');
    include('M/otherSql.php');
    $actualDate = actualDate($db);
    include('V/_template/htmlTop.php');
    include('V/_template/navbar.php');

    echo $actualDate;
    include('V/_template/footer.html');
?>