<?php
include __DIR__ . "/../configs/module_top_includes.php";
if (isset($_GET['task'])) {
    $task = $_GET['task'];
    if ($task == "add") {
        $error = false;
        if (checkFileMultipleRequired("image", "Select at least one image")) {
            $error = true;
        }
        if ($error) {
            arrayPreview($_FILES);
            //    jsGoBack();
            die();
        } else {
            $uploaded = 0;
            $fileUpload = uploadMultipleFiles("image", "image_", getUploadDir($moduleConfigs['upload_dir']));
            if ($fileUpload != false) {
                foreach ($fileUpload as $file) {
                    $insertId = insertDb($connection, $moduleConfigs['db_table'], array(
                        $moduleConfigs['db_prefix'] . "image" => $file,
                        $moduleConfigs['db_prefix'] . $moduleConfigs['db_fk'] => $_POST[$moduleConfigs['db_fk']]
                    ), $moduleConfigs['db_prefix']);
                    if ($insertId) {
                        if($uploaded == 0){
                            $updateMain = updateDb($connection, $moduleConfigs['db_table'], array(
                                $moduleConfigs['db_prefix'] . "main" => 1
                            ), array(
                                $moduleConfigs['db_prefix'] . "id" => $insertId
                            ));
                        }
                        $uploaded++;
                    }
                }
            }
            if ($uploaded > 0) {
                notify("Uploaded Files " . $uploaded . " of " . count($_FILES['image']['name']));
            } else {
                notify("Error while uploading images, try again later", false);
            }
            header("Location: " . getModuleUrl("index.php?" . $moduleConfigs['db_fk'] . "=" . $_POST[$moduleConfigs['db_fk']]));
        }
    }
    if ($task == "edit") {
        $error = false;
        if (checkFileRequired("image", "Please Select Image")) {
            $error = true;
        }
        if ($error) {
            jsGoBack();
            die();
        } else {
            $id = $_POST['id'];
            $chkData = getDb($connection, $moduleConfigs['db_table'], array(
                $moduleConfigs['db_prefix'] . "id" => $id
            ));
            $chkData = mysqli_fetch_array($chkData);
            $fileUpload = uploadFile("image", "image_" . $id, getUploadDir($moduleConfigs['upload_dir']));
            $update = false;
            if ($fileUpload != false) {
                $file = getUploadDir($moduleConfigs['upload_dir']) . $chkData[$moduleConfigs['db_prefix'] . "image"];
                if (file_exists($file)) {
                    unlink($file);
                }
                $update = updateDb($connection, $moduleConfigs['db_table'], array(
                    $moduleConfigs['db_prefix'] . "image" => $fileUpload,
                ), array(
                    $moduleConfigs['db_prefix'] . "id" => $id
                ));
            }
            if ($update) {
                notify($moduleConfigs['name'] . " Image Updated Successfully");
            } else {
                notify(mysqli_error($connection), false);
            }
            header("Location: " . getModuleUrl("index.php?" . $moduleConfigs['db_fk'] . "=" . $_POST[$moduleConfigs['db_fk']]));
        }
    }
    if ($task == "delete") {
        $id = $_GET['id'];
        $chkData = getDb($connection, $moduleConfigs['db_table'], array(
            $moduleConfigs['db_prefix'] . "id" => $id
        ));
        if (mysqli_num_rows($chkData) > 0) {
            $chkData = mysqli_fetch_array($chkData);
            $file = getUploadDir($moduleConfigs['upload_dir']) . $chkData[$moduleConfigs['db_prefix'] . "image"];
            if (file_exists($file)) {
                unlink($file);
            }
            $delData = deleteDb($connection, $moduleConfigs['db_table'], array(
                $moduleConfigs['db_prefix'] . "id" => $id
            ));
            if ($delData) {
                if ($chkData[$moduleConfigs['db_prefix'] . "main"] > 0) {
                    $chkOtherData = getDb($connection, $moduleConfigs['db_table'], array(
                        $moduleConfigs['db_prefix'] . $moduleConfigs['db_fk'] => $_GET[$moduleConfigs['db_fk']]
                    ));
                    if (mysqli_num_rows($chkOtherData) > 0) {
                        $chkOtherData = getDbWithFields($connection, "MAX(" . $moduleConfigs['db_prefix'] . "id) maxid", $moduleConfigs['db_table'], array(
                            $moduleConfigs['db_prefix'] . $moduleConfigs['db_fk'] => $_GET[$moduleConfigs['db_fk']]
                        ));
                        $chkOtherData = mysqli_fetch_array($chkOtherData);
                        $maxId = $chkOtherData['maxid'];
                        $maxId = intval($maxId);
                        if ($maxId > 0) {
                            $updateMain = updateDb($connection, $moduleConfigs['db_table'], array(
                                $moduleConfigs['db_prefix'] . "main" => 1
                            ), array(
                                $moduleConfigs['db_prefix'] . "id" => $maxId
                            ));
                        }
                    }
                }
                notify("Data has been deleted Successfully!");
            } else {
                notify(mysqli_error($connection), false);
            }
            phpGoBack();
        } else {
            phpGoBack();
            die("Data Not Found!");
        }
    }
    if ($task == "status") {
        $id = $_GET['id'];
        $chkData = getDb($connection, $moduleConfigs['db_table'], array(
            $moduleConfigs['db_prefix'] . "id" => $id
        ));
        if (mysqli_num_rows($chkData) > 0) {
            $chkData = mysqli_fetch_array($chkData);
            $st = 0;
            if ($chkData[$moduleConfigs['db_prefix'] . "status"] <= 0) {
                $st = 1;
            }
            $updateStatus = updateDb($connection, $moduleConfigs['db_table'], array(
                $moduleConfigs['db_prefix'] . "status" => $st
            ), array(
                $moduleConfigs['db_prefix'] . "id" => $id
            ));
            if ($updateStatus) {
                notify(($st > 0 ? "Enabled" : "Disabled") . " Successfully!");
            } else {
                notify(mysqli_error($connection), false);
            }
            phpGoBack();
        } else {
            phpGoBack();
            die("Data Not Found!");
        }
    }
    if ($task == "main") {
        $id = $_GET['id'];
        $chkData = getDb($connection, $moduleConfigs['db_table'], array(
            $moduleConfigs['db_prefix'] . "id" => $id
        ));
        if (mysqli_num_rows($chkData) > 0) {
            $chkData = mysqli_fetch_array($chkData);
            $updateStatus = updateDb($connection, $moduleConfigs['db_table'], array(
                $moduleConfigs['db_prefix'] . "main" => 1
            ), array(
                $moduleConfigs['db_prefix'] . "id" => $id
            ));
            if ($updateStatus) {
                $updateStatus = updateDb($connection, $moduleConfigs['db_table'], array(
                    $moduleConfigs['db_prefix'] . "main" => 0
                ), array(
                    $moduleConfigs['db_prefix'] . "id !" => $id,
                    $moduleConfigs['db_prefix'] . $moduleConfigs['db_fk'] => $_GET[$moduleConfigs['db_fk']],
                ));
                notify("Main Image Updated Successfully!");
            } else {
                notify(mysqli_error($connection), false);
            }
            phpGoBack();
        } else {
            phpGoBack();
            die("Data Not Found!");
        }
    }

} else {
    die("No Task Sent!");
}