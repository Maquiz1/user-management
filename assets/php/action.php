<?php
    session_start();
    require_once 'auth.php';
    $user = new Auth();

    if(isset($_POST['action']) && $_POST['action'] == 'register'){
            $firstname    = $user->test_input($_POST['firstname']);
            $lastname     = $user->test_input($_POST['lastname']);
            $username     = $user->test_input($_POST['username']);
            $email        = $user->test_input($_POST['email']);
            $password1    = $user->test_input($_POST['password1']);
        
            $password = password_hash($password1, PASSWORD_DEFAULT);

            if($user->user_exists($email)){
                echo $user->showMessage('warning','Email already registerd');

            }else{
                if($user->register($firstname,$lastname,$username,$password,$email)){
                    echo 'register';
                    $_SESSION['user'] = $email;
                }else{
                    echo $user->showMessage('danger','Something went Wrong! try again');
                }
            }
    }

?>

