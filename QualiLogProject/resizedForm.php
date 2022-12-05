<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <title>Upload d'une image sur le serveur !</title>
    </head>
    <body>
        <?php
            if(!empty($message)) {
                echo '<p>',"\n";
                echo "\t\t<strong>", htmlspecialchars($message) ,"</strong>\n";
                echo "\t</p>\n\n";
            }
        ?>

        <!-- Debut du formulaire -->
        <form action="resizer.php" method="POST" enctype="multipart/form-data">
            <p>
                <label for="fichier">Fichier :</label>
                <input type="file" name="fichier" id="fichier" />
            </p>
            <p>
                <label for="width">Largeur :</label>
                <input type="text" name="width" id="width" />
            </p>
            <p>
                <label for="height">Hauteur :</label>
                <input type="text" name="height" id="height" />
            </p>
            <p>
                <input type="submit" name="submit" value="Envoyer" />
            </p>
        </form>
    </body>
</html>