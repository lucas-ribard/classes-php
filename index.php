<!-- module de connexion en classes avec PDO -->
<?php
   //on ouvre et récupere les variables sessions
   session_start();
   $loginSession=$_SESSION['login'];
   $passwordSession=$_SESSION['password'];

?>
<!DOCTYPE html>
<html lang="fr">
<meta charset="utf-8">

<head>
    <title>Reservation</title>
    <link href="CSS/index.css" rel="stylesheet" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
 
</head>

<body>

    <!-- Menu de naviguation -->
    <?php include 'Nav/Nav.php' ?>

    <!-- contenu principal -->
    <br><br>
    <section id="main">
        <div id="Text">
            <h1> Module de Connexion en Classes avec PDO</h1>
            <p>
            https://github.com/lucas-ribard/classes-php
            </p>
        </div>
    </section>
    <br><br>
    
</body>
<?php include 'Footer/Footer.php' ?>






</html>