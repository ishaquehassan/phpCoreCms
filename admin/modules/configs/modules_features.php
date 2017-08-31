<?php
function getModuleUrl($file = ""){
    $currentPath = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $currentPathExp = explode("/",$currentPath);
    unset($currentPathExp[count($currentPathExp)-1]);
    /*if(stripos(end($currentPathExp),".php") !== false){
        $currentPath = implode("/",$currentPathExp);
    }else{
        $currentPath = implode("/",$currentPathExp);
    }*/
    $currentPath = implode("/",$currentPathExp);
    return "http://".$currentPath."/".$file;
}

function getModuleName(){
    $currentPath = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $currentPathExp = explode("/",$currentPath);
    unset($currentPathExp[count($currentPathExp)-1]);
    $currentPath = implode("/",$currentPathExp);
    return end(explode("/",$currentPath));
}

function getUploadDir($dir,$forUi = false){
    if(!$forUi){
        return "../../../images/".$dir;
    }else{
        return "../images/".$dir;
    }
}

function getModuleByPackage($packageName = ""){
    $moduleConfigs = false;
    $configFilePath = __DIR__ ."/../".$packageName."/configs.json";
    if(file_exists($configFilePath)){
        $moduleConfigs = json_decode(file_get_contents($configFilePath),true);
    }
    return $moduleConfigs;
}