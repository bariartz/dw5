<?php
session_start();
require_once("connection.php");

if(!empty($_GET['postid'])){
    $msg = "";
    $postid = mysqli_real_escape_string($conn, $_GET['postid']);

    $rem = mysqli_query($conn, "DELETE FROM `post_tb` WHERE `id`='$postid'");

    if($rem){
        $msg = "removed";
    } else {
        $msg ="error";
    }

    echo $msg;
}