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
        $query = $this->conn->query("SELECT * FROM users WHERE email = '$email'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    //Login exist user
    public function login($email){
        $query = $this->conn->query("SELECT email, password FROM users WHERE email = '$email' AND deleted != 0");
        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    //current user session
    public function currentUsser($email){
        $query = $this->conn->query("SELECT * FROM users WHERE email = '$email' AND deleted != 0");
        $row = $query->fetch(PDO::FETCH_ASSOC);
        
        return $row;

    }

        //FORGOT PASSWORD
        public function forgot_password($token,$email){
            $sql = "UPDATE users SET token = :token, token_expire = DATE_ADD(NOW(),INTERVAL 10 MINUTES) WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['token' => $token, 'email' => $email]);
            
            return true;
    
        }
    
}

?>