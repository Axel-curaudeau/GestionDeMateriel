<?php
session_start();
include("../inc/bddconnect.inc.php");
include("../inc/constantes.inc.php");

if(!isset($_SESSION['MAIL'])) {
    header("Location: LoginPage.php?alerte=notConnected");
    return;
}
if ($_SESSION["IsAdmin"] != 1) {
    header("Location: Home.php?alerte=notAdmin");
    return;
}

echo $_SESSION["MAIL"];
echo $_SESSION["USERID"];



$return_value = 0;

/* --- Récupération des données --- */
$BeginReservation = $_GET["debut"];
$EndReservation = $_GET["fin"];
$IdMaterial = $_GET["id"];

/* --- Vérification de la possibilité de réservation --- */

$q_available_date_interval = "SELECT * FROM wl_reservation WHERE Reference = :ref AND ((BeginDate <= :begin AND EndDate >= :begin) OR (BeginDate <= :end AND EndDate >= :end) OR (BeginDate >= :begin AND EndDate <= :end))";
$available_date_interval = $mysqlClient->prepare($q_available_date_interval);
$available_date_interval->execute(['begin' => $BeginReservation, 'end' => $EndReservation, 'ref' => $IdMaterial]);

if ($available_date_interval->rowCount() > 0) {
    $return_value = 1;
}else{
    /* --- Insertion de la réservation --- */

    $q_insert_reservation = 'INSERT INTO wl_reservation (BeginDate, EndDate, UserId, Reference) VALUES ("'.$BeginReservation.'", "'.$EndReservation.'", '.$_SESSION['USERID'].', "'.$IdMaterial.'")';
    $insert_reservation = $mysqlClient->prepare($q_insert_reservation);
    $insert_reservation->execute();

    $return_value = 0;
}


echo json_encode($return_value, JSON_PRETTY_PRINT);

?>