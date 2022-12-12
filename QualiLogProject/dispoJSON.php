<?php
include("../inc/bddconnect.inc.php");

header('Content-Type: application/json');

$sql = 'SELECT wl_equipment.Reference, BeginDate, EndDate FROM wl_reservation RIGHT OUTER JOIN wl_equipment ON wl_reservation.Reference=wl_equipment.Reference;';
$resStat = $mysqlClient->prepare($sql);
$resStat->execute();
$res = $resStat->fetchAll();

$result = array();

// JSON with each date range for each reference

foreach ($res as $row) {
    $result[$row['Reference']][] = array(
        'begin' => $row['BeginDate'],
        'end' => $row['EndDate']
    );
}

echo json_encode($result, JSON_PRETTY_PRINT);
?>