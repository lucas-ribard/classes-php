<script>
    //fonction en javascript qui affiche le mot de passe si demandé (https://www.w3schools.com/howto/howto_js_toggle_password.asp)
    function affichPass() {
        var x = document.getElementById("password"); //! important pointe les mots de passe par id (si le mot de passe n'a pas d'id ca ne marchera pas)
        //change l'input de 'texte' a  'password' et inversement
        if (x.type === "password") {
        x.type = "text";
        } else {
        x.type = "password";
        }
    } 
</script>
            
<?php 
    session_start();//démare la session
    session_destroy(); //détruit pour etre sur qu'aucune var session rien de reste
    
    
    require_once('User.php') ;
    //on vide les variables session pour etre sur qu'il n'y ait pas de probleme
    

    $login = $_POST['login']; 
    $password =$_POST['password'];      

    $USER = new User();
    $message=$USER->connect($login,$password);
?>

<!DOCTYPE html>
<html lang="fr">
<meta charset="utf-8">

<head>
    <title>Connexion</title>
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
            <h1>Se Connecter</h1><br>
            <hr>
            <div id="box">
                <!-- formulaire -->
                <form action="" method="post">
                    <label for="login">Login :</label><br>
                    <input type="text" name="login" id="login" size="30" required>  <br>
                    <br>
                    <label for="password2">Mot de passe :</label><br>
                    <input type="password" name="password" id="password" size="30" required>  <br>
                    <br>
                    <input type="checkbox" onclick="affichPass()">Afficher le mot de passe <br>
                    <br>
                    <input type="submit" value="envoyer"><br>
                </form>

                <?php 
                    if (isset($message)){
                        echo $message;  //affiche un message d'erreur si probleme
                    }   
                ?>

            </div>
        </div>

    </section>    
</body>




</html>



