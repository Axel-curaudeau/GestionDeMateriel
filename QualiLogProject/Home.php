<?php session_start();?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>QualiLogProject | Home</title>  
    <link rel="stylesheet" href="style/styleW.css" />
    <link href="img/edit_calendar.png" rel="shortcut icon" type="image/png">
</head>    
<body style="background-color: var(--backgroundColor);" id='body'>
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
            <a href="AdminPage.php">Admin</a>
        </div>
        <div class="bandeauElement">
            <a href="Deconnexion.php">Se Déconnecter</a>
        </div>
    </div>

    <br/><br/>
    <p class="titreCatalogue">Catalogue de matériel</p>
    <hr class="titleRule">
    <div class="listeMateriel">

        

        <?php

        include ('../inc/bddconnect.inc.php');

        function isAvailable($reference, $mysqlClient) {
            $today = date("Y-m-d");
            $q_is_available = "SELECT * FROM WL_Equipment NATURAL JOIN WL_Reservation WHERE WL_Equipment.Reference = :ref AND :today BETWEEN WL_Reservation.BeginDate AND WL_Reservation.EndDate";
            
            $query_is_available = $mysqlClient->prepare($q_is_available);
            
            $query_is_available->execute(array(
                'ref' => $reference,
                'today' => $today
            ));
            
            return $query_is_available->rowCount();
        }

        $q_liste_materiel = "SELECT * FROM WL_Equipment";
        $q_is_available = "SELECT * FROM WL_Equipment NATURAL JOIN WL_Reservation";

        $query_liste_materiel = $mysqlClient->prepare($q_liste_materiel);
        $query_is_available = $mysqlClient->prepare($q_is_available);

        $query_is_available->execute();
        $query_liste_materiel->execute();

        while($row = $query_liste_materiel->fetch()){?>
            <div class="Materiel">
            <img src= <?php echo('files/'.$row['Reference'].'.jpg'); ?> alt= <?php echo($row['Name']); ?>>
            <div class="DescriptionMateriel">
                <div class="nomMateriel">
                    <p><?php echo($row['Name']); ?></p>
            <?php if (isAvailable($row['Reference'], $mysqlClient) == 0) {?>
                        <img src="img/available.png" style="width:20px;height:20px;">
            <?php } else { ?>
                        <img src="img/borrowed.png" style="width:20px;height:20px;">
            <?php } ?>
                </div>
                <hr>
                <div class="versionEtRef">
                    <div class="version">
                        <p>Version :</p>
                        <p><?php echo($row['Version']); ?></p>
                    </div>
                    <div class="reference">
                        <p>Référence :</p>
                        <p><?php echo($row['Reference']); ?></p>
                    </div>
                </div>
                <input type="text" name="datefilter" class="form-control" placeholder="Réserver..."/>
            </div>
            </div>
        <?php } ?>
    </div>
    <div style="height:10000px;">
    </div>
    <br>
    <br>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript">$('input[name="datefilter"]').daterangepicker({autoUpdateInput: false,locale: {cancelLabel: 'Cancel', applyLabel: 'Réserver', format: 'DD/MM/YYYY'}}, function(start, end, label) {console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');});</script>
</body>
</html>
