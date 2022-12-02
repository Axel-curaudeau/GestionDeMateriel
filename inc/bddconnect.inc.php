<?php
include('constantes.inc.php');

try{
    $mysqlClient = new PDO(BDD_HOST, BDD_USER, BDD_PSWD);
} catch(Exception $e) {
    echo("Erreur de connexion à la base de données");
    die('Erreur : '.$e->getMessage());
}
?>