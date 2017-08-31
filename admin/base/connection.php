<?php
//cnt_lists has to be added as varchar(250) in contacts
$connection = mysqli_connect($configs['connection']['host'],$configs['connection']['username'],$configs['connection']['password'],$configs['connection']['db']);
if(!$connection){
    die("Connection Not Successful");
}