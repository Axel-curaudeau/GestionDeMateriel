<?php

include "../inc/constantes.inc.php";
include "../inc/bddconnect.inc.php";

$UserId = $_POST['UserId'];
$Prenom = $_POST['FirstName'];
$Nom = $_POST['LastName'];
$Mail = $_POST['Mail'];

$sql = 'SELECT * FROM wl_users WHERE UserId = :UserId';
$resStat = $mysqlClient->prepare($sql);
$resStat->execute(['UserId' => $UserId]);
$res = $resStat->fetchAll();

if($Mail != $res[0]['Mail']){
    $sql = 'SELECT * FROM WL_Users WHERE Mail = :Mail';
    $resStat = $mysqlClient->prepare($sql);
    $resStat->execute(['Mail' => $Mail]);
    $res = $resStat->fetchAll();
    if(count($res) != 0){
        header("Location: ChangeUserPage.php?alerte=mailAlreadyUsed&userId=".$UserId);
        return;
    }
}

$sql = 'UPDATE wl_users SET FirstName = :Prenom, LastName = :Nom, Mail = :Mail WHERE UserId = :UserId;';
$resStat = $mysqlClient->prepare($sql);
$resStat->execute(array(
    'Prenom' => $Prenom,
    'Nom' => $Nom,
    'Mail' => $Mail,
    'UserId' => $UserId
));
$resStat->execute();

header("Location: ".DOMAIN_URL."/QualiLogProject/AdminPageAccounts.php");

?>