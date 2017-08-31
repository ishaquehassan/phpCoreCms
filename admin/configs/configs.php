<?php
$configs = array();
$navFile = file_get_contents(__DIR__."/nav.json");
$configs["nav"] = json_decode($navFile,true);

$connectionFile = file_get_contents(__DIR__."/db.json");
$configs['connection'] = json_decode($connectionFile,true);

include __DIR__."/../base/connection.php";