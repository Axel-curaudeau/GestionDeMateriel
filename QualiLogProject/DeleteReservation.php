<?php
session_start();
include '../inc/bddconnect.inc.php';

// If the user is not connected, redirect him to the login page
if(!isset($_SESSION['MAIL'])) {
    header("Location: LoginPage.php?alerte=notConnected");
    return;
}

if (isset($_GET['reservationId'])) {

    // Delete the reservation associated with the reference
    $q_delete_reservation = "DELETE FROM wl_reservation WHERE ReservationID = '".$_GET['reservationId']."'";
    $query_delete_reservation = $mysqlClient->prepare($q_delete_reservation);
    $query_delete_reservation->execute();
}
?>