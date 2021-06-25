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


        //RESET PASSWORD USER
        public function reset_pass_auth($email, $token){
            $sql = "SELECT id FROM users WHERE email = :email AND token = :token AND token_expire > now() and deleted != 0";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email, 'token'=>$token]);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

        //Update new PASSWORD
        public function update_new_pass($pass, $email){
            $sql = "UPDATE users SET token = ''. password = :pass WHERE email = :email AND  deleted != 0";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['pass' => $pass, 'email'=>$email]);
            
            return true;
        }
    

        //ADD NEW note
        public function add_new_note($uid,$title,$note){
            $sql = "INSERT INTO notes (uid, title, note) VALUES (:uid,:title,:note)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    'uid'   => $uid, 
                    'title' => $title, 
                    'note'  => $note
                ]
            );
            return true;
        }


        //fetch all notes of a user
        public function get_notes($uid){
            $sql = "SELECT * FROM notes WHERE uid = :uid";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    'uid'=>$uid
                ]
            );

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;


        }


        //EDIT NOTE OF A USER
        public function edit_note($id){
            $sql = "SELECT * FROM notes WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    'id' => $id
                ]
            );

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //UPDATE NOTE OF A USER
        public function update_note($id,$title,$note){
            $sql = "UPDATE notes SET title = :title, note = :note ,updated_at = NOW() WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    'id' => $id,
                    'title' => $title,
                    'note' => $note
                ]
            );

            return $stmt;
        }

    //DELETE NOTE OF A USER
    public function delete_note($id){
        $sql = "DELETE FROM notes WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(
            [
                'id' => $id
            ]
        );

        return true;
    }
}

?>