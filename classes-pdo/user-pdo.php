<?php
$dsn = 'mysql:host=localhost;dbname=classes;charset=utf8';
$user = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Echec de la connexion : ' . $e->getMessage();
    exit;
}
class Userpdo {
    private $id;
    public $login;
    public $password;   
    public $email;
    public $firstname;
    public $lastname;
    public function __construct()
    {
        $this->id = null;
        $this->login = "";
        $this->password = "";
        $this->email = "";
        $this->firstname = "";
        $this->lastname = "";
    }

    public function register($login, $password, $email, $firstname, $lastname) 
    {
        global $pdo;

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$login, $passwordHash, $email, $firstname, $lastname])) {
            echo "Utilisateur inséré avec succès.";
        } else {
            echo "Erreur";
        }
    
    }




    // CONNECT MARCHE PAS EN PDO    // CONNECT MARCHE PAS EN PDO    // CONNECT MARCHE PAS EN PDO    // CONNECT MARCHE PAS EN PDO    // CONNECT MARCHE PAS EN PDO    // CONNECT MARCHE PAS EN PDO    // CONNECT MARCHE PAS EN PDO    // CONNECT MARCHE PAS EN PDO
        // CONNECT MARCHE PAS EN PDO
            // CONNECT MARCHE PAS EN PDO
                // CONNECT MARCHE PAS EN PDO
                    // CONNECT MARCHE PAS EN PDO
                        // CONNECT MARCHE PAS EN PDO
                            // CONNECT MARCHE PAS EN PDO
                                // CONNECT MARCHE PAS EN PDO
                                    // CONNECT MARCHE PAS EN PDO
                                        // CONNECT MARCHE PAS EN PDO
    public function connect($login, $password) 
    {
    global $pdo;

        $sql = "SELECT * FROM utilisateurs WHERE login = ?";
        $stmt = $pdo->prepare($sql);
        $success = $stmt->execute([$login]);
        if ($success && $stmt->rowCount() > 0){
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $hash = (password_hash($password, PASSWORD_DEFAULT));
            if (password_verify($password, $hash)) {
                $this->id = $data['id'];
                $this->login = $data['login'];
                $this->password = $data['password'];
                $this->email = $data['email'];
                $this->firstname = $data['firstname'];
                $this->lastname = $data['lastname'];
                return true;
            } 
            else 
            {
                echo "Mot de passe incorrect.<br>";
            }
        }
        
        return false;
    }
    
        // CONNECT MARCHE PAS EN PDO
            // CONNECT MARCHE PAS EN PDO    // CONNECT MARCHE PAS EN PDO    // CONNECT MARCHE PAS EN PDO    // CONNECT MARCHE PAS EN PDO
                // CONNECT MARCHE PAS EN PDO    // CONNECT MARCHE PAS EN PDO    // CONNECT MARCHE PAS EN PDO    // CONNECT MARCHE PAS EN PDO

    public function disconnect() 
    {
        $this->id = null;
        $this->login = "";
        $this->password = "";
        $this->email = "";
        $this->lastname = "";
        $this->firstname = "";
    }

    public function delete() 
    {
        global $pdo;
        $sql = "DELETE FROM utilisateurs WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->id]);
    }

    public function update($login, $password, $email, $firstname, $lastname)
    {

    }

    public function isConnected()
    {
        if ($this->id > 0) 
        {
            echo "connecté";
            return true;
        } 
        else
        {
            echo "pas connecté";
            return false;
        }
    }

    public function getAllInfos()
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $stmt->execute([$this->login]);
        if($stmt->rowCount()>0){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        else{
            return null;
        }
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getEmail()
    {
        return $this->email;   
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }
    
}


$user = new Userpdo();


include 'pages.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    { 
    // register
        if (isset($_POST['loginregister']) && isset($_POST['passwordregister']) && isset($_POST['email']) && isset($_POST['firstname']) && isset($_POST['lastname'])) 
        {
            $user->register(
                $_POST['loginregister'],
                $_POST['passwordregister'],
                $_POST['email'],
                $_POST['firstname'],
                $_POST['lastname']);

            header('Location: /classes-php/classes-pdo/login.html');
            exit();
        } 
    // fin register




    // login button
        
        if (isset($_POST['loginlogin']) && isset($_POST['passwordlogin'])) 
        {            
            if ($user->connect($_POST['loginlogin'], $_POST['passwordlogin']) === true)
            {
                echo $content;
            } 
            else
            {
                echo "erreur connexion : mauvais mdp ou login";
            }
        } 

    }   

       


// $user->register('test', 'testpdo', 'testpdo@gmail.com', 'aa', 'aa');
// $user->connect('test', 'tespdo');
// $user->isConnected();
// $user->getAllInfos();
?>
