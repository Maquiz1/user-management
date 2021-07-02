<?php
    class Database
    {
        private $dsn = "mysql:host=localhost;dbname=user-management";
        private $dbuser = "root";
        private $dbpass = "Data@2020";
        private $conn;

        public function __construct()
        {
            try {
                $this->conn = new PDO($this->dsn, $this->dbuser, $this->dbpass);
            } catch (PDOException $e) {
                echo 'Error : ' . $e->getMessage();
            }

            return $this->conn;
        }

        //register new user
        public function register($firstname, $lastname, $username, $password, $email)
        {
            $sql = "INSERT INTO users (firstname,lastname,username,password,email) 
            VALUES (:firstname,:lastname,:username,:password,:email)";
            try {
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
                } else {
                    echo 'not connected';
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        //UPDATE USER PROFILE
        public function update_profile($username, $firstname, $lastname, $gender, $dob, $phone, $newImage, $id)
        {
            $sql = "UPDATE users SET username = :username, firstname = :firstname, lastname = :lastname, gender = :gender, 
                dob = :dob, phone = :phone, photo = :newImage WHERE id = :id AND deleted !=0";
            $stmt = $this->conn->prepare($sql);
        
            $result = $stmt->execute(
                [
            'username' => $username,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'gender'   => $gender ,
            'dob'      => $dob,
            'phone'    => $phone,
            'newImage' => $newImage,
            'id'       => $id
            ]
            );

            return $result;
        }

        public function send_emails(){
            $sender = 'manquiz92@mail.com';
            $recipient = 'mjwinstone@yahoo.com';

            $subject = "php mail test";
            $message = "php test message";
            $headers = 'From:' . $sender;

            if (mail($recipient, $subject, $message, $headers))
            {
                echo "Message accepted";
            }
            else
            {
                echo "Error: Message not accepted";
            }

            }
        }

    $user = new Database();
    $user->send_emails();
    // $user->register('Winstone','Makwesheni', 'Maquiz', '123456', 'manquiz92@gmail.com');
    var_dump($user->update_profile('Jembe6','Winstone','Maquiz','Male','2021-06-27','0876555345','3','76'));

 ?>