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

    if(!$_SESSION['IsAdmin']) {
        header("Location: Home.php?alerte=notAdmin");
        return;
    }
    include 'menubar.php'
    ?>
    <p class="titrePage">Gestion des comptes</p>
    <hr class="titleRule">

    <div class="AddUserButton" style="text-align:center; overflow: auto;">
        <a class="NoUnderline" href="RegisterPage.php">
            <span style="vertical-align:middle;">Ajouter un nouvel utilisateur</span>
            <img class="LinkIcon" src="img/signUp.png" style="width:20px; vertical-align:middle;">
        </a>
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


</body>
</html>
<script src="//code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="Scripts/AdminPageScripts.js"></script>