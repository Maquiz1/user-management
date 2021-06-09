<?php
require_once 'config.php';

class Auth extends Database {
    //register new user
    public function register($name.$email,$username){
        $sql = "INSERT INTO users (name,email,password)
        VALUES (:name, :email, :username)";

        $stmt = $this
    } 

?>