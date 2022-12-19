<?php session_start();
include("../inc/constantes.inc.php") ?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Gestion de Matériel | Mot de passe oublié</title>  
    <link rel="stylesheet" href="style/styleW.css">
    <link href="img/logo.png" rel="shortcut icon" type="image/png">
</head>
<?php
    if(!isset($_SESSION['MAIL'])) {
        header("Location: LoginPage.php?alerte=notConnected");
        return;
    }
    include('menubar.php');
    include('Alertes.php');
?>

<body style="height:100vh;display:flex;justify-content:center;align-items:center;">
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