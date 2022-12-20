<?php session_start(); 
include("../inc/constantes.inc.php");?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Gestion de Matériel | Profil utilisateur</title>  
    <link rel="stylesheet" href="style/styleBDD.css" />
    <link href="img/logo.png" rel="shortcut icon" type="image/png">
</head>
<body>
	<?php

		if(!isset($_SESSION['MAIL'])) {
	        header("Location: LoginPage.php?alerte=notConnected");
	        return;
	    }

		include("../inc/bddconnect.inc.php");


		$Prenom = $_POST["Prenom"];
		$Nom = $_POST["Nom"];
		$Mail = $_POST["Mail"];
		$AncienMotDePasse = $_POST["AncienMotDePasse"];
		$NouveauMotDePasse = $_POST["NouveauMotDePasse"];
		$IdPers = $_SESSION['USERID'];

		$sql = 'SELECT * FROM wl_users WHERE UserID = :IdPers';
		$resStat = $mysqlClient->prepare($sql);
		$resStat->execute(['IdPers' => $IdPers]);
		$res = $resStat->fetchAll();

		if(password_verify($AncienMotDePasse, $res[0]['Pswd']) || password_verify($AncienMotDePasse, $res[0]['resetPswd'])){
			if($Mail != $res[0]['Mail']){
				$sql = 'SELECT * FROM WL_Users WHERE Mail = :Mail';
				$resStat = $mysqlClient->prepare($sql);
				$resStat->execute(['Mail' => $Mail]);
				$res = $resStat->fetchAll();
				if(count($res) != 0){
					header("Location: ProfilPage.php?alerte=mailAlreadyUsed");
					return;
				}
			}
			if ($NouveauMotDePasse == "" || $NouveauMotDePasse == null){
				$NouveauMotDePasse = $AncienMotDePasse;
			}
	        $sql = 'UPDATE wl_users SET FirstName = :FirstName, LastName = :LastName, Mail = :Mail, Pswd = :MotDePasse WHERE UserID = :IdPers';
			$resStat = $mysqlClient->prepare($sql);
			$resStat->execute(['FirstName' => $Prenom,
							   'LastName' => $Nom,
							   'Mail' => $Mail,
							   'MotDePasse' => password_hash($NouveauMotDePasse, PASSWORD_DEFAULT),
							   'IdPers' => $IdPers]);
			session_destroy();
	        header("Location: LoginPage.php?alerte=updateSuccess");
		}
	    else{
	        $_SESSION['ORGAEDT_LOGGED_MAIL_FAIL'] = $Mail;
	        header("Location: ProfilPage.php?alerte=wrongMdp");
	    }
	?>
</body>     
</html>