<?php session_start();
include("../inc/constantes.inc.php");

if(!isset($_SESSION['MAIL'])) {
    header("Location: LoginPage.php?alerte=notConnected");
    return;
}
if ($_SESSION["IsAdmin"] != 1) {
    header("Location: Home.php?alerte=notAdmin");
    return;
}

include("../inc/bddconnect.inc.php");

/* --- Récupération des données --- */
$DeviceName = $_POST["name"];
$DeviceVersion = $_POST["version"];
$DeviceRef = $_POST["reference"];
$DevicePhoto = $_FILES["fileToUpload"]["name"];

/* --- Vérification de l'unicité de la référence --- */
$sql = 'SELECT * FROM wl_equipment WHERE Reference = :ref';
$resStat = $mysqlClient->prepare($sql);
$resStat->execute(['ref' => $DeviceRef]);
$res = $resStat->fetchAll();

if (count($res) != 0) {
    header("Location: Home.php?alerte=refAlreadyExists");
    return;
}


/************************************************************
 *        Début vérifications et stockage de l'image        *
 ************************************************************/

/* --- Vérification de l'image --- */
$target_dir = "../files/";

// Constantes
define('TARGET', 'files');      // Repertoire cible
define('MAX_SIZE', 200000);     // Taille max en octets du fichier
define('REQUIRED_WIDTH', 500);       // Largeur max de l'image en pixels
define('REQUIRED_HEIGHT', 500);      // Hauteur max de l'image en pixels

// Tableaux de donnees
$tabExt = array('jpg');    // Extensions autorisees
$infosImg = array();

// Variables
$extension = '';
$nomImage = '';

/* --- Vérification de l'existance du dossier --- */
if( !is_dir(TARGET) ) {
    header("Location: Home.php?alerte=missingFolder");
    return;
}

/* --- Vérification de l'existence du fichier --- */
if (empty($_FILES['fileToUpload']['name'])) {
    header("Location: Home.php?alerte=emptyImage");
    return;
}

/* --- Vérification de l'extension du fichier --- */
$extension  = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
if (!in_array(strtolower($extension),$tabExt)) {
    header("Location: Home.php?alerte=wrongExtension");
    return;
}

/* --- Vérification de la taille du fichier --- */
$infosImg = getimagesize($_FILES['fileToUpload']['tmp_name']);
if ($_FILES['fileToUpload']['size'] > MAX_SIZE) {
    header("Location: Home.php?alerte=tooBig");
    return;
}
if (($infosImg[0] != REQUIRED_WIDTH) || ($infosImg[1] != REQUIRED_HEIGHT)) {
    header("Location: Home.php?alerte=wrongSize");
    return;
}

/* --- Vérification du tableau d'erreurs --- */
if (isset($_FILES['fileToUpload']['error']) && UPLOAD_ERR_OK !== $_FILES['fileToUpload']['error']) {
    header("Location: Home.php?alerte=errorTable&errornum=".$_FILES['fileToUpload']['error']);
    return;
}

/* --- Upload de l'image --- */
$nomImage = $DeviceRef .'.'. $extension;

if (!move_uploaded_file($_FILES['fileToUpload']['tmp_name'], TARGET.'/'.$nomImage)) {
    header("Location: Home.php?alerte=uploadError");
    return;
}

/************************************************************
 *          Fin vérifications et stockage de l'image        *
 ************************************************************/

/* --- Insertion dans la base de données --- */
$sql = 'INSERT INTO WL_Equipment (Reference, Name, Version) VALUES (:ref, :name, :version)';
$resStat = $mysqlClient->prepare($sql);
$resStat->execute(['ref' => $DeviceRef, 'name' => $DeviceName, 'version' => $DeviceVersion]);

header("Location: Home.php?alerte=uploadSuccess");

?>