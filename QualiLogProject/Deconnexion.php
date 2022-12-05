<?php
include("../inc/constantes.inc.php");
session_start();
session_destroy();
header("Location: ".DOMAIN_URL."/QualiLogProject/LoginPage.php");
?>