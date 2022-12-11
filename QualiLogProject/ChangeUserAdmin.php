<?php session_start(); 
include("../inc/constantes.inc.php");
include("../inc/bddconnect.inc.php");

if(!isset($_SESSION['MAIL'])) {
    header("Location: LoginPage.php?alerte=notConnected");
    return;
}

if (!$_SESSION['IsAdmin']) {
    header("Location: Home.php?alerte=notAdmin");
    return;
}

$userId = $_GET['userId'];
$admin = $_GET['admin'];

$sql = 'UPDATE wl_users SET IsAdmin = :admin WHERE UserId = :userId;';
$resStat = $mysqlClient->prepare($sql);
$resStat->execute(array(':userId' => $userId, ':admin' => $admin));

if($userId == $_SESSION['USERID']) {
    $_SESSION['IsAdmin'] = $admin;
    header("Location: Home.php?alerte=changeAdmin");
}

?>