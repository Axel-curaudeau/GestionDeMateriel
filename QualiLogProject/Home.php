<?php session_start(); 
include("../inc/constantes.inc.php");?>

<!DOCTYPE html>   
<html>   
<head>  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>OrgaEDT | Home</title>  
    <link rel="stylesheet" href="style/styleOrgaEDT.css" />
    <link href="img/edit_calendar.png" rel="shortcut icon" type="image/png">
</head>    
<body style="background-color: rgb(240,240,240);" id='body'>
    <?php
    if(!isset($_SESSION['ORGAEDT_LOGGED_MAIL']))
    {
        header("Location: ".DOMAIN_URL."/OrgaEDT/LoginPage.php?alerte=notConnected");
        return;
    }
    ?>

    <?php include_once("Navigation.php");?>

    <div class="content">
        <div class="title">
            OrgaEDT
        </div>
        <p>
            Organiser ses révisions facilement.
        </p>
    </div>

    <!--
    <div class="SideNav" style="display:none" id="mySidebar">
        <button class="NavButton" onclick="w3_close()"> Close &times; </button>
        <a href="#" class="NavButton">Link 1</a>
    </div>

    <div id="main">

        <div class="head">
            <button id="openNav" class="NavButton" onclick="w3_open()">&#9776;</button>
            <div class="w3-container">
                <h1>My Page</h1>
            </div>
        </div>
    </div>

    <script>
        function w3_open() 
        {
            document.getElementById("main").style.marginLeft = "25%";
            document.getElementById("mySidebar").style.width = "25%";
            document.getElementById("mySidebar").style.display = "block";
            document.getElementById("openNav").style.display = 'none';
        }

        function w3_close() 
        {
            document.getElementById("main").style.marginLeft = "0%";
            document.getElementById("mySidebar").style.display = "none";
            document.getElementById("openNav").style.display = "inline-block";
        }
    </script>
    -->
</body>
</html>