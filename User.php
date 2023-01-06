<!-- module de connexion en classes avec PDO -->
<?php
session_start();

class User 
{
    private $id;
    public $login;
    public $Email;
    public $FirstName;
    public $Lastname;
    public $password;

    protected $bdd;

    public function __construct(){
        $db_username = 'root';
        $db_password = '';
        
       
        try{
            $this->bdd = new PDO('mysql:host=localhost;dbname=classes;charset=utf8', $db_username, $db_password);
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "connecté à la base de donnés <br><br>";
        }
        catch(PDOException $e){
            echo "<error>Error : " . $e->getMessage(),"</error>";
        }
   
    }
    // Récupere les infos du formulaire , vérifie que l'identifiant n'est pas déja utilisé et crée l'utilisateur dans la base de donné
    public function register($login,$Email,$FirstName,$Lastname,$password){
        //echo "fonction egister<br>";
        $this->$login=$login;
        $this->$Email=$Email;
        $this->$FirstName=$FirstName;
        $this->$Lastname=$Lastname;
        $this->$password=$password;
        //$this->login="TEST";
        $sql = "SELECT * FROM `utilisateurs` WHERE login=:login";
        
        // Check si un utilisateur n'a pas le meme login
        $req = $this->bdd->prepare($sql);
        $req->execute(array(':login' => $login));
        $row = $req->rowCount();

        // si l'user est dispo
        if($row <= 0) {
            //echo "login dispo<br>";

            $sql="INSERT INTO `utilisateurs` (`login`, `password`, `email`, `firstname`, `lastname`) VALUES (:login, :password, :Email, :FirstName, :LastName)";
            $req = $this->bdd->prepare($sql);
            $req->execute(array('login' => $this->$login,'password' => $this->$password,'Email' => $this->$Email,'FirstName' => $this->$FirstName,'LastName' => $this->$Lastname));
            //echo "<error>Requete envoyé</error><br>";
            header('Location:/classes-php/connexion.php');
        } 
        // si l'user n'est pas dispo     
        else{
            //echo "login existe déja<br>";
            $message="Ce Login est déja utilisé";
        }
        return $message;
   
    }



    public function connect($login,$password){
        //echo 'fonction connect<br>';
        if(!empty($login) AND !empty($password) ){   
            $sql = "SELECT * FROM `utilisateurs` WHERE login=:login AND password=:password";
    
            // Check si un utilisateur n'a pas le meme login
            $req = $this->bdd->prepare($sql);
            $req->execute(array(':login' => $login,':password' => $password));

            $row = $req->rowCount();
            // si l'user est dispo
            if($row >= 1) {
                $res = $req->fetch(PDO::FETCH_ASSOC);
                $_SESSION['id'] = $res['id'];
                $_SESSION['login'] = $login; 
                $_SESSION['password'] = $password; 
                $_SESSION['email'] = $res['email'];
                $_SESSION['firstname'] = $res['firstname'];
                $_SESSION['lastname'] = $res['lastname'];
             
                header('Location:http://localhost/classes-php/profil.php'); 
            }
            else{
                $message="<error>utilisateur ou mot de passe incorrect</error>";
                return $message;
            }
            
        }

    }

    public function disconnect(){
        session_destroy();
    }

    public function delete($login,$password){
        $sql = "SELECT `id` FROM `utilisateurs` WHERE login=:login AND password=:password";
    
            // Check si un utilisateur n'a pas le meme login
            $req = $this->bdd->prepare($sql);
            $req->execute(array(':login' => $login,':password' => $password));

            $row = $req->rowCount();
            // si l'user est dispo
            if($row >= 1) {
                $res = $req->fetch(PDO::FETCH_ASSOC);
                $id=$res['id'];
                $sql = "DELETE FROM `utilisateurs` WHERE `id`= :id";
                $req = $this->bdd->prepare($sql);
                $req->execute(array(':id' => $id));
                session_destroy();
                header('Location:http://localhost/classes-php/connexion.php'); 

            }

    }

    public function update(){

    }

    public function isConnected(){
        if($_SESSION){
            return true;
        }else{
            return false;
        }
    }
}
?>
