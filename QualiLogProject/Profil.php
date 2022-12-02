<?php session_start(); 
include("../inc/constantes.inc.php");?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>OrgaEDT | Profil</title>  
    <link rel="stylesheet" href="style/styleBDD.css" />
    <link href="img/edit_calendar.png" rel="shortcut icon" type="image/png">
</head>
<body>
	<?php

		if(!isset($_SESSION['ORGAEDT_LOGGED_MAIL']))
	    {
	        header("Location: ".DOMAIN_URL."/OrgaEDT/LoginPage.php?alerte=notConnected");
	        return;
	    }

		include("../inc/bddconnect.inc.php");

		$Mail = $_POST["Mail"];
		$AncienMotDePasse = $_POST["AncienMotDePasse"];
		$NouveauMotDePasse = $_POST["NouveauMotDePasse"];
		$IdPers = $_SESSION['ORGAEDT_LOGGED_IDPERS'];

		$sql = 'SELECT * FROM OrgaEDT_Personne WHERE IdPers = :IdPers';
		$resStat = $mysqlClient->prepare($sql);
		$resStat->execute(['IdPers' => $IdPers]);
		$res = $resStat->fetchAll();

		if(password_verify($AncienMotDePasse, $res[0]['MotDePasse']) || password_verify($AncienMotDePasse, $res[0]['resetPswd'])){
			if($Mail != $res[0]['Mail']){
				$sql = 'SELECT * FROM OrgaEDT_Personne WHERE Mail = :Mail';
				$resStat = $mysqlClient->prepare($sql);
				$resStat->execute(['Mail' => $Mail]);
				$res = $resStat->fetchAll();
				if(count($res) != 0){
					header("Location: ".DOMAIN_URL."/OrgaEDT/ProfilPage.php?alerte=mailAlreadyUsed");
					return;
				}
			}
	        $sql = 'UPDATE OrgaEDT_Personne SET Mail = :Mail, MotDePasse = :MotDePasse WHERE IdPers = :IdPers';
			$resStat = $mysqlClient->prepare($sql);
			$resStat->execute(['Mail' => $Mail,
							   'MotDePasse' => password_hash($NouveauMotDePasse, PASSWORD_DEFAULT),
							   'IdPers' => $IdPers]);
			session_destroy();
	        header("Location: ".DOMAIN_URL."/OrgaEDT/LoginPage.php?alerte=updateSuccess");
		}
	    else{
	        $_SESSION['ORGAEDT_LOGGED_MAIL_FAIL'] = $Mail;
	        header("Location: ".DOMAIN_URL."/OrgaEDT/ProfilPage.php?alerte=wrongMdp");
	    }
	?>
</body>     
</html>