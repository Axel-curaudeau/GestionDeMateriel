<?php session_start(); 
include("../inc/constantes.inc.php");
include("../inc/bddconnect.inc.php")?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>QualiLogProject | Admin</title>  
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
            <a href="Home.php">Home</a>
        </div>
        <div class="bandeauElement">
            <a href="Deconnexion.php">Se Déconnecter</a>
        </div>
    </div>


    <h1 class=Titre>Gestion des Comptes</h1>

    <div id=BoutonCreerCompte><button href="RegisterPage.php">Créer un nouveau Compte</button></div>

    <table class=Tableau>
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Mail</th>
            <th>Admin</th>
            <th></th>            
        </tr>

        <?php
        $sql = 'SELECT * FROM wl_users;';
        $resStat = $mysqlClient->prepare($sql);
        $resStat->execute();
        $res = $resStat->fetchAll();

        
        foreach($res as $row) {
            ?>
            <tr id="<?php echo($row['UserID']);?>">
                <td><?php echo($row['FirstName']);?></td>
                <td><?php echo($row['LastName']);?></td>
                <td><?php echo($row['Mail']);?></td>
                <td>
                    <input type="checkbox" <?php if($row['IsAdmin'] == 1) {echo("checked");}?>></input>
                </td>
                <td>
                    <image src="./img/edit-button.png" alt=Modifier onclick="ChangeUser(<?php echo($row['UserID']); ?>)"></image>
                    <image src="./img/delete.png" alt=Supprimer onclick="DeleteUser(<?php echo($row['UserID']); ?>)"></image>
                </td>
            </tr>
        <?php 
        }?>
    </table>
    
    <h1 class=Titre>Gestion du Matériel</h1>

    <div id=NewDeviceButton><a href="NewDevicePage.php">Créer un nouveau Matériel</a></div>


</body>
</html>
<script src="//code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="Scripts/AdminPageScripts.js"></script>