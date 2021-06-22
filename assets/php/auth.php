<?php

require_once 'config.php';

class Auth extends Database {

    private $dsn = "mysql:host=localhost;dbname=user-management";
    private $dbuser = "root";
    private $dbpass = "Data@2020";
    private $conn;

    public function __construct(){

        try {
            $this->conn = new PDO($this->dsn, $this->dbuser, $this->dbpass);
        } catch (PDOException $e) {
            echo 'Error : ' . $e->getMessage();
        }

        return $this->conn;
    }

    public function register($firstname, $lastname, $username, $password, $email){

        $sql = "INSERT INTO users (firstname,lastname,username,password,email) 
        VALUES (:firstname,:lastname,:username,:password,:email)";

        $stmt = $this->conn->prepare($sql);
        
            $result = $stmt->execute(
            [
            'firstname'  => $firstname,
            'lastname'   => $lastname,
            'username'   => $username,
            'password'   => $password,
            'email'      => $email
            ]
            );

        return true;
}
            

    public function user_exists($email){

        $sql = 'SELECT email FROM users WHERE email = :email';
        // $sql = "SELECT `email` FROM `users` WHERE `email` = `:email`";
        $stmt = $this->conn->prepare($sql);        
        $result = $stmt->execute(['email' => $email]);

        return false;     

    }

}

?>