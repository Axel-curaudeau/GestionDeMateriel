<?php session_start();
include("../inc/constantes.inc.php"); ?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Gestion de Matériel | Mot de passe oublié</title>  
    <link rel="stylesheet" href="style/style.css">
    <link href="img/edit_calendar.png" rel="shortcut icon" type="image/png">
</head>
<body>
    <?php
    if(!isset($_POST["Mail"]))
    {
        header("Location: ".DOMAIN_URL."/QualiLogProject/ForgotPswd.php?alerte=noEmail");
        return;
    }

    include("../inc/bddconnect.inc.php");

    $Mail = $_POST["Mail"];

    $sql = 'SELECT * FROM wl_users WHERE Mail = :Mail';
    $resStat = $mysqlClient->prepare($sql);
    $resStat->execute([
        'Mail' => $Mail]);
    $res = $resStat->fetchAll();

    if(count($res) == 0)
    {
        echo($Mail);
        header("Location: ".DOMAIN_URL."/QualiLogProject/forgotPswd.php?alerte=EmailError");
        return;
    }
    
    if(strtotime(date('Y/m/d h:i:s')) - strtotime($res[0]['lastResetPswd']) < 86400) // < 24h 
    {
        header("Location: ".DOMAIN_URL."/QualiLogProject/forgotPswd.php?alerte=spamReset");
        return;
    }

    $resetPswd = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'), 1, 8);

    $sql = 'UPDATE wl_users SET lastResetPswd = CURRENT_TIMESTAMP, resetPswd = :resetPswd WHERE Mail = :Mail';
    $res = $mysqlClient->prepare($sql);
    $exec = $res->execute(['Mail' => $_POST['Mail'],
                           'resetPswd' => password_hash($resetPswd, PASSWORD_DEFAULT)]);

    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';
    $isSend = mail($_POST['Mail'],'Gestion de Matériel : Mot de passe temporaire',  'Mail : '.$_POST['Mail'].'<br />
                                                              Mot de passe : '.$resetPswd.'<br /><br/>
                                                              Votre ancien mot de passe fonctionne toujours, mais vous pouvez utiliser celui-ci pour vous connecter et changer votre ancien mot de passe si vous l\'avez perdu. <br/>
                                                              Vous pouvez faire une demande de changement de mot de passe toutes les 24h.',
                                                              implode("\r\n", $headers));
    if (!$isSend){
        echo("Erreur lors de l'envoi du mail");
    }

    header("Location: ".DOMAIN_URL."/QualiLogProject/LoginPage.php?alerte=PswdReset");

    ?>
</body>     
</html>