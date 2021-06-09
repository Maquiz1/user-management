<?php
    class User {
        private $dsn = "mysql:host=localhost;dbname=user-management";
        private $dbuser = "root";
        private $dbpass = "Data@2020";
        private $conn;

        public function __construct(){
            try{
                $this->conn = new PDO($this->dsn,$this->dbuser,$this->dbpass);

            }catch (PDOException $e){
                echo 'Error : ' . $e->getMessage();
            }

            return $this->conn;
        }

        //CHECK INPUT
        public function test_input(){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //ERROR/SUCCESS MESSAGE ALERT
        public function showMessage($type, $message){
            return '<div class="alert alert-'.$type.'alert-dismissible">
                <button tpe="button" class="close" data-dismiss="alert">&times;</button>   
                <strong class="text-center">'.&message.'</strong>        
            </div>';
        }
    }
?>