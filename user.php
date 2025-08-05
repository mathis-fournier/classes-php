<?php
    $host = "localhost";
    $username = "root";
    $password = "";

    $conn = new mysqli($servername, $username, $password);
class User {
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;
    public function __construct()
    {
        $this->id = "";
        $this->login = "";
        $this->email = "";
        $this->firstname = "";
        $this->lastname = "";
    }

    public function register($login, $password, $email, $firstname, $lastname) 
    {

    }

    public function connect($login, $password) 
    {

    }

    public function disconnect() 
    {

    }

    public function delete() 
    {

    }

    public function update($login, $password, $email, $firstname, $lastname)
    {

    }

    public function isConnected(): bool
    {

    }

    public function getAllInfos()
    {

    }

    public function getLogin()
    {

    }

    public function getEmail()
    {
        
    }

    public function getFirstname()
    {
        
    }

    public function getLastname()
    {
        
    }
}
?>