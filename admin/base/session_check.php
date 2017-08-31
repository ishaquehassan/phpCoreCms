<?php
session_start();
if(!isset($_SESSION['isLoggedIn']) and !$_SESSION['isLoggedIn']){
    header('Location: index.php');
    die();
}
?>