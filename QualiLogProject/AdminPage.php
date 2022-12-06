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

    <div id=BoutonCreerCompte><a href="RegisterPage.php">Créer un nouveau Compte</a></div>

    <table class=Tableau>
        <tr class=TableauTitreColonnes>
            <th class=TableauTitreItem>Prénom</th>
            <th class=TableauTitreItem>Nom</th>
            <th class=TableauTitreItem>Mail</th>
            <th class=TableauTitreItem>Admin</th>
            <th class=TableauTitreItem></th>            
        </tr>

        <?php
        $sql = 'SELECT * FROM wl_users;';
        $resStat = $mysqlClient->prepare($sql);
        $resStat->execute();
        $res = $resStat->fetchAll();
        
        foreach($res as $row) {?>
            <tr id=<?php echo($row['UserId']);?>>
                <td class=TableauItem><?php echo($row['FirstName']);?></td>
                <td class=TableauItem><?php echo($row['LastName']);?></td>
                <td class=TableauItem><?php echo($row['Mail']);?></td>
                <td class=TableauItem>
                    <input type="checkbox" class=AdminCheckbox <?php if($row['IsAdmin'] == 1) {echo("checked");}?>></input>
                </td>
                <td>
                    <div id=TableauBoutons>
                        <image src="./img/edit-button.png" class=ButtonIcon alt=Modifier onclick="ChangeUser(<?php echo($row['UserId']); ?>)"></image>
                        <image src="./img/delete.png" class=ButtonIcon alt=Supprimer onclick="DeleteUser(<?php echo($row['UserId']); ?>)"></image>
                    </div>
                </td>
            </tr>
        <?php 
        }?>
    </table>
    

    <h1 class=Titre>Gestion du Matériel</h1>



</body>
</html>
<script src="//code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="Scripts/AdminPageScripts.js"></script>