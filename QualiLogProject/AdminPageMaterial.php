<?php session_start(); 
include("../inc/constantes.inc.php");
include("../inc/bddconnect.inc.php")?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Gestion de Matériel | Gestion du catalogue de matériel</title>  
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

    <p class="titrePage">Gestion du catalogue de matériel</p>
    <hr class="titleRule">
    <div class="listeMateriel">
    
    <div class="AddUserButton" style="text-align:center; overflow: auto;">
        <a class="NoUnderline" href="RegisterPage.php">
            <span style="vertical-align:middle;">Ajouter un nouvel appareil</span>
            <img class="LinkIcon" src="img/add.png" style="width:20px; vertical-align:middle;">
        </a>
    </div>

    <?php
    $q_liste_materiel = "SELECT * FROM WL_Equipment";
    $query_liste_materiel = $mysqlClient->prepare($q_liste_materiel);
    $query_liste_materiel->execute();

    while($row = $query_liste_materiel->fetch()){ ?>
            <div id="<?php echo($row['Reference']); ?> " class="Materiel">
              <img src=<?php echo '"files/'.$row['Reference'].'.jpg" alt="'.$row['Name'].'"'; ?> >
              <div class="DescriptionMateriel">
                  <div class="nomMateriel">
                        <p><?php echo ($row['Name']); ?></p>
                        <image src="./img/delete.png" alt=Supprimer onclick="DeleteMaterial('<?php echo($row['Reference']); ?>')" style="width:20px;height:20px;"></image>
                  </div>
                  <hr>
                  <div class="versionEtRef">
                      <div class="version">
                          <p>Version :</p>
                          <p><?php echo ($row['Version']); ?></p>
                      </div>
                      <div class="reference">
                          <p>Référence :</p>
                          <p><?php echo ($row['Reference']); ?></p>
                      </div>
                  </div>
              </div>
            </div>
        <?php } ?>
</div>

</body>
</html>
<script src="//code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="Scripts/AdminPageScripts.js"></script>