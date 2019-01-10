<?php
    session_start();
    
    setlocale(LC_ALL, 'fra');
    include('M/dbConnect.php');
    date_default_timezone_set ("Europe/Paris");
    switch(isset($_GET)):
        case(isset($_GET['page'])):
            switch($_GET['page']):
                case($_GET['page'] === 'login'):
                        include('C/login.php');
                    break;
                case($_GET['page'] === 'apps'):
                        include('C/Functions/PHP/sessionCheck.php');
                        include('C/apps.php');
                    break;
                case($_GET['page'] === 'patients'):
                        include('C/Functions/PHP/sessionCheck.php');
                        include('C/patients.php');
                    break;
                case($_GET['page'] === 'account'):
                        include('C/Functions/PHP/sessionCheck.php');
                        include('C/account.php');
                    break;
                case($_GET['page'] === 'logout'):
                        include('C/logout.php');
                    break;
                case($_GET['page'] === 'browse'):
                        include('C/Functions/PHP/sessionCheck.php');
                        include('C/browse.php');
                    break;
                case($_GET['page'] === 'messages'):
                        include('C/Functions/PHP/sessionCheck.php');
                        include('C/messages.php');
                    break;
                case($_GET['page'] === 'calendar'):
                        include('C/calendar.php');
                    break;
                default:
                    include('E/404.html');
            endswitch;
            break;
        default:
            include('C/login.php');
    endswitch;
    
?>