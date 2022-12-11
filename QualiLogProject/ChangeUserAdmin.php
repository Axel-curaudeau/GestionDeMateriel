<?php session_start(); 
include("../inc/constantes.inc.php");
include("../inc/bddconnect.inc.php");

if(!isset($_SESSION['MAIL'])) {
    header("Location: ".DOMAIN_URL."/QualiLogProject/LoginPage.php?alerte=notConnected");
    return;
}

if (!$_SESSION['IsAdmin']) {
    header("Location: ".DOMAIN_URL."/QualiLogProject/Home.php?alerte=notAdmin");
    return;
}

$userId = $_GET['userId'];
$admin = $_GET['admin'];

$sql = 'UPDATE wl_users SET IsAdmin = :admin WHERE UserId = :userId;';
$resStat = $mysqlClient->prepare($sql);
$resStat->execute(array(':userId' => $userId, ':admin' => $admin));

?>