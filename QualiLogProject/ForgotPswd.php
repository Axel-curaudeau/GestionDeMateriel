<?php session_start();
include("../inc/constantes.inc.php") ?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>OrgaEDT | Mot de passe oublié</title>  
    <link rel="stylesheet" href="style/styleW.css">
    <link href="img/edit_calendar.png" rel="shortcut icon" type="image/png">
</head>
<body style="height:100vh;display:flex;justify-content:center;align-items:center;">
    <?php if(isset($_GET['alerte'])): ?>
        <?php if($_GET['alerte'] == 'noEmail'): ?>
            <div class="Alerte" style="background-color: rgb(255,175,175);">
                <p>Adresse mail invalide !</p>
            </div>
        <?php elseif($_GET['alerte'] == 'EmailError'): ?>
            <div class="Alerte" style="background-color: rgb(255,175,175);">
                <p>Adresse mail invalide !</p>
            </div>
        <?php elseif($_GET['alerte'] == 'spamReset'): ?>
            <div class="Alerte" style="background-color: rgb(255,175,175);">
                <p>Vous devez attendre 24h depuis le dernier changement de mot de passe !</p>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <form action="UpdateResetPswd.php" method="POST">
        <div class="container", align="left">  
            <h1 style="white-space: nowrap; margin-top: 0;">Mot de passe oublié</h1>
            <label for="Mail">Adresse Mail :</label>   
            <input type="email" placeholder="adresse@mail.fr" name="Mail" id="Mail" required>
            <button type="submit" class="PetitBouton">Recevoir un mail</button>
            <p style="margin: 0;"><a href="LoginPage.php">Se Connecter</a></p>
        </div>
    </form>  
</body>     
</html>