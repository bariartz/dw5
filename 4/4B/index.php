<?php
session_start();
include("connection.php");

$getData = mysqli_query($conn, "SELECT u.id, u.name, u.photo, u.email , p.id AS postid, p.content, p.image FROM `users_tb` AS u JOIN `post_tb` AS p WHERE `id_user` = u.id ORDER BY p.id DESC");
?>
<html>
    <head>
        <title>WaysGram</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="headers">
            <h4 class="judulweb">WaysGram</h4>
            <button class="btn-add btn waves-effect waves-light">Add Content</button>
        </div>
        <div class="container">
            <div class="row">
        <?php   
            if(mysqli_num_rows($getData) > 0){
                while($Data = mysqli_fetch_array($getData)){
                    if(!empty($_SESSION['login']) && !empty($_SESSION['email'])){
                        if($_SESSION['email'] == $Data['email']){
                            $btn = '<button class="btn-add btn waves-effect waves-light" id="edit-btn">Edit</button>
                            <button class="btn-add btn waves-effect waves-light" id="remove-btn">Hapus</button>';
                        } else {
                            $btn = "";
                        }
                    }
        ?>
                <div class="card" data-id="<?php echo $Data['postid'];?>">
                    <div class="users">
                        <img src="<?php echo $Data['photo']; ?>"/>
                        <div class="user-name"><?php echo $Data['name']; ?></div>
                    </div>
                    <div class="content">
                        <img src="<?php echo $Data['image']; ?>" />
                        <div class="user-name"><?php echo $Data['name']; ?></div>
                        <div class="user-content"><?php echo $Data['content']; ?></div>
                        <div class="btn-content"><?php echo $btn; ?></div>
                    </div>
                </div>
            <?php        
                }
            }
            ?>
            </div>
        </div>

        <script>
            let addBtn = document.querySelector(".btn-add");
            let editBtn = document.querySelector("#edit-btn");
            let removeBtn = document.querySelectorAll("#remove-btn");

            addBtn.onclick = function(){
                window.location.href = "add-content.php";
            }

            editBtn.onclick = function(){
                let idpost = document.querySelector(".card").getAttribute("data-id");
                window.location.href = "edit-content.php?postid=" + idpost;
            }

            for (let i = 0; i < removeBtn.length; i++) {
                removeBtn[i].addEventListener("click", function() {
                    const elem = this;
                    const postLink = elem.previousElementSibling.parentElement.previousElementSibling.parentElement.previousElementSibling.parentElement.getAttribute("data-id");
                    const url = "remove-content.php?postid=" + postLink;
                    const rmPost = new window.XMLHttpRequest();
                    rmPost.addEventListener("progress", function() {
                        console.log("Sedang menghapus postingan.");
                    }, false);
                    rmPost.addEventListener("load", function(e) {
                        const re = e.target.responseText;
                        if (re === "removed") {
                            alert("Postingan berhasil dihapus.");
                            elem.previousElementSibling.parentElement.previousElementSibling.parentElement.previousElementSibling.parentElement.remove();
                        } else {
                            alert("Ada kesalahan dalam menghapus postingan. Silahkan coba lagi.");
                        }
                    }, false);
                    rmPost.addEventListener("error", function() {
                        alert("Gagal menghapus postingan. Silahkan coba lagi.");
                    }, false);
                    rmPost.open("GET", url, true);
                    rmPost.send();
                });
            }
        </script>
    </body>
</html>
