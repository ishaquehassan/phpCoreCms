<?php
session_start();
header('Access-Control-Allow-Origin: *');
if(isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn']){
    header('Location: home.php');
    die();
}else{
    header('Location: login.php');
}
