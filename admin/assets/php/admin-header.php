<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:index.php');
        exit();
    }
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
        $title = basename($_SERVER['PHP_SELF'],'.php');
        $title = explode('-',$title);
        $title = ucfirst($title[1]);
    ?>
    <title><?= $title; ?> | Admin Panel</title>
    <!-- TO USE PAGINATION ADD THIS DATA TABLE  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.25/datatables.min.css" />

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css"
        integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"
        integrity="sha512-wV7Yj1alIZDqZFCUQJy85VN+qvEIly93fIQAN7iqDFCPEucLCeNFz4r35FCo9s6WrpdDQPi80xbljXB8Bjtvcg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
        integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>


    <script type="text/javascript">
    // AdminLogin HIDE NAVBAR ajax request
    $(document).ready(function() {
        $("#open-nav").click(function() {
            $(".admin-nav").toggleClass('animate');
        })
    });
    </script>

    <style type="text/css">
    .admin-nav {
        width: 220px;
        min-height: 100vh;
        overflow: hidden;
        background-color: #343a40;
        transition: 0.3s all ease-in-out;
    }

    .admin-link {
        background-color: #343a40;
    }

    .admin-link:hover,
    .nav-active {
        background-color: #212529;
        text-decoration: none;
    }

    .animate {
        width: 0;
        transition: 0.3s all ease-in-out;
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- admin side bar  -->
        <div class="row">
            <div class="admin-nav p-0">
                <h4 class="text-light text-center p-2">
                    Admin Panel
                </h4>
                <div class="list-group list-group-flush">
                    <a href="admin-dashboard.php" class="list-group-item text-light admin-link
                        <?= (basename($_SERVER['PHP_SELF']) == 'admin-dashboard.php') ? "nav-active" : "" ; ?>">
                        <i class="fas fa-chart-pie"></i>&nbsp;&nbsp;
                        Dashboard
                    </a>
                    <a href="admin-users.php" class="list-group-item text-light admin-link
                    <?= (basename($_SERVER['PHP_SELF']) == 'admin-users.php') ? "nav-active" : "" ; ?>">
                        <i class="fas fa-user-friends"></i>&nbsp;&nbsp;
                        Users
                    </a>
                    <a href="admin-notes.php" class="list-group-item text-light admin-link
                    <?= (basename($_SERVER['PHP_SELF']) == 'admin-notes.php') ? "nav-active" : "" ; ?>">
                        <i class="fas fa-sticky-note"></i>&nbsp;&nbsp;
                        Notes
                    </a>
                    <a href="admin-feedback.php" class="list-group-item text-light admin-link
                    <?= (basename($_SERVER['PHP_SELF']) == 'admin-feedback.php') ? "nav-active" : "" ; ?>">
                        <i class="fas fa-comment"></i>&nbsp;&nbsp;
                        Feedback
                    </a>
                    <a href="admin-notification.php" class="list-group-item text-light admin-link
                    <?= (basename($_SERVER['PHP_SELF']) == 'admin-notification.php') ? "nav-active" : "" ; ?>">
                        <i class="fas fa-bell"></i>&nbsp;&nbsp;
                        Notification
                        &nbsp;<span id="checkNotification"></span>
                    </a>
                    <a href="admin-deleteduser.php" class="list-group-item text-light admin-link
                    <?= (basename($_SERVER['PHP_SELF']) == 'admin-deleteduser.php') ? "nav-active" : "" ; ?>">
                        <i class="fas fa-user-slash"></i>&nbsp;&nbsp;
                        Deleted Users
                    </a>
                    <a href="assets/php/admin-action.php?export=excel" class="list-group-item text-light admin-link
                    <?= (basename($_SERVER['PHP_SELF']) == 'admin-dashboard.php') ? "nav-active" : "" ; ?>">
                        <i class="fas fa-table"></i>&nbsp;&nbsp;
                        Export Users
                    </a>
                    <a href="#" class="list-group-item text-light admin-link
                    <?= (basename($_SERVER['PHP_SELF']) == 'admin-dashboard.php') ? "nav-active" : "" ; ?>">
                        <i class="fas fa-id-card"></i>&nbsp;&nbsp;
                        Profile
                    </a>
                    <a href="#" class="list-group-item text-light admin-link
                    <?= (basename($_SERVER['PHP_SELF']) == 'admin-dashboard.php') ? "nav-active" : "" ; ?>">
                        <i class="fas fa-cog"></i>&nbsp;&nbsp;
                        Setting
                    </a>
                </div>
            </div>


            <!-- admin navbar header  -->
            <div class="col">
                <div class="row">
                    <div class="col-lg-12 bg-primary pt-2 justify-content-between d-flex">
                        <a href="#" class="text-white" id="open-nav">
                            <h3><i class="fas fa-bars"></i></h3>
                        </a>
                        <h4 class="text-light"><?= $title; ?></h4>
                        <a href="assets/php/logout.php" class="text-light mt-1">
                            <i class="fas fa-sign-out-alt"></i>&nbsp;Logout
                        </a>
                    </div>
                </div>
            