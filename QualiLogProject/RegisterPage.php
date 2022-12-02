<?php session_start(); 
include("../inc/constantes.inc.php")?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Gestion de matériel | Sign Up</title>  
    <link rel="stylesheet" href="style/styleW.css" />
    <link href="img/edit_calendar.png" rel="shortcut icon" type="image/png">
</head>    
<body style="height:100vh;display:flex;justify-content:center;align-items:center;">

    <?php if(isset($_GET['alerte'])): ?>
        <?php if($_GET['alerte'] == 'mailFail'): ?>
            <div class="Alerte" style="background-color: rgb(255,175,175);">
                <p>Cette adresse mail est déjà utilisée !</p>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <form action="Register.php" method="POST">
        <div class="container" align="left">  
            <h1 style="white-space: nowrap; margin-top: 0;">Inscription <br> Gestion de matériel</h1>
            <label for="Prenom">Prénom</label>
            <input type="text" placeholder="Prénom" name="FirstName" required>
            <label for="Nom">Nom</label>
            <input type="text" placeholder="Nom" name="LastName" required>
            <label for="Mail">Adresse Mail : </label>   
            <input type="email" placeholder="adresse@email.fr" name="Mail" required>
            <label for="MotDePasse">Mot de Passe :</label>   
            <input type="password" placeholder="Mot de Passe" name="MotDePasse" required> 
            <button type="submit" class="bouton">Créer un compte</button>
            <p style="margin: 0;"><a href="LoginPage.php">Se Connecter</a></p>
        </div>
    </form>  
</body>     
</html>