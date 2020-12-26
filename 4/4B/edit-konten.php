<?php
session_start();
require_once("connection.php");

if(!empty($_POST['content'])){
    $msg = "";
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $postid = mysqli_real_escape_string($conn, $_POST['postid']);
    $imgContent = mysqli_real_escape_string($conn, $_POST['imgfile']);

    $getUser = mysqli_query($conn, "SELECT id FROM `users_tb` WHERE `email`='{$_SESSION['email']}'");
    $User = mysqli_fetch_array($getUser);
    $userid = $User['id'];

    $ins = mysqli_query($conn, "UPDATE `post_tb` SET `content`='$content', `image`='$imgContent' WHERE `id`='$postid'");

    if($ins){
        $msg = "success";
    } else {
        $msg = "error";
    }

    echo $msg;
}