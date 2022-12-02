<?php session_start(); 
include("../inc/constantes.inc.php");?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>QualiLogProject | Home</title>  
    <link rel="stylesheet" href="style/style.css" />
    <link href="img/edit_calendar.png" rel="shortcut icon" type="image/png">
</head>    
<body style="background-color: rgb(240,240,240);" id='body'>
    <?php
    if(!isset($_SESSION['MAIL']))
    {
        header("Location: ".DOMAIN_URL."/QualiLogProject/LoginPage.php?alerte=notConnected");
        return;
    }
    ?>

    <div class="content">
        <div class="title">
            Gestion de Matériel informatique
        </div>
    </div>

</body>
</html>
