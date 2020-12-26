<?php
if(!empty($_FILES['media'])){
    $media = $_FILES['media'];
    $upload_dir = "img/";
    $fileUpload = $upload_dir . basename($media['name']);
    $fileType = strtolower(pathinfo($fileUpload, PATHINFO_EXTENSION));
    $checkfile = getimagesize($media['tmp_name']);
    $uploadOK = true;

    if($checkfile !== false){
        $msg = "mimecheck";
        $uploadOK = true;
    } else {
        $msg = "notimg";
        $uploadOK = false;
    }

    if(file_exists($fileUpload)){
        $msg = "fileexist";
        $uploadOK = false;
    }

    if($media['size'] > 500000){
        $msg = "bigfile";
        $uploadOK = false;
    }

    $allowFileType = ["jpg", "png", "jpeg"];

    if(!in_array($fileType, $allowFileType)){
        $msg = "filenot";
        $uploadOK = false;
    }

    if(!$uploadOK){
        $msg = "error";
    } else {
        if(move_uploaded_file($media['tmp_name'], $fileUpload)){
            $msg = $fileUpload;
        } else {
            $msg = "error";
        }
    }

    echo $msg;
}