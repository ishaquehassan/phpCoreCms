<?php
function uploadFile($field, $newName, $path = '../images/', $allowedExtensions = array("jpg", "png", "gif"))
{
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }
    if (isset($_FILES[$field])) {
        $f_name = $_FILES[$field]['name'];
        $f_tmp = $_FILES[$field]['tmp_name'];
        $f_size = $_FILES[$field]['size'];
        $f_ext = explode(".", $f_name);
        $f_ext = strtolower(end($f_ext));
        $f_newName = $newName . '.' . $f_ext;
        $store = $path . $f_newName;
        if (in_array($f_ext, $allowedExtensions)) {
            if ($f_size <= 2097152) {
                move_uploaded_file($f_tmp, $store);
                $image_name = $newName . "_" . $f_name;
                rename($store, $path . $image_name);
                return $image_name;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function uploadMultipleFiles($field, $newName, $path = '../images/', $allowedExtensions = array("jpg", "png", "gif"))
{
    if(!file_exists($path)){
        mkdir($path);
    }

    $returnImages = array();
    for($i = 0;$i<count($_FILES[$field]['name']);$i++){
        $f_name = $_FILES[$field]['name'][$i];
        $f_tmp = $_FILES[$field]['tmp_name'][$i];
        $f_size = $_FILES[$field]['size'][$i];
        $f_ext = explode(".", $f_name);
        $f_ext = strtolower(end($f_ext));
        $f_newName = uniqid("image_")."_".$newName . '.' . $f_ext;
        $store = $path . $f_newName;
        if (in_array($f_ext,$allowedExtensions)) {
            move_uploaded_file($f_tmp, $store);
            rename($store, $path . $f_newName);
            $returnImages[] = $f_newName;
        }
    }
    return (count($returnImages) > 0 ? $returnImages : false);
}

function insertDb($con, $table, $data, $prefix = "")
{
    $escapedData = array();
    foreach ($data as $value) {
        if (!is_numeric($value)) {
            $escapedStr = mysqli_real_escape_string($con, $value);
            $value = "'" . $escapedStr . "'";
        }
        $escapedData[] = $value;
    }
    $insert = mysqli_query($con, "INSERT INTO " . $table . "(" . implode(",", array_keys($data)) . ") VALUES(" . implode(",", $escapedData) . ")");
    if ($insert) {
        $lastIdQ = mysqli_fetch_array(getDbWithFields($con, "MAX(" . $prefix . "id) lastId", $table));
        return $lastIdQ['lastId'];
    } else {
        return false;
    }
}

function updateDb($con, $table, $data, $where = array())
{
    $updateStr = array();
    foreach ($data as $field => $value) {
        if (!is_numeric($value)) {
            $escapedStr = mysqli_real_escape_string($con, $value);
            $value = "'" . $escapedStr . "'";
        }
        $updateStr[] = $field . " = " . $value;
    }
    $finalQuery = "UPDATE " . $table . " SET " . implode(",", $updateStr);
    if (count($where) > 0) {
        $finalQuery .= " WHERE ";
        $whrArr = array();
        foreach ($where as $field => $value) {
            if (!is_numeric($value)) {
                $escapedStr = mysqli_real_escape_string($con, $value);
                $value = "'" . $escapedStr . "'";
            }
            $whrArr[] = $field . "= " . $value;
        }
        $finalQuery .= implode(" AND ", $whrArr);
    }
    $update = mysqli_query($con, $finalQuery);
    if ($update) {
        return true;
    } else {
        return false;
    }
}

function getDb($con, $table, $where = array(), $order_field = false, $order = "DESC")
{
    $selectFinal = "SELECT * FROM " . $table;
    if (count($where) > 0) {
        $selectFinal .= " WHERE ";
        $whrArr = array();
        foreach ($where as $field => $value) {
            if (!is_numeric($value)) {
                $escapedStr = mysqli_real_escape_string($con, $value);
                $value = "'" . $escapedStr . "'";
            }
            $whrArr[] = $field . " = " . $value;
        }
        $selectFinal .= implode(" AND ", $whrArr);
    }
    if ($order_field !== false) {
        $selectFinal .= " ORDER BY " . $order_field . " " . $order;
    }
    $gridData = mysqli_query($con, $selectFinal);
    return $gridData;
}

function getDbWithFields($con, $fields = "*", $table, $where = array(), $order_field = false, $order = "DESC")
{
    $selectFinal = "SELECT " . $fields . " FROM " . $table;
    if (count($where) > 0) {
        $selectFinal .= " WHERE ";
        $whrArr = array();
        foreach ($where as $field => $value) {
            $whrArr[] = $field . " = " . $value;
        }
        $selectFinal .= implode(" AND ", $whrArr);
    }
    if ($order_field !== false) {
        $selectFinal .= " ORDER BY " . $order_field . " " . $order;
    }
    $gridData = mysqli_query($con, $selectFinal);
    return $gridData;
}

function deleteDb($con, $table, $where = array())
{
    $deleteFinal = "DELETE FROM " . $table;
    if (count($where) > 0) {
        $deleteFinal .= " WHERE ";
        $whrArr = array();
        foreach ($where as $field => $value) {
            if (!is_numeric($value)) {
                $escapedStr = mysqli_real_escape_string($con, $value);
                $value = "'" . $escapedStr . "'";
            }
            $whrArr[] = $field . " = " . $value;
        }
        $deleteFinal .= implode(" AND ", $whrArr);
    }
    $delData = mysqli_query($con, $deleteFinal);
    if ($delData) {
        return true;
    } else {
        return false;
    }
}

function arrayPreview($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function checkPostRequired($fieldName, $setErrorMsg = false)
{
    $error = false;
    if (!isset($_POST[$fieldName]) or strlen(trim($_POST[$fieldName])) <= 0) {
        $error = true;
        if ($setErrorMsg) {
            setFormErrorMessage($fieldName, $setErrorMsg);
        }
    }
    return $error;
}

function checkFileRequired($fieldName, $setErrorMsg = false)
{
    $error = false;
    if (!isset($_FILES[$fieldName]) or
        ((is_array($_FILES[$fieldName]['name']) and (count($_FILES[$fieldName]['name']) <= 0 or strlen(trim($_FILES[$fieldName]['name'][0])) <= 0)) or strlen(trim($_FILES[$fieldName]['name'])) <= 0)) {
        $error = true;
        if ($setErrorMsg) {
            setFormErrorMessage($fieldName, $setErrorMsg);
        }
    }
    return $error;
}

function checkFileMultipleRequired($fieldName, $setErrorMsg = false)
{
    $error = false;
    if (!isset($_FILES[$fieldName]) or
        count($_FILES[$fieldName]['name']) <= 0 or
        strlen(trim($_FILES[$fieldName]['name'][0])) <= 0) {
        $error = true;
        if ($setErrorMsg) {
            setFormErrorMessage($fieldName, $setErrorMsg);
        }
    }
    return $error;
}

function setFormErrorMessage($fieldName, $msg)
{
    $_SESSION["FORM_ERRORS"][$fieldName] = $msg;
}

function getFormErrorMessage($fieldName)
{
    $msg = "";
    if (isset($_SESSION["FORM_ERRORS"][$fieldName])) {
        $msg = $_SESSION["FORM_ERRORS"][$fieldName];
        unset($_SESSION["FORM_ERRORS"][$fieldName]);
    }
    return $msg;
}

function jsGoBack()
{
    echo "<script>window.history.back();</script>";
}

function phpGoBack()
{
    header("Location: " . $_SERVER['HTTP_REFERER']);
}

function notify($msg = "", $type = true)
{
    $_SESSION['notification_message'] = array(
        "msg" => $msg,
        "type" => ($type ? "success" : "error")
    );
}

function getNotification(){
    if(isset($_SESSION['notification_message'])){
        $notification = $_SESSION['notification_message'];
        unset($_SESSION['notification_message']);
        return $notification;
    }else{
        return false;
    }
}