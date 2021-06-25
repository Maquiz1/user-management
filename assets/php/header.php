<?php
require_once 'assets/php/session.php';
// echo '<pre>';
// print_r($data);
// echo '<pre>';
?>

<?php 
    // if(isset($_SESSION['user'])){
    //     header('location:home.php');
    // }

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ucfirst(basename($_SERVER['PHP_SELF'],'php')); ?> | USER-MANAGEMENT</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->




    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css"
        integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.25/datatables.min.css"/>
    <style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap');

    * {
        font-family: 'Maven Pro', sans-serif;
    }
    </style>
</head>

<body>
    <div class="container-fluid">

        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <!-- Brand -->
            <a class="navbar-brand" href="index.php  "><i class="fas fa-code fa-lg"></i>&nbsp;&nbsp;User-management</a>

            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links --><i class="fas fa-home"></i>&nbsp;
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <!-- make link to right side with ml-auto -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <!-- make active -->
                        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "home.php") ? "active" : ""; ?>" href="home.php"><i class="fas fa-home"></i>&nbsp;Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?= (basename($_SERVER['PHP_SELF']) == "profile.php") ? "active" : ""; ?>" href="profile.php"><i class="fas fa-user"></i>&nbsp;Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?= (basename($_SERVER['PHP_SELF']) == "feedback.php") ? "active" : ""; ?>" href="feedback.php"><i class="fas fa-comment-dots"></i>&nbsp;Feedback</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?= (basename($_SERVER['PHP_SELF']) == "notification.php") ? "active" : ""; ?>" href="notification.php"><i class="fas fa-bell"></i>&nbsp;Notification</a>
                    </li>

                    <!-- Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            <i class="fas fa-user-cog"></i>&nbsp;Hi! <?= $cusername; ?>
                        </a>

                        <!-- define drop down menu  -->
                        <div class="dropdown-menu">
                            <a class="dropdown-item">
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-cog"></i>&nbsp;Setting
                                </a>
                            </a>
                            <a class="dropdown-item">
                                <a class="dropdown-item" href="assets/php/logout.php">
                                    <i class="fas fa-sign-out-alt"></i>&nbsp;Logout
                                </a>
                            </a>
                            <a class="dropdown-item" href="#">Admin</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
