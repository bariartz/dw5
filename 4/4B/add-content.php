<?php 
session_start();
include("connection.php");

$getData = mysqli_query($conn, "SELECT u.id, u.name, u.photo ,p.content, p.image FROM `users_tb` AS u JOIN `post_tb` AS p WHERE `id_user` = u.id");

if(empty($_SESSION['login'])){
    header("Location: login.php?continue=add-content.php");
}

?>
<html>
    <head>
        <title>WaysGram</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="stylesheet" href="style.css">
        <style>
            input{
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <div class="headers">
            <h4 class="judulweb">WaysGram</h4>
            <button class="btn-add btn waves-effect waves-light" id="addPosting">Posting</button>
        </div>
        <div class="container">
            <form action="" method="post" id="form-posting" enctype="multipart/form-data">
                <input type="file" name="media" id="media"/>
                <input type="hidden" name="imgfile" id="imgfile"/>
                <span class="info"></span>
                <textarea name="content" rows="4" cols="50" placeholder="Status"></textarea>
            </form>
        </div>

        <script>
            let media = document.getElementById("media");

            if(window.FileList && window.File && window.FileReader){
                document.querySelector("#media").addEventListener("change", (event) => {
                    let formData = new FormData();
                    let file = event.target.files[0];
                    formData.append("media", file);
                    let url = "file-upload.php";
                    let info = document.querySelector(".info");
                    let ajax = new XMLHttpRequest();
                    ajax.addEventListener("progress", (e) => {
                        console.log("Sedang upload file.");
                    }, false);
                    ajax.addEventListener("load", (e) => {
                        let msg = e.target.responseText;

                        if(msg === "mimecheck"){
                            alert("File harus berupa gambar.");
                        } else if(msg === "notimg"){
                            alert("File bukan gambar.");
                        } else if(msg === "fileexist"){
                            alert("File sudah pernah diupload sebelumnya.");
                        } else if(msg === "bigfile"){
                            alert("File yang upload terlalu besar, silahkan upload file maksimal 2MB.");
                        } else if(msg === "filenot"){
                            alert("File yang Anda upload tidak diizinkan oleh sistem. File yang diizinkan ialah jpg, jpeg, dan png.");
                        } else if(msg === "error"){
                            alert("File gagal diupload, silahkan coba lagi.");
                        } else {
                            alert("File berhasil diupload");
                            document.querySelector("#imgfile").value = msg;
                        }

                        console.log(msg);
                    }, false);
                    ajax.addEventListener("error", (e) => {
                        alert("Ada kesalahan saat mengupload file, silahkan coba lagi.");
                    }, false);

                    ajax.open("POST", url, true);
                    ajax.send(formData);
                });
            }

            let addPosting = document.getElementById("addPosting");
            addPosting.onclick = function(){
                let url = "posting-konten.php";
                let formData = new FormData(document.getElementById("form-posting"));
                let xml = new window.XMLHttpRequest();
                xml.addEventListener("load", (e) => {
                    let msg = e.target.responseText;

                    if(msg === "success"){
                        window.location.href = "index.php";
                    } else {
                        alert("Ada kesalahan saat memposting konten.");
                    }
                }, false);

                xml.open("POST", url, true);
                xml.send(formData);
            }
        </script>
    </body>
</html>