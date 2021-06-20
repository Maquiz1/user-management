<?php
    class Database {
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

        //TEST INPUT
        public function test_input($data){
            $data = trim($data);       //Rmeve all white spaces
            $data = stripslashes($data);  //Remove all slashes
            $data = htmlspecialchars($data);  //Remove all spcial chras
            return $data;
        }       

        //ERROR/SUCCESS MESSAGE ALERT
        public function showMessage($type, $message){
            return '<div class="alert alert-'.$type.'alert-dismissible">
                <button tpe="button" class="close" data-dismiss="alert">&times;</button>   
                <strong class="text-center">'.$message.'</strong>        
            </div>';
        }
    }

?>
