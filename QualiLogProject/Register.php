<?php session_start();
include("../inc/constantes.inc.php"); ?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Gestion de matériel | Sign Up</title>  
    <link rel="stylesheet" href="style/styleW.css" />
    <link href="img/edit_calendar.png" rel="shortcut icon" type="image/png">
</head>    
<body>
    <?php

    include("../inc/bddconnect.inc.php");

    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Mail = $_POST["Mail"];
    $MotDePasse = password_hash($_POST["MotDePasse"], PASSWORD_DEFAULT);

    $sql = 'SELECT UserID FROM wl_users WHERE Mail = :Mail';
    $resStat = $mysqlClient->prepare($sql);
    $resStat->execute([
        'Mail' => $Mail]);
    $res = $resStat->fetchAll();

    if (count($res) != 0) {
        header("Location: ".DOMAIN_URL."/qualilogproject/RegisterPage.php?alerte=mailFail");
        return;
    }

    $sql = 'INSERT INTO wl_users (FirstName,LastName,Mail,Pswd) VALUES (?, ?, ?, ?)';
    $res = $mysqlClient->prepare($sql);
    $exec = $res->execute([$FirstName,$LastName,$Mail, $MotDePasse]);

    echo(strlen($MotDePasse));

    if($exec) {
        header("Location: ".DOMAIN_URL."/qualilogproject/LoginPage.php?alerte=registered");
        
    } else {
        echo('Erreur Requete SQL');
    }

    ?>
</body>     
</html>