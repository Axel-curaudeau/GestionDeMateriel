<?php

include "../inc/constantes.inc.php";
include "../inc/bddconnect.inc.php";

$UserId = $_POST['UserId'];
$Prenom = $_POST['FirstName'];
$Nom = $_POST['LastName'];
$Mail = $_POST['Mail'];

$sql = 'UPDATE wl_users SET FirstName = :Prenom, LastName = :Nom, Mail = :Mail WHERE UserId = :UserId;';
$resStat = $mysqlClient->prepare($sql);
$resStat->execute(array(
    'Prenom' => $Prenom,
    'Nom' => $Nom,
    'Mail' => $Mail,
    'UserId' => $UserId
));
$resStat->execute();

header("Location: ".DOMAIN_URL."/QualiLogProject/AdminPage.php");

?>