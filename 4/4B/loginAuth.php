<?php
session_start();
require_once("connection.php");

if(!empty($_POST['email'])){
    $msg = "";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $getUserData = mysqli_query($conn, "SELECT * FROM `users_tb` WHERE `email`='$email'");
    $UserData = mysqli_fetch_array($getUserData);

    if($email == $UserData['email']){
        if($password == $UserData['password']){
            $msg = "success";
            $_SESSION['login'] = true;
            $_SESSION['email'] = $email;
        } else {
            $msg = "error";
        }
    } else {
        $msg = "error";
    }

    echo $msg;
}