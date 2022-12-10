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
        header("Location: LoginPage.php?alerte=notConnected");
        return;
    }
    include 'menubar.php'
    ?>

    <h1 id="comptes" class=Titre>Gestion des Comptes</h1>
    <div style="text-align:center;">
        <a href="RegisterPage.php"><img src="img/signUp.png" style="width:30px;"></a>
    </div>
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
    
    <h1 id="materiel" class=Titre>Gestion du Matériel</h1>

    <div id=NewDeviceButton><a href="NewDevicePage.php">Créer un nouveau Matériel</a></div>


</body>
</html>
<script src="//code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="Scripts/AdminPageScripts.js"></script>