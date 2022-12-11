<?php session_start(); 
include("../inc/constantes.inc.php");
include("../inc/bddconnect.inc.php");

if(!isset($_SESSION['MAIL'])) {
    header("Location: LoginPage.php?alerte=notConnected");
    return;
}

$userId = $_GET['userId'];

$sql = 'DELETE FROM wl_users WHERE UserId = :userId;';
$resStat = $mysqlClient->prepare($sql);
$resStat->execute(array(':userId' => $userId));
?>