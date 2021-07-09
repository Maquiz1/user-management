<?php
    require_once 'admin-db.php';
    $admin = new Admin();
    session_start();

    //HANDLE ADMIN-LOGIN AJAX REQUEST
    if(isset($_POST['action']) && $_POST['action'] == 'adminLogin'){
            $username  = $admin->test_input($_POST['username']);
            $password  = $admin->test_input($_POST['password']);
    
            $hpassword = sha1($password);          

            $loggedInAdmin = $admin->admin_login($username,$hpassword);

            if ($loggedInAdmin != null) {
                    echo 'admin_login';
                    $_SESSION['username'] = $username;
            }else{
                echo $admin->showMessage('danger','Wrong Password or username');
            }

    }

    //HANDLE ADMIN-USERS AJAX REQUEST
    if(isset($_POST['action']) && $_POST['action'] == 'fetchAllUsers'){
        $output = '';
        $data = $admin->fetchAllUsers(0);
        $path = '../assets/php/';

        if($data){
            $output .= '<table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>E-Mail</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Verified</th>
                        <th>Action</th>
                    </tr>
                </thead> 
                <tbody>';
                    foreach($data as $row){
                        if($row['photo'] != ''){
                            $uphoto = $path.$row['photo'];
                        }else{
                            $uphoto = '../assets/img/avatar.jpg';
                        }

                        $output .='</tr>  
                        <td>'.$row['id'].'</td>
                        <td><img src="'.$uphoto.'" class="rounded-circle" width="40px"></td>
                        <td>'.$row['firstname'].'</td>
                        <td>'.$row['lastname'].'</td>
                        <td>'.$row['username'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['phone'].'</td>
                        <td>'.$row['gender'].'</td>
                        <td>'.$row['verified'].'</td>
                        <td>
                            <a href="#" id="'.$row['id'].'" title="View Details" class="text-primary userDetailsIcon" 
                            data-toggle="modal" data-target="#showUserDetailsModal">
                                <i class="fas fa-info-circle fa-lg"></i>&nbsp;&nbsp;
                            </a>
                            <a href="#" id="'.$row['id'].'" title="Delete User" class="text-danger deleteUserIcon">
                                <i class="fas fa-trash-alt fa-lg"></i>&nbsp;&nbsp;
                            </a>
                        </td>
                        </tr>';
                    }
                    $output .= '</tbody>
                    </table>';

                    echo $output;

        }
        else{
            echo '<h3 class="text-center text-seconadry">:( No any user registered yet!</h3>';
        }

    }

    // HANDLE USER DETAIL AJAX REQUEST
    if(isset($_POST['details_id'])){
        $id  = $_POST['details_id'];       

        $data = $admin->fetchUserDetailsByID($id);

        echo json_encode($data);
    }

    // HANDLE  DELETE A USER AJAX REQUEST
    if(isset($_POST['del_id'])){
        $id  = $_POST['del_id'];       

        $data = $admin->userAction($id,0);

    }


    //HANDLE FETCH DELETED USERS AJAX REQUEST
    if(isset($_POST['action']) && $_POST['action'] == 'fetchAllDeletedUsers'){
        $output = '';
        $data = $admin->fetchAllUsers(1);
        $path = '../assets/php/';

        if($data){
            $output .= '<table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>E-Mail</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Verified</th>
                        <th>Action</th>
                    </tr>
                </thead> 
                <tbody>';
                    foreach($data as $row){
                        if($row['photo'] != ''){
                            $uphoto = $path.$row['photo'];
                        }else{
                            $uphoto = '../assets/img/avatar.jpg';
                        }

                        $output .='</tr>  
                        <td>'.$row['id'].'</td>
                        <td><img src="'.$uphoto.'" class="rounded-circle" width="40px"></td>
                        <td>'.$row['firstname'].'</td>
                        <td>'.$row['lastname'].'</td>
                        <td>'.$row['username'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['phone'].'</td>
                        <td>'.$row['gender'].'</td>
                        <td>'.$row['verified'].'</td>
                        <td>
                            <a href="#" id="'.$row['id'].'" title="Restore User" class="text-white restoreUserIcon badge badge-dark p-2">Restore A User</a>
                        </td>
                        </tr>';
                    }
                    $output .= '</tbody>
                    </table>';

                    echo $output;

        }
        else{
            echo '<h3 class="text-center text-seconadry">:( No any user Deleted yet!</h3>';
        }

    }


    //HANDLE RESTORE DELETED USERS AJAX REQUEST
    if(isset($_POST['res_id'])){
        $id = $_POST['res_id'];
        $admin->userAction($id,1);

    }


    //HANDLE FETCH ALL NOTES AJAX REQUEST
    if(isset($_POST['action']) && $_POST['action'] == 'fetchAllNotes'){

        $output = '';
        $note = $admin->fetchAllNotes();

        if($note){
            $output .= '<table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                    <th>E-Mail</th>
                                    <th>Note Title</th>
                                    <th>note</th>
                                    <th>Written on</th>
                                    <th>Updated on</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 
                            <tbody>';
                                foreach($note as $row){
                                    $output .='</tr>  
                                                    <td>'.$row['id'].'</td>
                                                    <td>'.$row['firstname'].'</td>
                                                    <td>'.$row['lastname'].'</td>
                                                    <td>'.$row['username'].'</td>
                                                    <td>'.$row['email'].'</td>
                                                    <td>'.$row['title'].'</td>
                                                    <td>'.$row['note'].'</td>
                                                    <td>'.$row['created_at'].'</td>
                                                    <td>'.$row['updated_at'].'</td>
                                                    <td>
                                                        <a href="#" id="'.$row['id'].'" title="Delete Note" class="deleteNoteIcon text-danger">
                                                            <i class="fas fa-trash-alt fa-lg"></i>&nbsp;&nbsp;
                                                        </a>
                                                    </td>
                                                </tr>';
                    }
                    $output .= '</tbody>
                    </table>';

                    echo $output;

        }
        else{
            echo '<h3 class="text-center text-seconadry">:( No any Note written yet!</h3>';
        }

    }


    // HANDLE  DELETE A NOTE AJAX REQUEST
    if(isset($_POST['note_id'])){
        $id  = $_POST['note_id'];       

        $admin->deleteNoteOfUser($id);

    }

    // HANDLE  FEEDBACK AJAX REQUEST
    if(isset($_POST['action']) && $_POST['action'] == 'fetchAllFeedback'){
        $output = '';
        $feedback = $admin->fetchAllFeedback();

        if($feedback){
            $output .= '<table>
                <thead>
                    <tr>
                        <th>FID</th>
                        <th>UID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>E-Mail</th>
                        <th>Subject</th>
                        <th>Feedback</th>
                        <th>Sent on</th>
                        <th>Action</th>
                    </tr>
                </thead> 
                <tbody>';
                    foreach($feedback as $row){
                        $output .='</tr>  
                        <td>'.$row['id'].'</td>
                        <td>'.$row['uid'].'</td>
                        <td>'.$row['firstname'].'</td>
                        <td>'.$row['lastname'].'</td>
                        <td>'.$row['username'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['subject'].'</td>
                        <td>'.$row['feedback'].'</td>
                        <td>'.$row['creaed_at'].'</td>
                        <td>
                            <a href="#" fid="'.$row['id'].'" id="'.$row['uid'].'" title="Reply" class="text-primary replyFeedbackIcon" data-toggle="modal" data-target="#showReplyModal">
                                <i class="fas fa-reply fa-lg"></i>&nbsp;&nbsp;
                            </a>
                        </td>
                        </tr>';
                    }
                    $output .= '</tbody>
                    </table>';

                    echo $output;

        }
        else{
            echo '<h3 class="text-center text-seconadry">:( No any Feedback written yet!</h3>';
        }

    }



// HANDLE  REPLY FEEDBACK TO A USER AJAX REQUEST
if (isset($_POST['message'])) {
   $uid = $_POST['uid'];
   $message = $admin->test_input($_POST['message']);
   $fid = $_POST['fid'];

   $admin->replayFeedback($uid,$message);
   $admin->feedbackReplied($fid);
}


//HANDLE  FETCH NOTIFICATION admin AJAX REQUEST
if (isset($_POST['action']) && $_POST['action'] == 'fetchAllNotification') {
    $notification = $admin->fetchNotification();
    $output = '';

    if($notification){
        foreach($notification as $row){
            $output .='<div class="alert alert-dark" role="alert">
            <button class="close" type="button" id="'.$row['id'].'" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;                    
                </span>
            </button>
            <h4 class="alert-heading">New Notification</h4>
            <p class="mb-0 lead">
                '.$row['message'].' by '.$row['username'].'
            </p>
            <hr class="my-2">
            <p class="mb-0 float-left"><b>User E-Mail:</b> '.' '.$row['email'].'</p>
            <p class="mb-0 float-right">'.$admin->timeInAgo($row['created_at']).'</p>
            <div class="clearfix"></div>
        </div>';
        }
        echo $output;
    }
    else{
        echo '<h3 class="text-center text-secondary mt-5">No any new notification</h3>';
    }
}


//handle check if notification exists
if(isset($_POST['action']) && $_POST['action'] == 'checkNotification'){
    if($admin->fetchNotification()){
        echo '<i class="fas fa-circle text-danger fa-sm"></i>';
    }
}else{
    echo '';
}


//handle remove notification 
if(isset($_POST['notification_id'])){
    $id = $_POST['notification_id'];
    $admin->removeNotification($id);
}

//HANDLE EXPORT USERS
if(isset($_GET['export']) && $_GET['export'] == 'excel'){
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=users.xls");
    header("Pragma:no-cache");
    header("Expires:0");

    $data = $admin->exportAllUsers();
    echo '<table border="1" align=center>';

    echo '<tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>E-Mail</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>JOINED ON</th>
            <th>VERIFIED</th>
            <th>DELETED</th>
        </tr>';
        
    foreach($data as $row){
            echo 
        '<tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['username'].'</td>
            <td>'.$row['firstname'].'</td>
            <td>'.$row['lastname'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['phone'].'</td>
            <td>'.$row['gender'].'</td>
            <td>'.$row['dob'].'</td>
            <td>'.$row['created_at'].'</td>
            <td>'.$row['verified'].'</td>
            <td>'.$row['deleted'].'</td>
        </tr>';
    }

    echo '</table>';

}

?>