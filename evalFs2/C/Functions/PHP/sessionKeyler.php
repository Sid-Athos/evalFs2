
<?php
    function sessionKeyller($SESSION)
    {
        foreach($_SESSION as $key => $value)
        {
            unset($_SESSION[$key]);
        }
        return;    
    }
?>