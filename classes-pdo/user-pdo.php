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
        $this->login = "mathis.fournier";
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
    public function connect($login, $password) 
    {
        global $pdo;

        $sql = "SELECT * FROM utilisateurs WHERE login = ? AND password = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam("ss", $login, $password);
        $stmt->execute();
        $result = $stmt->fetch();
        if($result->num_rows > 0)
        {
            $data = $result->fetch_assoc();
                $this->id = $data['id'];
                $this->login = $data['login'];
                $this->password = $data['password'];
                $this->email = $data['email'];
                $this->firstname = $data['firstname'];
                $this->lastname = $data['lastname'];
                echo "connecté";
                return true;  
        } 
        return false;
    }

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
        $sql = "DELETE FROM utilisateurs WHERE login = $this->login";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }

    public function update($login, $password, $email, $firstname, $lastname)
    {

    }

    public function isConnected()
    {
        if ($this->id > 0) 
        {
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
        echo $this->id;
        echo "<br>" . $this->login;
        echo "<br>" . $this->password;
        echo "<br>" . $this->email;
        echo "<br>" . $this->firstname;
        echo "<br>" . $this->lastname;
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
        } 
    // fin register

    // login
        if (isset($_POST['loginlogin']) && isset($_POST['passwordlogin'])) 
        {
            $user->connect(
                $_POST['loginlogin'],
                $_POST['passwordlogin'],);
        } 
    }   


// $user->register('test', 'testpdo', 'testpdo@gmail.com', 'aa', 'aa');
?>
