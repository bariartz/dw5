<?php 
session_start();

if(!empty($_SESSION['login'])){
    header("Location: index.php");
}
?>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <form action="" method="post" id="form-login">
            <input type="text" name="email" placeholder="Email" />
            <input type="password" name="password" placeholder="Password" />
        </form>
        <button type="button" class="btn waves-light waves-effect" id="login">Login</button>
        <span class="error"></span>
        <script>
            let loginBtn = document.querySelector("#login");

            loginBtn.onclick = function(){
                let url = "loginAuth.php";
                let formData = new FormData(document.querySelector("#form-login"));
                let req = new window.XMLHttpRequest();
                req.addEventListener("progress", (e) => {
                    document.getElementById("login").innerText = "Sedang Login.";
                }, false);
                req.addEventListener("load", (e) => {
                    let msg = e.target.responseText;

                    if(msg === "success"){
                        window.location.href = '<?php echo $_GET['continue']; ?>';
                    } else {
                        document.querySelector(".error").innerText = "Email/Password salah.";
                    }
                }, false);
                req.addEventListener("error", (e) => {
                    alert("Ada kesalahan saat login. Silahkan coba lagi");
                }, false);

                req.open("POST", url, true);
                req.send(formData);
            }
        </script>
    </body>
</html>