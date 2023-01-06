<!-- module de connexion en classes avec PDO -->
<script>
    //fonction en javascript qui affiche le mot de passe si demandé (https://www.w3schools.com/howto/howto_js_toggle_password.asp)
    function affichPass() {
        var x1 = document.getElementById("password1");  //! important pointe les mots de passe par id (si le mot de passe n'a pas d'id ca ne marchera pas)
        var x2 = document.getElementById("password2");  //ne marche pas avec deux mots de passe qui ont la meme id (qu'un seul sera affiché  (d'apres mes test je connais pas trop javascript))
        //change l'input de 'texte' a  'password' et inversement
        if (x1.type === "password") {
        x1.type = "text";
        x2.type = "text";
        } else {
        x1.type = "password";
        x2.type = "password";
        }
    } 
</script>

<?php
    session_start();
    require_once('User.php') ;

    //recup les valeurs du formulaire
    $login=$_POST["login"];
    $Email=$_POST["Email"];
    $FirstName=$_POST["FirstName"];
    $LastName=$_POST["LastName"];
    $password1=$_POST["password1"];
    $password2=$_POST["password2"];
    
    if(!empty($_POST['submit'])) {
        if($password1===$password2){
            $password=$password1; //réduit les problemes
            $USER = new User();
            $message=$USER->register($login,$Email,$FirstName,$LastName,$password);
            
        }
        else{
            $message= "Les Deux mots de passes ne sont pas identiques";
        }
        
        
    }

?>

<!DOCTYPE html>
<html lang="fr">
<meta charset="utf-8">

<head>
    <title>Insciption</title>
    <link href="CSS/connexion.css" rel="stylesheet" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
 
</head>

<body>
<!-- Menu de naviguation -->
<?php include 'Nav/Nav.php' ?>

<section id="main">
    <div id="form"> 
    <br>
        <h1>S'inscrire</h1><br>
        <hr>
        <div id="box">
           
            <form action="" method="post">
                <label for="login">Login :</label><br>
                <input type="text"  name="login" placeholder="Entrer le nom d'utilisateur" size="30" required>  <br>
                <br>
                <label for="Email">Email :</label><br>
                <input type="text"  name="Email" placeholder="Entrer votre Email" size="30" required>  <br>
                <br>
                <label for="FirstName">Prénom :</label><br>
                <input type="text"  name="FirstName" placeholder="Entrer votre Prénom" size="30" required>  <br>
                <br>
                <label for="LastName">Nom :</label><br>
                <input type="text"  name="LastName" placeholder="Entrer votre Nom" size="30" required>  <br>
                <br>
                <label for="password1">Mot de passe :</label><br>
                <input type="password" id="password1" name="password1" placeholder="Mot de passe" size="30" required> <br> 
                <br>
                <label for="password2">Répéter votre Mot de passe :</label><br>
                <input type="password" id="password2" name="password2" placeholder="Mot de passe" size="30" required>  <br>
                <br>
                <input type="checkbox" onclick="affichPass()">Afficher le mot de passe <br>
                <br>
                <?php 
                    if (!empty($message)){
                        echo "<error>",$message,"</error><br><br>";  //affiche un message d'erreur si probleme
                    }
                    
                ?>
                <input type="submit" name="submit" value="s'inscrire"><br>
                <br>
               
            </form>
            
        </div>
    </div>

</section>    
</body>
</html>