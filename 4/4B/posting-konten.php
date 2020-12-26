<?php
session_start();
require_once("connection.php");

if(!empty($_POST['content'])){
    $msg = "";
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $imgContent = mysqli_real_escape_string($conn, $_POST['imgfile']);

    $getUser = mysqli_query($conn, "SELECT id FROM `users_tb` WHERE `email`='{$_SESSION['email']}'");
    $User = mysqli_fetch_array($getUser);
    $userid = $User['id'];

    $ins = mysqli_query($conn, "INSERT INTO `post_tb` (`content`, `image`, `id_user`) VALUES ('$content', '$imgContent', '$userid')");

    if($ins){
        $msg = "success";
    } else {
        $msg = "error";
    }

    echo $msg;
}