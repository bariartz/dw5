<?php 
session_start();
include("connection.php");

$idpost = $_GET['postid'];
$getDataPost = mysqli_query($conn, "SELECT * FROM `post_tb` WHERE `id`='$idpost'");
$Post = mysqli_fetch_array($getDataPost);

if(empty($_SESSION['login'])){
    header("Location: login.php?continue=edit-content.php");
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
            <button class="btn-add btn waves-effect waves-light" id="editPost">Edit</button>
        </div>
        <div class="container">
            <form action="" method="post" id="form-edit" enctype="multipart/form-data">
                <input type="file" name="media" id="media"/>
                <input type="hidden" name="imgfile" id="imgfile" value="<?php echo $Post['image']; ?>"/>
                <input type="hidden" name="postid" value="<?php echo $idpost; ?>"/>
                <span class="info"></span>
                <textarea name="content" rows="4" cols="50" placeholder="Status"><?php echo $Post['content']; ?></textarea>
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


            let editPost = document.getElementById("editPost");
            editPost.onclick = function(){
                let url = "edit-konten.php";
                let formData = new FormData(document.getElementById("form-edit"));
                let xml = new window.XMLHttpRequest();
                xml.addEventListener("load", (e) => {
                    let msg = e.target.responseText;

                    if(msg === "success"){
                        window.location.href = "index.php";
                    } else {
                        alert("Ada kesalahan saat mengedit konten.");
                    }
                }, false);

                xml.open("POST", url, true);
                xml.send(formData);
            }
        </script>
    </body>
</html>
