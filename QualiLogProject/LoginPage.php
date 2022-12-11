<?php session_start(); ?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Gestion de Matériel | Connexion</title>  
    <link rel="stylesheet" href="style/styleW.css">
    <link href="img/edit_calendar.png" rel="shortcut icon" type="image/png">
</head>    
<body style="height:100vh;display:flex;justify-content:center;align-items:center;">

    <?php include('Alertes.php') ?>

    <form action="Login.php" method="POST">
        <div class="container", align="left">  
            <h1 style="white-space: nowrap; margin-top: 0;text-align: center;">Connexion<br>Gestion de Matériel</h1>
            <label for="Mail">Adresse Mail :</label>   
            <input type="email" placeholder="adresse@mail.fr" name="Mail" id="Mail"
            <?php
                if(isset($_SESSION['LOGGED_MAIL_FAIL'])) {
                    echo('value="'.$_SESSION['LOGGED_MAIL_FAIL'].'"');
                    unset($_SESSION['LOGGED_MAIL_FAIL']);
                }
            ?>
            required>
            <label for="Password">Mot De Passe : </label>   
            <input type="password" placeholder="Mot de passe" name="Password" required>
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