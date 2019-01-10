<?php
    
    $page = "Connexion";
    include('M/dbConnect.php');
    //include('M/updateData.php');
    include('C/Functions/PHP/sessionKeyler.php');
    include('C/Functions/PHP/messages.php');
    include('V/_template/htmlTop.php');

    if(isset($_SESSION['ID']))
    {
        //updateLogout($db,$_SESSION['ID']);
        sessionKeyller($_SESSION);
        $message = success("Déconnexion réussie, à bientôt! :)");
    }
    include('V/_template/login.php');
?>