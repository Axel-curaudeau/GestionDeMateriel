<?php session_start(); 
include("../inc/constantes.inc.php");?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>QualiLogProject | Home</title>  
    <link rel="stylesheet" href="style/styleW.css" />
    <link href="img/edit_calendar.png" rel="shortcut icon" type="image/png">
</head>    
<body style="background-color: var(--homeBackgroundColor);" id='body'>
    <?php
    if(!isset($_SESSION['MAIL'])) {
        header("Location: ".DOMAIN_URL."/QualiLogProject/LoginPage.php?alerte=notConnected");
        return;
    }
    ?>

    <div class="bandeau">
        <div class="bandeauElement">
            <a href="ProfilPage.php">Mon Profil</a>
        </div>
        <div class="bandeauElement">
            <a href="#">Admin</a>
        </div>
        <div class="bandeauElement">
            <a href="Deconnexion.php">Se Déconnecter</a>
        </div>
    </div>

    <div class="listeMateriel">
        <div class="Materiel" style="background-color:red; width:500px; height:200px;"></div>
        <div class="Materiel" style="background-color:green; width:500px; height:200px;"></div>
        <div class="Materiel" style="background-color:blue; width:500px; height:200px;"></div>
        <div class="Materiel" style="background-color:yellow; width:500px; height:200px;"></div>
        <div class="Materiel" style="background-color:purple; width:500px; height:200px;"></div>
        <div class="Materiel" style="background-color:orange; width:500px; height:200px;"></div>
        <div class="Materiel" style="background-color:grey; width:500px; height:200px;"></div>
        <div class="Materiel" style="background-color:lightblue; width:500px; height:200px;"></div>
    </div>

    <div style="height:10000px;">
    </div>
    <br>
    <br>

</body>
</html>
