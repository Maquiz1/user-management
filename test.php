<?php
    class Database {
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

        //register new user
        public function register($firstname, $lastname, $username, $password, $email){
            $sql = "INSERT INTO users (firstname,lastname,username,password,email) 
            VALUES (:firstname,:lastname,:username,:password,:email)";
            try{
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
                if ($result) {
                    return true;
                }else{
                    echo 'not connected';
                }

            }catch(PDOException $e){
                echo $e->getMessage();
            }

        }
    }

    $user = new Database();
    $user->register('Winstone','Makwesheni', 'Maquiz', '123456', 'manquiz92@gmail.com');

 ?>