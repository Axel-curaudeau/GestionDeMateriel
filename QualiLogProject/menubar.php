<?php
include "../inc/bddconnect.inc.php";

$q_privilege = "SELECT isAdmin FROM wl_users WHERE Mail = '".$_SESSION['MAIL']."'";
$query_privilege = $mysqlClient->prepare($q_privilege);
$query_privilege->execute();
$privilege = $query_privilege->fetch();

?>
<div class="bandeau">
    <div class="bandeauElement">
        <a href="ProfilPage.php">Mon Profil</a>
    </div>
    <div class="bandeauElement">
        <a href="Home.php">Accueil</a>
    </div>
    <?php
    if ($privilege['isAdmin'] == 1) : ?>
        <div class="bandeauElement">
            <a href="AdminPage.php">Panneau de contrôle</a>
        </div>
    <?php endif; ?>
    <div class="bandeauElement">
        <a href="Deconnexion.php">Se Déconnecter</a>
    </div>
</div>

<br/><br/>