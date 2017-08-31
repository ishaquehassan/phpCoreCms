<?php
include __DIR__ . "/../configs/module_top_includes.php";

if(isset($_GET['task'])){
    $task = $_GET['task'];
    if($task == "add"){
        $error = false;
        if(checkPostRequired("title","Title Is Required")){
            $error = true;
        }

        if($error){
            jsGoBack();
            die();
        }else{
            $insertId = insertDb($connection,$moduleConfigs['db_table'],array(
                $moduleConfigs['db_prefix']."title" => $_POST['title']
            ),$moduleConfigs['db_prefix']);
            if($insertId){
                notify($moduleConfigs['name']." Added Successfully");
            }else{
                notify(mysqli_error($connection),false);
            }
            header("Location: ".getModuleUrl());
        }
    }

    if($task == "edit"){
        $error = false;
        if(checkPostRequired("id")){
            $error = true;
        }

        if(checkPostRequired("title","Title Is Required")){
            $error = true;
        }

        if($error){
            jsGoBack();
            die();
        }else {
            $id = $_POST['id'];
            $updateData = updateDb($connection,$moduleConfigs['db_table'],array(
                $moduleConfigs['db_prefix']."title" => $_POST['title']
            ),array(
                $moduleConfigs['db_prefix']."id" => $id
            ));

            if($updateData){
                notify($moduleConfigs['name']." Updated Successfully");
            }else{
                notify(mysqli_error($connection),false);
            }
            header("Location: ".getModuleUrl());

        }
    }

    if($task == "delete"){
        $id = $_GET['id'];
        $chkData = getDb($connection,$moduleConfigs['db_table'],array(
            $moduleConfigs['db_prefix']."id" => $id
        ));
        if(mysqli_num_rows($chkData) > 0){
            $delData = deleteDb($connection,$moduleConfigs['db_table'],array(
                $moduleConfigs['db_prefix']."id" => $id
            ));

            if($delData){
                notify("Data has been deleted Successfully!");
            }else{
                notify(mysqli_error($connection),false);
            }
            phpGoBack();
        }else{
            phpGoBack();
            die("Data Not Found!");
        }
    }
}else{
    die("No Task Sent!");
}