<?php 
    if(isset($_SESSION['user'])){
        header('location:home.php');
    }


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
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

        <div class="row justify-content wrapper mt-4" id="login-box">
            <div class="col-lg-10 mx-auto my-auto">
                <div class="card-group myShadow">
                    <div class="card rounded-left p-4" style="flex-grow:1.4;">
                        <h1 class="text-center font-weight-bold text-primary">
                            Sign in to Account
                        </h1>
                        <hr class="my-3">
                        <form action="#" method="post" clsass="px-3" id="login-form">
                        <div id="loginAlert"></div>
                            <div class="input-group input-group-l form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="far fa-envelope fa-lg"></i>
                                    </span>
                                </div>
                                <input type="email" name="email" id="lemail" class="form-control rounded-0"
                                    placeholder="E-Mail" value="<?php if(isset($_COOKIE['email'])){ echo $_COOKIE['email']; } ?>">
                            </div>
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="fas fa-key fa-lg"></i>
                                    </span>
                                </div>
                                <input type="password" name="password" id="password" class="form-control rounded-0"
                                    placeholder="Password" value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password']; } ?>">
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox float-left">
                                    <input type="checkbox" name="rem" class="custom-conrol-input" id="customCheck"
                                    <?php if(isset($_COOKIE['email'])) { ?> checked <?php } ?>>
                                    <label for="customCheck">Remember me</label>
                                </div>
                                <div class="forgot float-right">
                                    <a href="#" id="forgot-link">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <input type="submit" name="login" value="Sign In" id="login-btn"
                                    class="btn btn-primary btn-lg btn-block myBtn">
                            </div>
                        </form>
                    </div>
                    <div class="card justify-content-center rounded-right myColor p-4">
                        <h1 class="text-center font-weight-bold text-white">Hello Friend</h1>
                        <hr class="my-3 bg-light myHr">
                        <p class="text-center font-weight-bolder text-light lead">
                            Enter your personal details and start your journey with us!
                        </p>
                        <button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn"
                            id="register-link">
                            Sign Up
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- LOGIN FORM END -->

        <!-- REGISTER FORM START HERE -->
       

        <div class="row justify-content wrapper mt-4" id="register-box" style="display: none;">
            <div class="col-lg-10 mx-auto my-auto">
                <div class="card-group myShadow">
                    <div class="card justify-content-center rounded-right myColor p-4">
                        <h1 class="text-center font-weight-bold text-white">Welcome Back</h1>
                        <hr class="my-3 bg-light myHr">
                        <p class="text-center font-weight-bolder text-light lead">
                            TO keep connected with us please login with your personal info
                        </p>
                        <button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn"
                            id="login-link">
                            Sign In
                        </button>
                    </div>
                    <div class="card rounded-left p-4" style="flex-grow:1.4;">
                        <h1 class="text-center font-weight-bold text-primary">
                            Create Account
                        </h1>
                        <hr class="my-3">
                        <form action="#" clsass="px-3" id="register-form" method="post">
                            <div id="regAlert"></div>
                            <div class="input-group input-group-l form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="far fa-user fa-lg"></i>
                                    </span>
                                </div>
                                <input type="text" name="firstname" id="firstname" class="form-control rounded-0"
                                    placeholder="First Name">
                            </div>
                            <div class="input-group input-group-l form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="far fa-user fa-lg"></i>
                                    </span>
                                </div>
                                <input type="text" name="lastname" id="lastname" class="form-control rounded-0"
                                    placeholder="Last Name">
                            </div>
                            <div class="input-group input-group-l form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="far fa-user fa-lg"></i>
                                    </span>
                                </div>
                                <input type="text" name="username" id="username" class="form-control rounded-0"
                                    placeholder="Username">
                            </div>
                            <div class="input-group input-group-l form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="far fa-envelope fa-lg"></i>
                                    </span>
                                </div>
                                <input type="email" name="email" id="remail" class="form-control rounded-0"
                                    placeholder="E-Mail">
                            </div>
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="fas fa-key fa-lg"></i>
                                    </span>
                                </div>
                                <input type="password" name="password1" id="password1" class="form-control rounded-0"
                                    placeholder="Password" minlength="3">
                            </div>
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="fas fa-key fa-lg"></i>
                                    </span>
                                </div>
                                <input type="password" name="password2" id="password2" class="form-control rounded-0"
                                    placeholder="Confirm Password" value=<?= $_POST['password2']; ?>>
                            </div>
                            <div id="passError" class="text text-danger"></div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox float-left">
                                    <input type="checkbox" name="rem" class="custom-conrol-input" id="rcustomCheck">
                                    <label for="customCheck">Remember me</label>
                                </div>
                                <div class="forgot float-right">
                                    <a href="#" id="forgot-link">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <input type="submit" name="register" value="Sign Up" id="register-btn"
                                    class="btn btn-primary btn-lg btn-block myBtn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- REGISTER FORM END HERE -->

        <!-- FORGOT PASSWORD FORM START HERE -->

        <div class="row justify-content wrapper mt-4" id="forgot-box" style="display: none;">
            <div class="col-lg-10 mx-auto my-auto">
                <div class="card-group myShadow">
                    <div class="card justify-content-center rounded-right myColor p-4">
                        <h1 class="text-center font-weight-bold text-white">Reset password</h1>
                        <hr class="my-3 bg-light myHr">
                        <button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn"
                            id="back-link">
                            BACK
                        </button>
                    </div>
                    <div class="card rounded-left p-4" style="flex-grow:1.4;">
                        <h1 class="text-center font-weight-bold text-primary">
                            Forgot your password
                        </h1>
                        <hr class="my-3">
                        <p class="lead text-center text-secondary">
                            To reset your password enter the registered Email and we will send you the reset
                            instructions on your email
                        </p>
                        <form action="#" method="post" clsass="px-3" id="forgot-form">
                            <div id="forgotAlert"></div>
                            <div class="input-group input-group-l form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="far fa-envelope fa-lg"></i>
                                    </span>
                                </div>
                                <input type="email" name="email" id="femail" class="form-control rounded-0"
                                    placeholder="E-Mail">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <input type="submit" name="reset" value="Reset password" id="forgot-btn"
                                    class="btn btn-primary btn-lg btn-block myBtn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- FORGOT PASSWORD FORM END HERE -->
    </div>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"
        integrity="sha512-wV7Yj1alIZDqZFCUQJy85VN+qvEIly93fIQAN7iqDFCPEucLCeNFz4r35FCo9s6WrpdDQPi80xbljXB8Bjtvcg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
        integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
    $(document).ready(function() {

        $("#register-link").click(function() {
            $("#login-box").hide();
            $("#register-box").show();
        });

        $("#login-link").click(function() {
            $("#login-box").show();
            $("#register-box").hide();
        });

        $("#forgot-link").click(function() {
            $("#login-box").hide();
            $("#forgot-box").show();
        });

        $("#back-link").click(function() {
            $("#login-box").show();
            $("#forgot-box").hide();
        });

        // Register ajax request
        $("#register-btn").click(function(e){
            if($("#register-form")[0].checkValidity()){
            //   PREVENT PAGE TO REFRESH
               e.preventDefault();
               $("#register-btn").val('Please wait...');
               if($("#password1").val() != $("#password2").val()){
                   $("#passError").text('* Passowrd do not match'); 
                   //console.log("Not matched"); 
                   $("#register-btn").val('Sign Up');                
               }
               else{
                $('#passError').text(''); 
                $.ajax({
                    url: 'assets/php/action.php',
                    method: 'post',
                    data: $("#register-form").serialize()+'&action=register',   // serialize to put in array
                    success:function(response){
                    $('#register-btn').val('Sign Up'); 
                    console.log(response);
                    if($.trim(response) == 'register'){
                        window.location = 'home.php';
                    }else{
                        $("#regAlert").html(response);
                    }
                    }
                });
               }
           }
        });


        // Login ajax request
        $("#login-btn").click(function(e){
            if($("#login-form")[0].checkValidity()){
                //   PREVENT PAGE TO REFRESH
                e.preventDefault();
                $("#login-btn").val('Please wait...');
                $.ajax({
                        url: 'assets/php/action.php',
                        method: 'post',
                        data: $("#login-form").serialize()+'&action=login',   // serialize to put in array
                        success:function(response){
                        $('#login-btn').val('Sign in'); 
                        if($.trim(response) == 'login'){
                            window.location = 'home.php';
                        }else{
                            $("#loginAlert").html(response);
                        }
                        
                        }
                    });
                
                }

            });

        //FORGOT PASSWORD AJAX request
        $("#forgot-btn").click(function(e){
            if($("#forgot-form")[0].checkValidity()){
                //   PREVENT PAGE TO REFRESH
                e.preventDefault();
                $("#forgot-btn").val('Please wait...');
                $.ajax({
                        url: 'assets/php/action.php',
                        method: 'post',
                        data: $("#forgot-form").serialize()+'&action=forgot',   // serialize to put in array
                        success:function(response){
                        $('#forgot-btn').val('Reset Password'); 
                        $('#forgot-form')[0].reset; 
                        $('#forgotAlert').html(response);                         
                        }
                    });
                
                }

            });


    });
    </script>

</body>

</html>