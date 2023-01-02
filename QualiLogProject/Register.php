<?php session_start();
include("../inc/constantes.inc.php"); ?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Gestion de matériel | Inscription</title>  
    <link rel="stylesheet" href="style/styleW.css" />
    <link href="img/logo.png" rel="shortcut icon" type="image/png">
</head>    
<body>
    <?php

    include("../inc/bddconnect.inc.php");

    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Mail = $_POST["Mail"];
    $MotDePasse = password_hash($_POST["MotDePasse"], PASSWORD_DEFAULT);
    $ConfirmMotDePasse = password_hash($_POST["ConfirmMotDePasse"], PASSWORD_DEFAULT);

    if ($_POST["MotDePasse"] != $_POST["ConfirmMotDePasse"]) {
        header("Location: RegisterPage.php?alerte=wrongMdp");
        return;
    }

    if ($FirstName == "" || $LastName == "" || $Mail == "" || $MotDePasse == "") {
        header("Location: RegisterPage.php?alerte=emptyField");
        return;
    }

    $sql = 'SELECT UserID FROM wl_users WHERE Mail = :Mail';
    $resStat = $mysqlClient->prepare($sql);
    $resStat->execute([
        'Mail' => $Mail]);
    $res = $resStat->fetchAll();

    if (count($res) != 0) {
        header("Location: RegisterPage.php?alerte=mailAlreadyUsed");
        return;
    }

    $sql = 'INSERT INTO wl_users (FirstName,LastName,Mail,Pswd) VALUES (?, ?, ?, ?)';
    $res = $mysqlClient->prepare($sql);
    $exec = $res->execute([$FirstName,$LastName,$Mail, $MotDePasse]);

    if($exec) {
        if (isset($_SESSION['IsAdmin'])) {
            header("Location: AdminPageAccounts.php");
        } else {
            header("Location: LoginPage.php?alerte=registered");
        }
        
    } else {
        echo('Erreur Requete SQL');
    }

    ?>
</body>     
</html>