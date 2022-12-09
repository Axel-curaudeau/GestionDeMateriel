<?php session_start(); 
include("../inc/constantes.inc.php")?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Gestion de matériel | Nouveau Matériel</title>  
    <link rel="stylesheet" href="style/styleW.css" />
    <link href="img/edit_calendar.png" rel="shortcut icon" type="image/png">
</head>    
<body style="height:100vh;display:flex;justify-content:center;align-items:center;">
    <?php if(!isset($_SESSION['MAIL'])) {
        header("Location: ".DOMAIN_URL."/QualiLogProject/LoginPage.php?alerte=notConnected");
        return;
    }?>

    <form action="NewDevice.php" method="POST">
        <div class="container" align="left">  
            <h1 style="white-space: nowrap; margin: 0 10px 10px 10px;text-align: center;">Créer un Nouveau Matériel</h1>
            <label for="nom">Nom du Matériel</label>
            <input type="text" placeholder="Iphone 11" name="nom" required>
            <label for="version">Version</label>
            <input type="text" placeholder="V8.2" name="version" required>
            <label for="reference">Référence</label>
            <input type="text" placeholder="AP123" name="reference" required pattern="[A-Z]{2}[0-9]{3}">
            <label for="number">Numéro de Téléphone</label>
            <input type="text" placeholder="0606060606" name="number" required pattern="[0-9]{10}">
            <label for="fichier">Photo</label>
            <input type="file" name="fichier" id="fichier" />
            <button type="submit" class="bouton">Ajouter le Matériel</button>
            <p style="margin: 0;"><a class=return>Retour</a></p>
        </div>
    </form>  
</body>     
</html>


<script src="//code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="Scripts/returnScript.js"></script>