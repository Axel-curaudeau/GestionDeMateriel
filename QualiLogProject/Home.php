<?php session_start();?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Gestion de Matériel | Accueil</title>  
    <link rel="stylesheet" href="style/styleW.css" />
    <link href="img/logo.png" rel="shortcut icon" type="image/png">
</head>    
<body style="background-color: var(--backgroundColor);" id='body'>

    <?php
    /* Vérification de la connexion */
    if(!isset($_SESSION['MAIL'])) {
        header("Location: LoginPage.php?alerte=notConnected");
        return;
    }

    include('Alertes.php'); // Affichage des alertes
    include('menubar.php'); // Affichage de la barre de navigation
    ?>

    <p class="titrePage">Catalogue de matériel</p>
    <hr class="titleRule">
    <div class="listeMateriel">

        <!-- objet à remplir pour ajouter à la BDD -->
        <?php if ($_SESSION["IsAdmin"] == 1) { ?>
            <form action="AddNewDevice.php" method="post" enctype="multipart/form-data">
            <div class="Materiel MaterielAdd">
                <a href="#" onclick="performClick('#inputNewPhoto')">
                    <img src="https://static.vecteezy.com/ti/vecteur-libre/p3/6253524-icone-de-point-d-interrogation-gratuit-vectoriel.jpg" alt="Ajouter un objet">
                </a>
                <div class="DescriptionMateriel">
                    <div class="nomMateriel">
                        <input type="text" name="name" placeholder="Nom de l'equipement" required>
                    </div>
                    <hr>
                    <div class="versionEtRef">
                        <div class="version">
                            <p>Version :</p>
                            <input type="text" name="version" placeholder="Version" required>
                        </div>
                        <div class="reference">
                            <p>Référence :</p>
                            <input type="text" name="reference" placeholder="Référence" required>
                        </div>
                    </div>
                    <input type="file" name="fileToUpload" id="inputNewPhoto" style="display:none;">
                    <input type="submit" value="Ajouter" name="submit">
                </div>
            </div>
            </form>
        <?php } ?>
        



        <!-- Liste des objets de la BDD -->
        <?php
        include ('../inc/bddconnect.inc.php');

        function isAvailable($reference, $mysqlClient) {
            $today = date("Y-m-d");
            $q_is_available = "SELECT * FROM wl_equipment NATURAL JOIN wl_reservation WHERE wl_equipment.Reference = :ref AND :today BETWEEN wl_reservation.BeginDate AND wl_reservation.EndDate";
            
            $query_is_available = $mysqlClient->prepare($q_is_available);
            
            $query_is_available->execute(array(
                'ref' => $reference,
                'today' => $today
            ));
            
            return $query_is_available->rowCount();
        }

        $q_liste_materiel = "SELECT * FROM wl_equipment";

        $query_liste_materiel = $mysqlClient->prepare($q_liste_materiel);

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
                <input type="text" name="datefilter" class="form-control" id="input<?php echo($row['Reference']); ?>"  placeholder="Réserver..."/>
            </div>
            </div>
        <?php } ?>
    </div>

    <!-- Scripts DateRangePicker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="scripts/inputdaterange.js"></script>
    
    <!-- Script pour ajouter un objet -->
    <script type="text/javascript" src="scripts/addMaterial.js"></script>
</body>
</html>
