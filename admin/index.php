<?php 
    session_start();
    if(isset($_SESSION['username'])){
        header('location:admin-dashboard.php');
        exit();
    }

    //Count Visitors
    include_once 'assets/php/config.php';
    $db = new Database();

    $sql = "UPDATE visitors SET hits = hits+1 WHERE id = 0";
    $stmt = $db->conn->prepare($sql);
    $stmt->execute();
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <style type="text/css">
        html,body{
            height: 100%;
        }
    </style>
</head>

<body class="bg-dark">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-lg-5">
                <div class="card border-danger shadow-lg">
                    <div class="card-header bg-danger">
                        <h3 class="m-0 text-white">
                            <i class="fas fa-user-cog"></i>&nbsp;
                            Admin Panel Login
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="#" class="px-3" method="post" id="admin-login-form">
                        <!-- admin alert here  -->
                        <div id="adminLoginAlert"></div>     
                            <div class="form-group">
                                <input type="text" name="username" class="form-control form-control-lg rounded-0"
                                    placeholder="Username" required autofocus>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-lg rounded-0"
                                    placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="admin-login" class="btn btn-danger btn-block btn-lg rounded-0"
                                    value="Login" id="adminLoginBtn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
        // AdminLogin ajax request
        $("#adminLoginBtn").click(function(e){
            if($("#admin-login-form")[0].checkValidity()){
            //   PREVENT PAGE TO REFRESH
               e.preventDefault();
               $("#adminLoginBtn").val('Please wait...');
                $.ajax({
                    url: 'assets/php/admin-action.php',
                    method: 'post',
                    data: $("#admin-login-form").serialize()+'&action=adminLogin',   // serialize to put in array
                    success:function(response){
                    if(response = 'admin_login'){
                        window.location = 'admin-dashboard.php';
                    }else{
                        $("#adminLoginAlert").html(response);
                    }
                    $("#adminLoginBtn").val('Login');
                    }
                });
               }
        });

    });
    </script>

</body>

</html>