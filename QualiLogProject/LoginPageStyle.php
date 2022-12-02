<?php session_start(); ?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Gestion de Matériel | Login</title>  
    <link rel="stylesheet" href="style/styleW.css">
    <link href="img/edit_calendar.png" rel="shortcut icon" type="image/png">
</head>    
<body style="height:100vh;display:flex;justify-content:center;align-items:center;">
    
    <?php if(isset($_GET['alerte'])): ?>
        <?php if($_GET['alerte'] == 'registered'): ?>
            <div class="Alerte" style="background-color: rgb(175,255,175);">
                <p>Utilisateur enregistré, vous pouvez vous connecter !</p>
            </div>
        <?php elseif($_GET['alerte'] == 'failConnect'): ?>
            <div class="Alerte" style="background-color: rgb(255,175,175);">
                <p>Identifiants incorrects !</p>
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
        <?php endif; ?>
    <?php endif; ?>

    <form action="Login.php" method="POST">
        <div class="container", align="left">  
            <h1 style="white-space: nowrap; margin-top: 0;text-align: center;">Connexion<br>Gestion de Matériel</h1>
            <label for="Mail">Adresse Mail :</label>   
            <input type="email" placeholder="adresse@mail.fr" name="Mail" id="Mail" <?php if(isset($_SESSION['LOGGED_MAIL_FAIL'])){echo('value="'.$_SESSION['LOGGED_MAIL_FAIL'].'"');} ?> required>  
            <label for="MotDePasse">Mot De Passe : </label>   
            <input type="password" placeholder="Mot de passe" name="MotDePasse" required>
            <a href="forgotPswd.php" style="color: var(--WLcolor2)">Mot de passe oublié</a>
            <button type="submit">Se Connecter</button>
            <div class="lineContainer">
                <a href="RegisterPage.php">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <p style="margin: 0;">Créer un compte</p>
                    </div>
                </a>
            </div>
        </div>
    </form>  
</body>     
</html>