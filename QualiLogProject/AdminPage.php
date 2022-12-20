<?php session_start(); 
include("../inc/constantes.inc.php");
include("../inc/bddconnect.inc.php")?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Gestion de Matériel | Administrateur</title>  
    <link rel="stylesheet" href="style/styleW.css" />
    <link href="img/logo.png" rel="shortcut icon" type="image/png">
</head>    
<body style="background-color: var(--homeBackgroundColor);" id='body'>
    <?php
    if(!isset($_SESSION['MAIL'])) {
        header("Location: LoginPage.php?alerte=notConnected");
        return;
    }
    if(!$_SESSION['IsAdmin']) {
        header("Location: Home.php?alerte=notAdmin");
        return;
    }
    include 'menubar.php'
    ?>
    
    <p class="titrePage">Panneau de contrôle administrateur</p>
    <hr class="titleRule">

    <ul class="TitleList">
        <li class="TitleListItem" ><a class="TitleLink" href="AdminPageAccounts.php">Gestion des Comptes</a></li>
        <li class="TitleListItem" ><a class="TitleLink" href="AdminPageMaterial.php">Gestion du Matériel</a></li>
        <li class="TitleListItem" ><a class="TitleLink" href="AdminPageReservations.php">Visualisation des réservations</a></li>
    </ul>


</body>
</html>