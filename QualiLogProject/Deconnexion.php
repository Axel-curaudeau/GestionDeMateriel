<?php
include("../inc/constantes.inc.php");
session_start();
session_destroy();
header("Location: LoginPage.php");
?>