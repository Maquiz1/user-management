<?php
session_start();
require_once 'auth.php';
$cuser = new Auth();

if(!isset($_SESSION['user'])){ 
    header('location:index.php');
    die;
}

$cemail = $_SESSION['user'];

$data = $cuser->currentUsser($cemail);

//set all current vaiables
$cid = $data['id'];
$cfirstname = $data['firstname'];
$clastname = $data['lastname'];
$cusername = $data['username'];
$cpass = $data['password'];
$cgender = $data['gender'];
$cdob = $data['dob'];
$cphoto = $data['photo'];
$created_at = $data['created_at'];
$verified = $data['verified'];
$deleted= $data['deleted'];
$cphone = $data['phone'];


if($verified == 0){
    $verified = 'Not Verified!';
}else{
    $verified = 'Verified!';
}

//use only first name
$fname = strtok($cfirstname, " ");


$reg_on = date('d M Y', strtotime($created_at));
?>
