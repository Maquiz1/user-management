<?php
    require_once 'session.php';

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);


    //Handle Add new NOTE Ajax Request
    if(isset($_POST['action']) && $_POST['action'] == 'add_note'){
        $title  = $cuser->test_input($_POST['title']);
        $note   = $cuser->test_input($_POST['note']);

        $cuser->add_new_note($cid,$title,$note);
        $cuser->notification($cid,'admin','Note added');    //INSERT NOTE TO ADMIN
    }


    //Handle ajax display all notes of an user
    if(isset($_POST['action']) && $_POST['action'] == 'display_notes'){

        $output = '';

        $notes = $cuser->get_notes($cid);

        if($notes){
            $output .= ' <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Note</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>'; 

            foreach($notes as $row){
                $output .= '<tr>
                <td>' .$row['id']. '</td>
                <td>' .$row['title']. '</td>
                <td>' .substr($row['note'],0,75). '...</td>
                <td>
                    <a href="#" id="'.$row['id'].'" title="View Detal" class="text-success infoBtn">
                        <i class="fas fa-info-circle fa-lg"></i>
                    </a>&nbsp;
                    <a href="#" id="'.$row['id'].'" title="Edit Note" class="text-primary editBtn">
                        <i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editNoteModal"></i>
                    </a>&nbsp;
                    <a href="#" id="'.$row['id'].'" title="Delete Note" class="text-danger deleteBtn">
                        <i class="fas fa-trash-alt fa-lg"></i>
                    </a>
                </td>
                </tr>';
            }

            $output .= '</tbody></table>';

            echo $output;
        }else {
            echo '<h3 class="text-center text-secondary">:(You have not written any note yet! Write your first note now!)</h3>';
        }
    }



    //HANDLE EDIT NOTE OF A USER AJAX REQUEST
    if(isset($_POST['edit_id'])){
        $id = $_POST['edit_id'];

        $row = $cuser->edit_note($id);

        echo json_encode($row);
    }


    //HANDLE UPDATE NOTE OF A USER AJAX REQUEST
    if(isset($_POST['action']) && $_POST['action'] == 'update_note'){
        $title  = $cuser->test_input($_POST['title']);
        $note   = $cuser->test_input($_POST['note']);
        $id     = $cuser->test_input($_POST['id']);

        $cuser->update_note($id,$title,$note);
        $cuser->notification($cid,'admin','Note Updated');    //UPDATE NOTE TO ADMIN
    }


    //HANDLE DELETE NOTE OF A USER AJAX REQUEST
    if(isset($_POST['del_id'])){
        $id     =  $_POST['del_id'];

       $cuser->delete_note($id);
       $cuser->notification($cid,'admin','Note Deleted');    //delete NOTE TO ADMIN

    }


    //HANDLE  NOTE in detail OF A USER AJAX REQUEST
    if(isset($_POST['info_id'])){
        $id = $_POST['info_id'];

        $row = $cuser->edit_note($id);

        echo json_encode($row);
    }



    //HANDLE  UPDATE PROFILE AJAX REQUEST
        if (isset($_FILES['image'])) {
            $username    = $cuser->test_input($_POST['username']);
            $firstname   = $cuser->test_input($_POST['firstname']);
            $lastname    = $cuser->test_input($_POST['lastname']);
            $dob         = $cuser->test_input($_POST['dob']);
            $phone       = $cuser->test_input($_POST['phone']);
            $gender      = $cuser->test_input($_POST['gender']);


            $oldImage  = $_POST['oldimage'];
            $folder = 'uploads/';

            if (isset($_FILES['image']['name']) && ($_FILES['image']['name'] != "")) {
                $imagePath = $_FILES['image']['name'];
                $newImage = $folder.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], $newImage);

                if ($oldImage != null) {
                    unlink($oldImage);
                }
            } else {
                $newImage = $oldImage;
            }

           $cuser->update_profile($username, $firstname, $lastname, $gender, $dob, $phone, $newImage, $cid);
           $cuser->notification($cid,'admin','Profile Updated');    //UPDATE PROFILE NOTE TO ADMIN
        }


        //HANDLE  CHANGE PASSWORD AJAX REQUEST
        if (isset($_POST['action']) && $_POST['action'] == 'change_pass') {
            $currentPass = $_POST['curpass'];
            $newPass = $_POST['newpass'];
            $cnewPass = $_POST['cnewpass'];
            
            $hnewPass = password_hash($newPass, PASSWORD_DEFAULT);

            if($newPass != $cnewPass){
                echo $cuser->showMessage('danger','Password did not match');
            }else{
                if(password_verify($currentPass, $cpass)){
                    $cuser->change_password($hnewPass, $cid);
                    echo  $cuser->showMessage('success','Password Successfully Changed');
                    $cuser->notification($cid,'admin','Password Changed');    //change password NOTE TO ADMIN
                }
                else{
                    echo $cuser->showMessage('danger','Current Passowrd not Correct');
                }
            }
        }


    //HANDLE  VERIFY EMAIL AJAX REQUEST
    if (isset($_POST['action']) && $_POST['action'] == 'verify_email') {
        try{
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTAuth = true;            
            $mail->Username = Database::USERNAME;
            $mail->Password = Database::PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom(Database::USERNAME,'Winstone');
            $mail->addAddress($cemail);     //use current email
            
            
            //Content
            $mail->isHTML(true);
            $mail->Subject = 'E-mail Verification';
            $mail->Body = '<h3>Click the link link to verify your E-mail.<br><a href="http://loalhost/user-management/verify_email.php?email='.$cemail.'">http://loalhost/user-management/verify_email.php?email='.$cemail.'</a><br>Regards<br>Admin!</h3>';
            $mail->send();
            echo $cuser->showMessage('success','Verification link sent,Please check your e-mail!');
            
        }catch(Exception $e){
            // echo $cuser->showMessage('danger','Something went wrong please try again later!');
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

        }
    }


    //HANDLE  SEND FEEDBACK AJAX REQUEST
    if (isset($_POST['action']) && $_POST['action'] == 'feedback') {
        $subject = $cuser->test_input($_POST['subject']);
        $feedback = $cuser->test_input($_POST['feedback']);

        $cuser->send_feedback($subject,$feedback,$cid);
        $cuser->notification($cid,'admin','Feedback written');    //SEND FEEDBACK NOTE TO ADMIN
    }


    //HANDLE  FETCH NOTIFICATION AJAX REQUEST
    if (isset($_POST['action']) && $_POST['action'] == 'fetchNotification') {
        $notification = $cuser->fetchNotification($cid);
        $output = '';

        if($notification){
            foreach($notification as $row){
                $output .='<div class="alert alert-danger" role="alert">
                <button class="close" type="button" id="'.$row['id'].'" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;                    
                    </span>
                </button>
                <h4 class="alert-heading">New Notification</h4>
                <p class="mb-0 lead">
                    '.$row['message'].'
                </p>
                <hr class="my-2">
                <p class="mb-0 float-left">Reply of feedback form Admin</p>
                <p class="mb-0 float-right">'.$cuser->timeInAgo($row['created_at']).'</p>
                <div class="clearfix"></div>
            </div>';
            }
            echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary mt-5">No any new notification</h3>';
        }
    }

     //HANDLE  CHECK NOTIFICATION AJAX REQUEST
     if (isset($_POST['action']) && $_POST['action'] == 'checkNotification') {
        if($cuser->fetchNotification($cid)){
            echo '<i class="fas fa-circle fa-sm text-danger"></i>';
        }else{
            echo '';
        }
        
    }

    //HANDLE  DELETE NOTIFICATION AJAX REQUEST
    if (isset($_POST['notification_id'])) {
        $id = $_POST['notification_id'];
        $cuser->removeNotification($id);
        }
?>