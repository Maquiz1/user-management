<?php
    require_once 'auth.php';
    $user = new Auth();

    //HANDLE REGISTER AJAX REQUEST
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



    //HANDLE LOGIN AJAX REQUEST
    if(isset($_POST['action']) && $_POST['action'] == 'login'){
        $email        = $user->test_input($_POST['email']);
        $password     = $user->test_input($_POST['password']);
    
        // $password = password_hash($password, PASSWORD_DEFAULT);

        $loggedInUser = $user->login($email);

        if($loggedInUser != null ){
            if(password_verify($password, $loggedInUser['password'])){
                //now check remember me
                if(!empty($_POST['rem'])){
                    setcookie("email", $email, time()+(30+24+60+60), '/');
                    setcookie("password", $password, time()+(30+24+60+60), '/');
                }else{
                    setcookie("email","",1, '/');
                    setcookie("password","",1, '/');
                }
                echo 'login';
                $_SESSION['user'] = $email;

            }
            //if incorrect password
            else{
                echo $user->showMessage('daner','Password is incorrect');
            }
        }
        //if user not found
        else{
            echo $user->showMessage('danger','User not found!');
        }
    }


?>

