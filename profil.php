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
    //on ouvre et récupere les variables sessions
    session_start();
    require_once("User.php");

    //$_SESSION['id'] ;
    $login=$_SESSION['login'];
    $password=$_SESSION['password'] ;
   // $_SESSION['email'] ;
    //$_SESSION['firstname'] ;
    //$_SESSION['lastname'] ;
    

    if(!empty($_POST['delete'])) {
        
    $USER = new User();
    $message=$USER->delete($login,$password);
    }
        
?>

<!DOCTYPE html>
<html lang="fr">
<meta charset="utf-8">

<head>
    <title>Profil</title>
    <link href="CSS/profil.css" rel="stylesheet" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
 
</head>

<body>
 
   <!-- Menu de naviguation -->
   <?php include 'Nav/Nav.php' ?>

    
    <div id="form"> 
        <div id="box">
            <h2>Bienvenue <?php echo $loginSession; ?></h2><br>
            <form action="" method="post">
            <input type="submit" name="delete" value="supprimer le compte"><br>
            </form>
            Ici vous pouvez changer vos identifiants<br><br>
            <form action="" method="post">
                <label for="login">Login :</label><br>  
                <input type="text"  name="login" value="<?php echo $_SESSION['login']; ?>" size="30" required><br>
                <br>
                <label for="Email">Email :</label><br>
                <input type="text"  name="Email" value="<?php echo $_SESSION['email']; ?>" size="30" required>  <br>
                <br>
                <label for="FirstName">Prénom :</label><br>
                <input type="text"  name="FirstName" value="<?php echo $_SESSION['firstname']; ?>" size="30" required>  <br>
                <br>
                <label for="LastName">Nom :</label><br>
                <input type="text"  name="LastName" value="<?php echo $_SESSION['lastname']; ?>" size="30" required>  <br>
                <br>
                <label for="password1">Mot de passe :</label><br>
                <input type="password"  id="password1" name="password1" placeholder="Mot de passe" size="30" required> <br> 
                <br>
                <label for="password2">Répéter votre Mot de passe :</label><br>
                <input type="password"  id="password2" name="password2" placeholder="Mot de passe" size="30" required>  <br>
                <br>
                <input type="checkbox" onclick="affichPass()">Afficher le mot de passe <br>
                <br>
                <input type="submit" name="ValidChange" value="Valider les changements"><br>
            </form>
            <?php 
                if (isset($message)){
                    echo $message;  //affiche un message d'erreur si probleme
                }   
            ?>
        </div>
    </div>



</body>


</html>
