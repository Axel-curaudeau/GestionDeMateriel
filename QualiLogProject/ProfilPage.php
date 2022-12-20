<?php session_start(); 
include("../inc/constantes.inc.php");?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Gestion de Matériel | Changement d'identifiants</title>  
    <link rel="stylesheet" href="style/styleW.css">
    <link href="img/edit_calendar.png" rel="shortcut icon" type="image/png">
</head>    
<body style="height:100vh;display:flex;justify-content:center;align-items:center;">
    <?php
    if(!isset($_SESSION['MAIL'])) {
        header("Location: LoginPage.php?alerte=notConnected");
        return;
    }
    include('Alertes.php');
    include("../inc/bddconnect.inc.php");

    $sql = "SELECT * FROM WL_Users WHERE Mail = :Mail";
    $query = $mysqlClient->prepare($sql);
    $query->execute(array(
        'Mail' => $_SESSION['MAIL']
    ));
    $row = $query->fetch();
    ?>

    <form action="Profil.php" method="POST">
        <div class="container" align="left">  
            <h1 style="white-space: nowrap; margin-top: 0;text-align: center;">Profil</h1>
            <label for="Prenom">Prénom : </label>
            <input type="text" placeholder="Prénom" name="Prenom" value= <?php echo($row['FirstName']); ?> required>
            <label for="Nom">Nom : </label>
            <input type="text" placeholder="Nom" name="Nom" value=<?php echo("'".$row['LastName']."'"); ?> required>
            <label for="Mail">Email : </label>   
            <input type="email" placeholder="adresse@email.fr" name="Mail" <?php echo('value="'.$_SESSION['MAIL'].'"'); ?> required>
            <label for="AncienMotDePasse">Ancien Mot de Passe : </label>   
            <input type="password" placeholder="Mot de Passe" name="AncienMotDePasse" required>
            <label for="NouveauMotDePasse">Nouveau Mot de Passe : </label>   
            <input type="password" placeholder="Mot de Passe" name="NouveauMotDePasse"> 
            <button type="submit" class="bouton">Mettre à jour</button>
            <p style="margin: 0;"><a class=return>Retour</a></p>
        </div>
    </form>  
</body>     
</html>

<script src="//code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="scripts/returnScript.js"></script>