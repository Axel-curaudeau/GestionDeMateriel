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

    <h1>Gestion de Comptes</h1>
    <h2>Liste des comptes</h2>
    <table class=Tableau>
        <tr class=TableauTitreColonnes>
            <th class=TableauTitreItem>Prénom</th>
            <th class=TableauTitreItem>Nom</th>
            <th class=TableauTitreItem>Mail</th>
            <th class=TableauTitreItem>Admin</th>
        </tr>
        <?php
            $sql = 'SELECT * FROM wl_users;';
            $resStat = $mysqlClient->prepare($sql);
            $resStat->execute();
            $res = $resStat->fetchAll();
            foreach($res as $row) {
                echo "<tr>";
                echo "<td class=TableauItem>".$row['FirstName']."</td>";
                echo "<td class=TableauItem>".$row['LastName']."</td>";
                echo "<td class=TableauItem>".$row['Mail']."</td>";
                if ($row['IsAdmin'] == 1) {
                    echo "<td class=TableauItem>Oui</td>";
                } else {
                    echo "<td class=TableauItem>Non</td>";
                }
                echo "</tr>";
            }
        ?>
    </table>
    <a href="RegisterPage.php">Créer un Compte</a>



    <h1>Gestion du Matériel</h1>

</body>
</html>