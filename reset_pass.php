<?php 

    require_once 'assets/php/auth.php';
    $user = new Auth();
    $msg = '';

    if(isset($_GET['email']) && isset($_GET['token'])){
        $email = $user->test_input($_GET['email']);
        $token = $user->test_input($_GET['token']);

        $auth_user = $user->reset_pass_auth($email, $token);

        if($auth_user != null){
            if(isset($_POST['submit'])){
                $newpass = $_POST['pass'];
                $cnewpss = $_POST['cpass'];

                $hnewpass = password_($newpass, PASSWORD_DEFAULT);

                if($newpass == $cnewpss){
                    $user->update_new_pass($hnewpass,$email);
                    $msg = 'Passowrd Changed Succseefully!<br><a href="index.php">Login Here!</a>';
                }else{
                    $msg = 'Passowrd did not Match!';
                }
            }
        }
        else{
            header('location:index.php');
            exit();
        }
    }
    else {
        header('location:index.php');
        exit();
    }


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css"
        integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>
    <div class="container">
        <!-- LOGIN FORM START -->

        <div class="row justify-content wrapper mt-4">
            <div class="col-lg-10 mx-auto my-auto">
                <div class="card-group myShadow">

                <div class="card justify-content-center rounded-right myColor p-4">
                        <h1 class="text-center font-weight-bold text-white">Hello Friend</h1>
                        <hr class="my-3 bg-light myHr">
                        <p class="text-center font-weight-bolder text-light lead">
                            Reset your password here!
                        </p>
                    </div>
                    <div class="card rounded-left p-4" style="flex-grow:1.4;">
                        <h1 class="text-center font-weight-bold text-primary">
                            Reset Password!
                        </h1>
                        <hr class="my-3">
                        <form action="#" method="post" clsass="px-3">
                            <div class="text-center lead my-2"><?= $msg; ?></div> 
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="fas fa-key fa-lg"></i>
                                    </span>
                                </div>
                                <input type="password" name="pass" class="form-control rounded-0"
                                    placeholder="New Password"
                                    value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password']; } ?>">
                            </div>

                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="fas fa-key fa-lg"></i>
                                    </span>
                                </div>
                                <input type="password" name="cpass" class="form-control rounded-0"
                                    placeholder="Confirm New Password"
                                    value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password']; } ?>">
                            </div>

                            <div class="form-group">
                                <input type="submit" name="submit " value="Reset"
                                    class="btn btn-primary btn-lg btn-block myBtn">
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>


    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
        integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>