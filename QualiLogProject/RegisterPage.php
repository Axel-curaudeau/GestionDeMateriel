<?php session_start(); 
include("../inc/constantes.inc.php")?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Gestion de matériel | Incription</title>  
    <link rel="stylesheet" href="style/styleW.css" />
    <link href="img/edit_calendar.png" rel="shortcut icon" type="image/png">
</head>    
<body style="height:100vh;display:flex;justify-content:center;align-items:center;">

    <?php 
    include('Alertes.php');
    ?>

    <form action="Register.php" method="POST">
        <div class="container" align="left">  
            <h1 style="white-space: nowrap; margin-top: 0;text-align: center;">Inscription <br> Gestion de matériel</h1>
            <label for="Prenom">Prénom</label>
            <input type="text" placeholder="Prénom" name="FirstName" required>
            <label for="Nom">Nom</label>
            <input type="text" placeholder="Nom" name="LastName" required>
            <label for="Mail">Adresse Mail : </label>   
            <input type="email" placeholder="adresse@email.fr" name="Mail" required>
            <label for="MotDePasse">Mot de Passe :</label>   
            <input type="password" placeholder="Mot de Passe" name="MotDePasse" required> 
            <button type="submit" class="bouton">Créer un compte</button>
            <p style="margin: 0;"><a class=return>Retour</a></p>
        </div>
    </form>  
</body>     
</html>


<script src="//code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="scripts/returnScript.js"></script>