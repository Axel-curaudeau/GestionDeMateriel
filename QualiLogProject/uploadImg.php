<?php
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
$message = '';
$nomImage = '';

/************************************************************
 * Vérification de l'existance du dossier
 *************************************************************/
if( !is_dir(TARGET) ) {
    exit("Erreur : Le dossier 'files' n'existe pas !");
}


/************************************************************
 * Script d'upload
 *************************************************************/
// On verifie si le champ est rempli
if(!empty($_POST)) {
    if(!empty($_FILES['fichier']['name'])) {
        // Recuperation de l'extension du fichier
        $extension  = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);

        // On verifie l'extension du fichier
        if(in_array(strtolower($extension),$tabExt)) {
            // On recupere les dimensions du fichier
            $infosImg = getimagesize($_FILES['fichier']['tmp_name']);

            // On verifie le type de l'image
            if($infosImg[2] >= 1 && $infosImg[2] <= 14) {
                // On verifie les dimensions et taille de l'image
                if(($infosImg[0] == REQUIRED_WIDTH) && ($infosImg[1] == REQUIRED_HEIGHT) && (filesize($_FILES['fichier']['tmp_name']) <= MAX_SIZE)) {
                    // Parcours du tableau d'erreurs
                    if(isset($_FILES['fichier']['error']) && UPLOAD_ERR_OK === $_FILES['fichier']['error']) {
                        // On renomme le fichier
                        $nomImage = md5(uniqid()) .'.'. $extension;

                        // Si c'est OK, on teste l'upload
                        if(move_uploaded_file($_FILES['fichier']['tmp_name'], './'.TARGET.'/'.$nomImage)) {
                            $message = 'Upload réussi !';
                        } else {
                            // Sinon on affiche une erreur systeme
                            $message = 'Problème lors de l\'upload !';
                        }
                    } else {
                        $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
                    }
                } else {
                    // Sinon erreur sur les dimensions et taille de l'image
                    $message = 'Erreur dans les dimensions de l\'image !';
                }
            } else {
                // Sinon erreur sur le type de l'image
                $message = 'Le fichier à uploader n\'est pas une image !';
            }
        } else {
            // Sinon on affiche une erreur pour l'extension
            $message = 'L\'extension du fichier est incorrecte !';
        }
    } else {
        // Sinon on affiche une erreur pour le champ vide
        $message = 'Aucun fichier!';
    }
} else {
    $message = 'Veuillez remplir le formulaire svp !';
}
echo $message;
?>