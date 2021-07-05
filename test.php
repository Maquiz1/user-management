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

            public function admin_login($username,$password){
                $hpassword = sha1($password);
                $sql = "SELECT username, password FROM admin WHERE username = :username AND password = :password";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(
                    [
                        'username'=>$username,
                        'password'=>$hpassword
                    ]
                );
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if($row){
                    return $row;
                }
            }

        //FETCH ALL NOTES
    //FETCH DETAIL OF A  USER
    public function fetchAllNotes(){
        $sql = "SELECT notes.id,notes.title,notes.note,notes.created_at,notes.updated_at,
        users.firstname,users.lastname,users.username,users.email FROM notes INNER JOIN 
        users ON notes.uid = users.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    
    }

        //FETCH ALL admin NOTIFICATION
        public function fetchNotification(){
            $sql = "SELECT notification.id,notification.message,notification.created_at,
                    users.firstname,users.lastname,users.username,users.email FROM notification INNER JOIN 
                    users ON notification.id = users.id WHERE type='admin' ORDER BY notification.id DESC LIMIT 5";
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $result;
        
        }

        public function removeNotification($id){
            $sql = "DELETE FROM notification WHERE id = :id AND type = 'admin'";
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute(['id'=>$id]);
        
            if($result){
                return true;
            }else{
                return false;
            }
        
        }

        public function exportAllUsers(){
            $sql = "SELECT * FROM users";
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
    
        }
}

    $user = new Database();
    // $user->send_emails();
    // $user->register('Winstone','Makwesheni', 'Maquiz', '123456', 'manquiz92@gmail.com');
    // var_dump($user->update_profile('Jembe6','Winstone','Maquiz','Male','2021-06-27','0876555345','3','76'));
    // var_dump($loggedInAdmin = $user->admin_login('admin','admin'));
    // var_dump($user->fetchAllNotes());
    // var_dump($user->fetchNotification());
    //   var_dump($user->removeNotification(14));
       var_dump($user->exportAllUsers());

 ?>