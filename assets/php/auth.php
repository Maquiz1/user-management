<?php
require_once 'config.php';

class Auth extends Database {
    //register new user
    public function register($firstname,$lastname,$username,$password,$email){
        $sql = "INSERT INTO users (firstname,lastname,username,password,email) 
        VALUES (:firstname,:lastname,:username,:password,:email)";
        $stmt = $this->conn->prepare($sql);
        if($stmt){
            $stmt->execute(
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

    }
    
    public function user_exists($email){
        $sql = "SELECT email FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

}

?>