<?php
$q_delete_material = "DELETE FROM WL_Equipment WHERE Reference = '".$_GET['ref']."'";
$query_delete_material = $mysqlClient->prepare($q_delete_material);
$query_delete_material->execute();
?>