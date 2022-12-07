<?php session_start(); 
include("../inc/constantes.inc.php");?>

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
            <a href="#">Admin</a>
        </div>
        <div class="bandeauElement">
            <a href="Deconnexion.php">Se Déconnecter</a>
        </div>
    </div>

    <br/><br/>

    <div class="listeMateriel">
        <div class="Materiel">
            <img src="https://c0.lestechnophiles.com/www.numerama.com/wp-content/uploads/2022/09/iphone-14-pro-1068x601.jpg?resize=1024,600&amp;key=5ee9a6e4" alt="iPhone 14">
            <div class="DescriptionMateriel">
                <div class="nomMateriel">
                    <p>iPhone 14</p>
                    <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" style="width:20px;height:20px;">
                </div>
                <hr>
                <div class="versionEtRef">
                    <div class="version">
                        <p>Version :</p>
                        <p>16.1</p>
                    </div>
                    <div class="reference">
                        <p>Référence :</p>
                        <p>AP005</p>
                    </div>
                </div>
                <input type="text" name="datefilter" class="form-control" placeholder="Réserver..."/>
            </div>
        </div>

        <div class="Materiel">
            <img src="https://cdn.lesnumeriques.com/optim/product/60/60053/de167798-galaxy-s20-fe-5g__450_400.jpeg" alt="Samsung Galaxy S20">
            <div class="DescriptionMateriel">
                <div class="nomMateriel">
                    <p >Galaxy S20</p>
                    <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" style="width:20px;height:20px;">
                </div>
                <hr>
                <div class="versionEtRef">
                    <div class="version">
                        <p>Version :</p>
                        <p>13.2</p>
                    </div>
                    <div class="reference">
                        <p>Référence :</p>
                        <p>AN001</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="Materiel">
            <img src="https://www.cdiscount.com/pdt2/2/8/b/1/300x300/opfindx3l128b/rw/oppo-find-x3-lite-5g-128go-bleu.jpg" alt="Oppo Find X3 Lite">
            <div class="DescriptionMateriel">
                <div class="nomMateriel">
                    <p >Oppo Find X3 Lite</p>
                    <img src="https://cdn-icons-png.flaticon.com/512/190/190406.png" style="width:20px;height:20px;">
                </div>
                <hr>
                <div class="versionEtRef">
                    <div class="version">
                        <p>Version :</p>
                        <p>12.6</p>
                    </div>
                    <div class="reference">
                        <p>Référence :</p>
                        <p>AN002</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="Materiel">
            <img src="https://m.media-amazon.com/images/I/51PNvN0ABsL._AC_SS450_.jpg" alt="Samsung Galaxy A13">
            <div class="DescriptionMateriel">
                <div class="nomMateriel">
                    <p >Galalaxy A13</p>
                    <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" style="width:20px;height:20px;">
                </div>
                <hr>
                <div class="versionEtRef">
                    <div class="version">
                        <p>Version :</p>
                        <p>13.1</p>
                    </div>
                    <div class="reference">
                        <p>Référence :</p>
                        <p>AN003</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="Materiel"></div>
        <div class="Materiel"></div>
        <div class="Materiel"></div>
        <div class="Materiel"></div>
        <div class="Materiel"></div>
        <div class="Materiel"></div>
        <div class="Materiel"></div>
        <div class="Materiel"></div>
        <div class="Materiel"></div>
        <div class="Materiel"></div>
        <div class="Materiel"></div>
        <div class="Materiel"></div>
        <div class="Materiel"></div>
        <div class="Materiel"></div>
        <div class="Materiel"></div>
        <div class="Materiel"></div>
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
