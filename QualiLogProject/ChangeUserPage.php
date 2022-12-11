<?php session_start(); 
include("../inc/constantes.inc.php");
include("../inc/bddconnect.inc.php")?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Gestion de Matériel | Modification d'utilisateur</title>  
    <link rel="stylesheet" href="style/styleW.css" />
    <link href="img/edit_calendar.png" rel="shortcut icon" type="image/png">
</head>    
<body style="height:100vh;display:flex;justify-content:center;align-items:center;">
    <?php
    if(!isset($_SESSION['MAIL'])) {
        header("Location: LoginPage.php?alerte=notConnected");
        return;
    }
    include('menubar.php');
    include('Alerts.php');
    ?>

    <?php
    $sql = 'SELECT * FROM wl_users WHERE UserId = :UserId;';
    $resStat = $mysqlClient->prepare($sql);
    $resStat->execute(array(
        'UserId' => $_GET['userId']
    ));
    $res = $resStat->fetchAll();

    if (count($res) == 0) {
        echo("Utilisateur non trouvé");
        return;
    }

    ?>
    
    <form action="ChangeUser.php" method="POST">
        <div class="boxlogin" align="center">
            <div class="container" align="left">  
                <h1 style="white-space: nowrap; margin-top: 0;text-align: center;">Modifier l'utilisateur</h1>
                <label for="FirstName">Prénom</label>
                <input type="text" placeholder="Prénom" name=FirstName required value=<?php echo($res[0]['FirstName']) ?>>
                <label for="LastName">Nom</label>
                <input type="text" placeholder="Nom" name=LastName required value=<?php echo($res[0]['LastName']) ?>>
                <label for="Mail">Email : </label>   
                <input type="email" placeholder="adresse@email.fr" name="Mail" value=<?php echo($res[0]['Mail']); ?> required> 
                <button type="submit" class="bouton">Mettre à jour</button>
                <p style="margin: 0;"><a class=return>Retour</a></p>

                <input type="hidden" name="UserId" value=<?php echo($res[0]['UserId']) ?>>
            </div>
        </div>
    </form>  

<script src="//code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="Scripts/returnScript.js"></script>

</body>
</html>