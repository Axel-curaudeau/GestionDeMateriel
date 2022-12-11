<?php
include '../inc/bddconnect.inc.php';

session_start();

// If the user is not connected, redirect him to the login page
if(!isset($_SESSION['MAIL'])) {
    header("Location: LoginPage.php?alerte=notConnected");
    return;
}

if (!$_SESSION['IsAdmin']) {
    header("Location: Home.php?alerte=notAdmin");
    return;
}

// Check if the reference is given in order to delete the material
if (isset($_GET['ref'])) {

    // Delete the reservation associated with the material
    $q_delete_reservation = "DELETE FROM WL_Reservation WHERE Reference = '".$_GET['ref']."'";
    $query_delete_reservation = $mysqlClient->prepare($q_delete_reservation);
    $query_delete_reservation->execute();

    // Delete the material
    $q_delete_material = "DELETE FROM WL_Equipment WHERE Reference = '".$_GET['ref']."'";
    $query_delete_material = $mysqlClient->prepare($q_delete_material);
    $query_delete_material->execute();

    // Delete the image associated with the material on the server
    unlink("files/".$_GET['ref'].".jpg");

}

?>