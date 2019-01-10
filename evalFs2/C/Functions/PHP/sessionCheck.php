
<?php
    if(!isset($_SESSION['ID']) || is_null($_SESSION['ID']) || !preg_match("/^[0-9]+$/",$_SESSION['ID']))
    {
        header("Location:index.php?page=login");
    }
?>