<?php
    
    include('M/dbConnect.php');
    include('M/getSql.php');
    include('M/otherSql.php');
    include('C/Functions/PHP/messages.php');
    $actualDate = actualDate($db);
    
    switch(isset($_POST)):
        case(isset($_POST['choice'])):
        switch($_POST['choice']):
            case'recover':
                        $page = "Récupération de compte";
                        //echo "Bande de chacals, vous allez tous crever comme des chacals"; //Citation mythique from Asterix
                        // Check for string integrity, mail
                        if(preg_match("/^[a-zA-Z0-9\.]{2,26}@[a-z]{2,6}.[a-z]{2,5}$/",$_POST['recMail']))
                        {
                            $mail = $_POST['recMail'];
                        }
                        else
                        {
                            $mail = NULL;
                        }
                        // Check for string integrity, phone number
                        if(preg_match("/^[0-9]{10,12}$/",$_POST['recPhone']))
                        {
                            $phone = $_POST['recPhone'];
                        }
                        else
                        {
                            $phone = NULL;
                        }
                        
                        // check if a user exists for account recovery
                        $check = fetchTwoSets($db,$mail,$phone);
                        if(empty($check))
                        {
                            $message = alert("Erreur dans le formulaire, nous ne reconnaissons pas votre mail ou votre numéro de téléphone!");
                            include('V/_template/login.php');
                        } 
                        else 
                        {
                            ini_set('SMTP',' smtp.mailtrap.io');
                            $message = success('Compte retrouvé');
                            
                            // the message
                            $msg = "First line of text\nSecond line of text";
                            // use wordwrap() if lines are longer than 70 characters
                            $msg = wordwrap($msg,70);
                            // send email
                                if(!mail("sa.bennaceur@gmail.com","My subject",$msg)){
                                }
                                include('V/_template/htmlTop.php');
                                include('V/_template/register.php');
                        }
                        echo $message;
                    break;
                case'register':
                            $page = "Inscription";
                            include('V/_template/htmlTop.php');
                            include('V/_template/register.php');
                        break;
                case"S'inscrire":
                        // Pseudo pattern
                        $pattern = "/^[a-zA-Z0-9\_\.\'\-]{4,29}$/";
                        // Check password, nickname and mail integrity
                        if(preg_match($pattern,$_POST['pseudo']) && preg_match($pattern,$_POST['password'])
                        && preg_match("/^[a-zA-Z0-9\.]{2,26}@[a-z]{2,6}.[a-z]{2,5}$/",$_POST['mail']))
                        {
                            if($_POST['password'] === $_POST['cpassword']){
                                $pseudo = htmlspecialchars($_POST['pseudo']);
                                $pw = htmlspecialchars($_POST['password']);
                                $mail = $_POST['mail'];
                                $flagPseudo = true;
                                $flagPassword = true;
                                $flagMail = true;
                                $pass = hash('ripemd160',$pw);
                            }
                            else
                            {
                                $flagMail = false;
                                $flagPassword = false;
                                $flagPseudo = false;
                            }
                        
                        
                            unset($pattern);
                            if(empty($_POST['phone']))
                            {
                                $phone = NULL;
                            } 
                            else 
                            {
                                $pattern = "/^[0-9]{10,12}$/";
                                // Check the phone number
                                if(preg_match($pattern,$_POST['phone']))
                                {
                                    $phone = $_POST['phone'];
                                }
                            }
                            if($flagMail === true && $flagPassword === true && 
                            $flagPseudo === true)
                            {
                                $query =
                                "INSERT INTO USERS(pseudo,mail,password,phone)
                                VALUES(:set1,:set2,:set3,:set4);";
                                $check = fourSets($db,$query,$pseudo,$mail,$pass,$phone);
                                if($check === true)
                                {
                                    $_SESSION['ID'] = $db -> lastInsertId();
                                    $_SESSION['avPath'] = "";
                                    $query = 
                                    "SELECT *
                                    FROM USERS;";
                                    $res = fetchNoSets($db,$query);
                                    include('C/Functions/PHP/backupUsers.php');
                                    backupUsers($res);
                                    $message = success("Compte créé, vous allez être redirigé vers 
                                    l'accueil membre! Bienvenue $pseudo!");
                                    header("refresh:3;url=index.php?page=calendar");
                                }
                                else 
                                {
                                    $message = alert("Erreur dans le formulaire.");
                                }
                            }
                        }
                        else 
                        {
                            $message = alert("Erreur dans le formulaire, votre saisie ne correspond pas au format requis.<br>
                            Pour rappel, votre pseudo doit faire 4 caractères ou plus (alphanumériques, underscore, point et apostrophe inclu).<br>
                            Le mot de passe doit comporter au moins 4 caractères avec les mêmes règles.");
                            # code...
                        }
                        include('V/_template/htmlTop.php');
                        include('V/_template/register.php');
                    break;
                case'connexion':
                        $page = "Connexion";
                        if(isset($_POST['mail']))
                        {
                            $pattern = "/^[a-zA-Z\d](?:[a-z\d]|_|.(?=[a-zA-Z\d])){0,38}$/"; 
                            if(((preg_match($pattern,$_POST['mail']) || filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) && preg_match($pattern,$_POST['password'])))
                            {
                                $flagPassword = htmlspecialchars($_POST['password']);
                                $flagMail = htmlspecialchars($_POST['mail']);
                                $password = hash('ripemd160',$flagPassword);
                                $query = 
                                "UPDATE USERS
                                SET lastCo = CURRENT_TIMESTAMP()
                                WHERE (mail = :set1 
                                OR pseudo = :set2)
                                AND password = :set3;";

                                $check = threeSets($db,$query,$flagMail,$flagMail,$password);

                                unset($query);

                                $query =
                                "SELECT ID, pseudo, avPath
                                FROM USERS
                                WHERE (mail = :set1 
                                OR pseudo = :set2);";

                                $res = fetchTwoSets($db,$query,$flagMail,$flagMail);
                                
                                unset($query);
                                
                                if($check === 0)
                                {
                                    $message = alert("Aucun compte existant. Êtes vous sûr d'avoir saisi le bon identifiant?");
                                }
                                else
                                {
                                    if(!empty($res))
                                    {
                                        $message = success("Connexion réussie");
                                        //sessionKeyller($_SESSION);
                                        $_SESSION['ID'] = $res[0]['ID'];
                                        $_SESSION['avPath'] = $res[0]['avPath'];
                                        $_SESSION['greetings'] = "Bonjour ".$res[0]['pseudo']." <br>. Nous sommes le $actualDate !";
                                        header("Location:index.php?page=calendar");
                                    }
                                }
                                unset($check,$res);
                            } 
                            else{
                                $message = alert("Erreur dans le formulaire!");
                            }
                        }
                        include('V/_template/htmlTop.php');
                        include('V/_template/login.php');
                    break;
                default:
                    include('E/404.html');
            endswitch;
            break;
        default:
            $page = "Connexion";
            include('V/_template/htmlTop.php');
            include('V/_template/login.php');
    endswitch;
?>