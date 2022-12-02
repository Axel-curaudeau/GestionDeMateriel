<?php session_start(); 
include("../inc/constantes.inc.php");?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>OrgaEDT | Profil</title>  
    <link rel="stylesheet" href="style/styleOrgaEDT.css">
    <link href="img/edit_calendar.png" rel="shortcut icon" type="image/png">
</head>    
<body style="height:100vh;display:flex;justify-content:center;align-items:center;">
    <?php
    if(!isset($_SESSION['ORGAEDT_LOGGED_MAIL']))
    {
        header("Location: ".DOMAIN_URL."/OrgaEDT/LoginPage.php?alerte=notConnected");
        return;
    }
    ?>
    <?php if(isset($_GET['alerte'])): ?>
        <?php if($_GET['alerte'] == 'wrongMdp'): ?>
            <div class="Alerte" style="background-color: rgb(255,175,175);">
                <p>Mauvais Mot de Passe !</p>
            </div>
        <?php elseif($_GET['alerte'] == 'mailAlreadyUsed'): ?>
            <div class="Alerte" style="background-color: rgb(255,175,175);">
                <p>Cette adresse mail est déjà utilisée !</p>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <form action="Profil.php" method="POST">
        <div class="boxlogin" align="center">
            <div class="container" align="left">  
                <h1 style="white-space: nowrap; margin-top: 0;">Mon profil OrgaEDT</h1>
                <label for="Mail">Email : </label>   
                <input type="email" placeholder="adresse@email.fr" name="Mail" <?php echo('value="'.$_SESSION['ORGAEDT_LOGGED_MAIL'].'"'); ?> required>
                <label for="AncienMotDePasse">Ancien Mot de Passe : </label>   
                <input type="password" placeholder="Mot de Passe" name="AncienMotDePasse" required>
                <label for="NouveauMotDePasse">Nouveau Mot de Passe : </label>   
                <input type="password" placeholder="Mot de Passe" name="NouveauMotDePasse" required> 
                <button type="submit" class="bouton">Mettre à jour</button>
                <p style="margin: 0;"><a href="home.php">Retour</a></p>
            </div>
        </div>
    </form>  
</body>     
</html>