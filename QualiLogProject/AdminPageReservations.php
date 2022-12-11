<?php session_start(); 
include("../inc/constantes.inc.php");
include("../inc/bddconnect.inc.php")?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>QualiLogProject | Admin</title>  
    <link rel="stylesheet" href="style/styleW.css" />
    <link href="img/edit_calendar.png" rel="shortcut icon" type="image/png">
</head>    
<body style="background-color: var(--homeBackgroundColor);" id='body'>
    <?php
    if(!isset($_SESSION['MAIL'])) {
        header("Location: LoginPage.php?alerte=notConnected");
        return;
    }
    include 'menubar.php'
    ?>
    <p class="titrePage">Visualisation de l'ensemble des réservations</p>
    <hr class="titleRule">
    

</body>
</html>
<script src="//code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="Scripts/AdminPageScripts.js"></script>