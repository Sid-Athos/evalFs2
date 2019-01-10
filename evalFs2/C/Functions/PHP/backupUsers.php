<?php
    function backupUsers($datas)
    {
        if(is_file("users.csv"))
        {
            unlink("users.csv");
        }
        
        $name = "users.csv";
        $file = fopen($name,"a+");
        foreach($datas as $line)
        {
            fputcsv($file,$line);
        }
        fclose($file);
    }
?>