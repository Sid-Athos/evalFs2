<?php
    
    $db_username = "root";
    $db_password = "";
    $db_host = "localhost";
    $db_name = "appsEval";
    /* PDO EN FR OU EN ARABE C ISSI */
    $db_options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", 
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET lc_time_names = 'fr_FR'");
        try {
            $db = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_username, $db_password, $db_options);
        } catch(PDOException $ex) {
            die("Failed to connect to the database: " . $ex->getMessage());
        }
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
?>