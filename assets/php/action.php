<?php

    session_start();

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);


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
                    $mail->addAddress($email);     //use current email
                    
                    //Content
                    $mail->isHTML(true);
                    $mail->Subject = 'E-mail Verification';
                    $mail->Body = '<h3>Click the link link to verify your E-mail.<br><a href="http://loalhost/user-management/verify_email.php?email='.$email.'">http://loalhost/user-management/verify_email.php?email='.$email.'</a><br>Regards<br>Admin!</h3>';
                    $mail->send();
                    
                }else{
                    echo $user->showMessage('danger','Something went Wrong! try again');
                }
            }
    }



    //HANDLE LOGIN AJAX REQUEST
    // if(isset($_POST['action']) && $_POST['action'] == 'login'){
        if (isset($_POST['login'])) {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                if (isset($_POST['email']) && isset($_POST['password'])) {
                    $email        = $user->test_input($_POST['email']);
                    $password     = $user->test_input($_POST['password']);
    
                    // $password = password_hash($password, PASSWORD_DEFAULT);

                    $loggedInUser = $user->login($email);

                    if ($loggedInUser != null) {
                        if (password_verify($password, $loggedInUser['password'])) {
                            //now check remember me
                            if (!empty($_POST['rem'])) {
                                setcookie("email", $email, time()+(30+24+60+60), '/');
                                setcookie("password", $password, time()+(30+24+60+60), '/');
                            } else {
                                setcookie("email", "", 1, '/');
                                setcookie("password", "", 1, '/');
                            }
                            // echo 'login';
                            $_SESSION['user'] = $email;
                            header('Location: ../../home.php'); // if using ajax remove this redirect
                        }
                      //if incorrect password
                        else {
                            echo $user->showMessage('daner', 'Password is incorrect');
                        }
                    }
                    //if user not found
                    else {
                        echo $user->showMessage('danger', 'User not found!');
                    }
                }else{
                    echo $user->showMessage('danger','Something went wrong during login');
                }
            }else{
                echo $user->showMessage('danger','Password or username can not be empty');
            }

        }


    //HANDLE FORGOT PASSWORD AJAX REQUEST
    if(isset($_POST['action']) && $_POST['action'] == 'forgot'){
        $email = $user->test_input($_POST['email']);

        $user_found = $user->currentUsser($email);


        if($user_found != null){
            $token = uniqid(); //generate unique token
            $token = str_shuffle($token); //use unique every reshuffle

            $user->forgot_password($token,$email);
                    

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
                $mail->setFrom(Database::USERNAME,'root');
                $mail->addAddress($email);
                
                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Reset Password';
                $mail->Body = '<h3>Click the link link to reset your password.<br><a href="http://loalhost/user-management/reset-pa.php?email='.$email.'&token='.$token.'">http://localhost/user-management/reset-pass.php?email='.$email.'&token='.$token.'</a><br>Regards<br>Admin!</h3>';
                $mail->send();
                echo $user->showMessage('success','We have sent you the reset link in your e-mail ID,please check your e-mail!');
                
            }catch(Exception $e){
                echo $user->showMessage('danger','Something went wrong please try again later!');

            }
        }else{
          echo  $user->showMessage('danger','This email is not registerd!');
        }

    }


    //HANDLE IF USER LOGIN
    if(isset($_POST['action']) && $_POST['action'] == 'checkUser'){
        if(!$user->currentUser($_SESSION['user']))
        {
            echo 'bye';
            unset($_SESSION['user']);
        }
    }


?>

