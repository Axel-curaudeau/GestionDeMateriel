<?php if(isset($_GET['alerte'])): ?>
    <?php if($_GET['alerte'] == 'registered'): ?>
        <div class="Alerte" style="background-color: rgb(175,255,175);">
            <p>Utilisateur enregistré, vous pouvez vous connecter !</p>
        </div>
    <?php elseif($_GET['alerte'] == 'mailAlreadyUsed'): ?>
        <div class="Alerte" style="background-color: rgb(255,175,175);">
            <p>Cette adresse mail est déjà utilisée !</p>
        </div>
    <?php elseif($_GET['alerte'] == 'failConnect'): ?>
        <div class="Alerte" style="background-color: rgb(255,175,175);">
            <p>Identifiants incorrects !</p>
        </div>
    <?php elseif($_GET['alerte'] == 'wrongEmail'): ?>
        <div class="Alerte" style="background-color: rgb(255,175,175);">
            <p>Adresse mail invalide !</p>
        </div>
    <?php elseif($_GET['alerte'] == 'wrongMdp'): ?>
        <div class="Alerte" style="background-color: rgb(255,175,175);">
            <p>Mauvais Mot de Passe !</p>
        </div>
    <?php elseif($_GET['alerte'] == 'notConnected'): ?>
        <div class="Alerte" style="background-color: rgb(255,175,175);">
            <p>Vous devez vous connecter !</p>
        </div>
    <?php elseif($_GET['alerte'] == 'updateSuccess'): ?>
        <div class="Alerte" style="background-color: rgb(175,255,175);">
            <p>Profil mis à jour, vous pouvez vous reconnecter !</p>
        </div>
    <?php elseif($_GET['alerte'] == 'PswdReset'): ?>
        <div class="Alerte" style="background-color: rgb(175,255,175);">
            <p>Mot de passe temporaire envoyé par mail !</p>
        </div>
    <?php elseif($_GET['alerte'] == 'notAdmin'): ?>
        <div class="Alerte" style="background-color: rgb(255,175,175);">
            <p>Vous n'êtes pas Administrateur, vous ne pouvez pas utiliser la vue Admin !</p>
        </div>
    <?php elseif($_GET['alerte'] == 'refAlreadyExists'): ?>
        <div class="Alerte" style="background-color: rgb(255,175,175);">
            <p>Un appareil avec cette référence existe déjà !</p>
        </div>
    <?php elseif($_GET['alerte'] == 'missingFolder'): ?>
        <div class="Alerte" style="background-color: rgb(255,175,175);">
            <p>Le dossier /files/ n'existe pas !</p>
        </div>
    <?php elseif($_GET['alerte'] == 'emptyImage'): ?>
        <div class="Alerte" style="background-color: rgb(255,175,175);">
            <p>Vous n'avez pas sélectionné d'image !</p>
        </div>
    <?php elseif($_GET['alerte'] == 'wrongExtension'): ?>
        <div class="Alerte" style="background-color: rgb(255,175,175);">
            <p>L'extension de l'image n'est pas autorisée !</p>
        </div>
    <?php elseif($_GET['alerte'] == 'tooBig'): ?>
        <div class="Alerte" style="background-color: rgb(255,175,175);">
            <p>L'image ne doit pas depasser 200ko !</p>
        </div>
    <?php elseif($_GET['alerte'] == 'wrongSize'): ?>
        <div class="Alerte" style="background-color: rgb(255,175,175);">
            <p>L'image doit faire 500x500px !</p>
        </div>
    <?php elseif($_GET['alerte'] == 'errorTable'): ?>
        <div class="Alerte" style="background-color: rgb(255,175,175);">
            <p>Erreur inconnue : <?php if(isset($_GET['errornum'])) echo $_GET['errornum']; ?> !</p>
        </div>
    <?php elseif($_GET['alerte'] == 'uploadError'): ?>
        <div class="Alerte" style="background-color: rgb(255,175,175);">
            <p>Erreur lors du transfert de l'image !</p>
        </div>
    <?php elseif($_GET['alerte'] == 'uploadSuccess'): ?>
        <div class="Alerte" style="background-color: rgb(175,255,175);">
            <p>Appareil ajouté avec succès !</p>
        </div>
    <?php elseif($_GET['alerte'] == 'spamReset'): ?>
        <div class="Alerte" style="background-color: rgb(255,175,175);">
            <p>Vous avez déjà demandé un nouveau mot de passe il y a moins de 24h !</p>
        </div>
    <?php elseif($_GET['alerte'] == 'reservSuccess'): ?>
        <div class="Alerte" style="background-color: rgb(175,255,175);">
            <p>Réservation ajoutée !</p>
        </div>
    <?php elseif($_GET['alerte'] == 'reservError'): ?>
        <div class="Alerte" style="background-color: rgb(255,175,175);">
            <p>Erreur lors de l'ajout de la réservation : La période selectionnée se superpose avec une autre réservation !</p>
        </div>
    <?php endif; ?>
<?php endif; ?>