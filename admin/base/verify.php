<?php
$response = array("msg" => "","error" => true);
if(isset($_POST['username']) and isset($_POST['password'])){
    include '../configs/configs.php';
    $userQ = mysqli_query($connection,"SELECT * FROM users WHERE uname = '".$_POST['username']."' AND upass = '".$_POST['password']."'");

    if(mysqli_num_rows($userQ) > 0){
        session_start();
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['name'] = $_POST['username'];
        $response['msg'] = "Login Success! Please wait...";
        $response['error'] = false;
        $response['url'] = "modules/banners/index.php";
        //header('Location: home.php');
    }else{
        $response['msg'] = "Invalid Username / Password!";
        //header('Location: index.php');
    }
}else{
    $response['msg'] = "Invalid Data!";
    //header('Location: index.php');
}
echo json_encode($response);