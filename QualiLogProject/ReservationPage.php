<?php session_start(); 
include("../inc/constantes.inc.php");?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Gestion de Matériel | Réservations</title>  
    <link rel="stylesheet" href="style/styleW.css">
    <link href="img/edit_calendar.png" rel="shortcut icon" type="image/png">
</head>    
<body style="background-color: var(--homeBackgroundColor);" id='body'>
    <?php
    if(!isset($_SESSION['MAIL'])) {
        header("Location: LoginPage.php?alerte=notConnected");
        return;
    }
    include('Alertes.php');
    include 'menubar.php';
    ?>

    <p class="titrePage">Réservations en cours</p>
    <hr class="titleRule">

    <div class="listeMateriel">
        <?php
        $q_reservations = "SELECT * FROM WL_Reservation NATURAL JOIN WL_Equipment WHERE UserID = :UserID";
        $query_reservations = $mysqlClient->prepare($q_reservations);
        $query_reservations->execute(['UserID' => $_SESSION['USERID']]); ?>

        <p id="NoReservation" style="text-align:center; margin-top: 20px;" <?php if ($query_reservations->rowCount() != 0){echo("hidden");}?> >Vous n'avez aucune réservation en cours.</p>
        <?php while($row2 = $query_reservations->fetch()){ ?>

            <div id="<?php echo($row2['ReservationID']); ?>" class="Materiel">
                <img src=<?php echo '"files/'.$row2['Reference'].'.jpg" alt="'.$row2['Name'].'"'; ?> >
                <div class="DescriptionMateriel">
                    <div class="nomMateriel">
                            <p><?php echo ($row2['Name']); ?></p>
                            <image src="./img/delete.png" alt=Supprimer onclick="DeleteReservation('<?php echo($row2['ReservationID']); ?>')" style="width:20px;height:20px;"></image>
                    </div>
                    <hr>
                    <div class="versionEtRef">
                        <div class="version">
                            <p>Version :</p>
                            <p><?php echo ($row2['Version']); ?></p>
                        </div>
                        <div class="reference">
                            <p>Référence :</p>
                            <p><?php echo ($row2['Reference']); ?></p>
                        </div>
                    </div>
                    <div class="dateReservation">
                        <p>Période de réservation :</p>
                        <p style="font-weight: bold;">
                            <?php
                            
                            $begindate = str_replace('-"', '/', $row2['BeginDate']);  
                            $enddate = str_replace('-"', '/', $row2['EndDate']);

                            $newBeginDate = date("d/m/Y", strtotime($begindate));
                            $newEndDate = date("d/m/Y", strtotime($enddate));  
                            echo ('Du '.$newBeginDate.' au '.$newEndDate); 
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php }; ?>
    </div>
</body>     
</html>

<script src="//code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="Scripts/AdminPageScripts.js"></script>
<script src="scripts/returnScript.js"></script>