<?php
require_once 'config.php';

class Admin extends Database {

    //Admin LOGIN
    public function admin_login($username,$password){        
        $sql = "SELECT username, password FROM admin WHERE username = :username AND password = :password";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(
            [
                'username'=>$username,
                'password'=>$password
            ]
        );
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row){
            return $row;
        }
    }

    //COUNT NUMBER OF USERS
    public function totalCount($tablename){
        $sql = "SELECT * FROM $tablename";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();

        return $count;

    }

    //COUNT VERIFIFED/UNVERIFIED OF USERS
    public function verified_users($status){
        $sql = "SELECT * FROM users WHERE verified = :status";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(
            [
                'status'=>$status
            ]
        );
        $count = $stmt->rowCount();

        return $count;

    }

    //C Gneder percentae
    public function genderPer(){
        $sql = "SELECT gender, COUNT(*) AS number FROM users WHERE gender != '' GROUP BY gender";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

        }

    //VERIFIFED/UNVERIFIED  percentae
    public function verifiedPer(){
        $sql = "SELECT verified, COUNT(*) AS number FROM users GROUP BY verified";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

        }

    //COUNT NUMBER OF USERS
    public function site_hits(){
    $sql = "SELECT hits FROM visitors";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $count = $stmt->fetch(PDO::FETCH_ASSOC);

    return $count;

    }

    //FETCH ALL USERS
    public function fetchAllUsers($val){
        $sql = "SELECT * FROM users WHERE deleted != $val";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    
    }

    //FETCH DETAIL OF A  USER
    public function fetchUserDetailsByID($id){
        $sql = "SELECT * FROM users WHERE id = :id AND deleted !=0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    
    }

    //DELETE A  USER
    public function userAction($id,$val){
        $sql = "UPDATE users SET deleted = $val WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
    
        return $stmt;
    
    }

    //FETCH ALL NOTES
    public function fetchAllNotes(){
        $sql = "SELECT notes.id,notes.title,notes.note,notes.created_at,notes.updated_at,
                users.firstname,users.lastname,users.username,users.email FROM notes INNER JOIN 
                users ON notes.uid = users.id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    
    }

    //DELETE NOTE OF A USER NOTES
    public function deleteNoteOfUser($id){
        $sql = "DELETE FROM notes WHERE id =:id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(
            [
                'id'=>$id
            ]
        );
            
        return true;
    
    }

    //FETCH ALL FEEDBACK
    public function fetchAllFeedback(){
        $sql = "SELECT feedback.id,feedback.subject,feedback.feedback,feedback.created_at,feedback.uid,
                users.firstname,users.lastname,users.username,users.email FROM feedback INNER JOIN 
                users ON feedback.uid = users.id WHERE replied !=1 ORDER BY feedback.id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    
    }

    //FETCH reply feedback to a user
    public function replayFeedback($uid, $message){
        $sql = "INSERT INTO notification (uid,type,message) VALUES (:uid,'user',:message)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid'=>$uid,'message'=>$message]);
    
        return true;
    
    }

    //set feedback to 1
    public function feedbackReplied($fid){
        $sql = "UPDATE feedback SET replied = 1 WHERE id = :fid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['fid'=>$fid]);
    
        return true;
    
    }


    //FETCH ALL admin NOTIFICATION
    public function fetchNotification(){
        $sql = "SELECT notification.id,notification.message,notification.created_at,
                users.firstname,users.lastname,users.username,users.email FROM notification INNER JOIN 
                users ON notification.uid = users.id WHERE type= 'admin' ORDER BY notification.id DESC LIMIT 5";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    
    }

    //remove notification
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


    // FETCH ALL USERS FROM DB 
    public function exportAllUsers(){
        $sql = "SELECT * FROM users";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }
}
?>