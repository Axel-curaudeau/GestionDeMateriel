<?php session_start();
include("../inc/constantes.inc.php");
?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>QualiLog | Login</title>  
    <link rel="stylesheet" href="style/style.css" />
    <link href="img/edit_calendar.png" rel="shortcut icon" type="image/png">
</head>    
<body>
    <?php
    if(!isset($_POST["Mail"]) || !isset($_POST["Password"])) {
        header("Location: ".DOMAIN_URL."/QualiLogProject/LoginPage.php?alerte=failConnect");
        return;
    }

    include("../inc/bddconnect.inc.php");

    $Mail = $_POST["Mail"];
    $Password = $_POST["Password"];

    $sql = 'SELECT * FROM WL_Users WHERE Mail = :Mail';
    $resStat = $mysqlClient->prepare($sql);
    $resStat->execute([
        'Mail' => $Mail]);
    $res = $resStat->fetchAll();

    if (count($res) == 0) {
        header("Location: ".DOMAIN_URL."/QualiLogProject/LoginPage.php?alerte=failConnect");
        return;
    }

    if (password_verify($Password, $res[0]['Pswd']) || password_verify($Password, $res[0]['resetPswd'])){
        $_SESSION['USERID'] = $res[0]['USERID'];
        $_SESSION['MAIL'] = $Mail;
        $res = $mysqlClient->prepare($sql);
        $exec = $res->execute(['IdPers' => $_SESSION['USERID']]);
        header("Location: ".DOMAIN_URL."/QualiLogProject/Home.php");
    }
    else{
        $_SESSION['LOGGED_MAIL_FAIL'] = $Mail;
        echo($Password);
        //header("Location: ".DOMAIN_URL."/QualiLogProject/LoginPage.php?alerte=failConnect");
    }

    ?>

</body>     
</html>