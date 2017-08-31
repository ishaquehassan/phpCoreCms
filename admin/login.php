<?php
session_start();
if(isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn']){
    header('Location: home.php');
    die();
}
include "configs/configs.php";
$base_path = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <?php include "template/head.php"; ?>
</head>
<body>

<div class="container">
    <div class="form_container">
        <h3 class="text-center mt0">Login Admin Panel</h3>
        <form action="base/verify.php" method="post" class="login_form">
            <input type="text" class="form-control" placeholder="Username" name="username" required />
            <input type="password" class="form-control" placeholder="Password" name="password" required />
            <div class="row">
                <div class="col-sm-2">
                    <input type="submit" class="btn btn-default btn-primary" value="Login" />
                </div>
                <div class="col-sm-10">
                    <p class="response_text mb0"></p>
                </div>
            </div>
        </form>

    </div>
</div>

</body>
</html>