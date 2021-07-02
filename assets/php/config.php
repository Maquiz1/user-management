<?php
    class Database {

        const USERNAME = 'manquiz92@gmail.com';
        const PASSWORD = 'Jembe1992';


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

        //Display time in ago
        public function timeInAgo($timestamp){
            date_default_timezone_set("Africa/Dar_es_Salaam");

            $timestamp = strtotime($timestamp) ? strtotime($timestamp) : $timestamp;

            $time = time() - $timestamp;

            switch($time){
                //Seconds
                case $time <= 60:
                    return 'Just Now';

                //Minutes
                case $time >= 60 && $time < 3600:
                    return (round($time/60) == 1) ? ' a minute ago' : round($time/60). ' minutes ago';

                //Hours
                case $time >= 3600 && $time < 86400:
                    return (round($time/3600) == 1) ? ' an hour ago' : round($time/3600). ' hours ago';  
                    
                //Days
                case $time >= 86400 && $time < 604800:
                    return (round($time/86400) == 1) ? ' a day ago' : round($time/60). ' days ago';

                //Weeks
                case $time >= 604800 && $time < 2600640:
                    return (round($time/604800) == 1) ? ' a week ago' : round($time/604800). ' weeks ago';

                //Months
                case $time >= 2600640 && $time < 31207688:
                    return (round($time/2600640) == 1) ? ' a month ago' : round($time/2600640). ' months ago';

                //Years
                case $time >= 31207688:
                    return (round($time/31207688) == 1) ? ' a year ago' : round($time/31207688). ' years ago';
            }

        }
    }


?>
