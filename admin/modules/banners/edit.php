<?php include __DIR__ . "/../configs/module_top_includes.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$moduleConfigs['name']?></title>
    <?php include __DIR__ . "/../../template/head.php"; ?>
</head>
<body>
<div class="master-container">
    <?php include __DIR__ . "/../../template/header.php"; ?>

    <?php include __DIR__ . "/../../template/nav.php"; ?>

    <?php
    if(!isset($_GET['id'])){
        phpGoBack();
        die();
    }

    $id = $_GET['id'];

    $chkData = getDb($connection,$moduleConfigs['db_table'],array(
        $moduleConfigs['db_prefix']."id" => $id
    ));
    $chkData = mysqli_fetch_array($chkData);
    ?>

    <div class="content-main">
        <div class="panel">
            <header>
                <h3 class="mt0 mb0 pull-left">Edit <?=$moduleConfigs['name']?></h3>
                <a href="<?=(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "home.php")?>" class="btn btn-primary pull-right"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</a>
            </header>
            <div class="panel-content form-content">
                <form action="<?=getModuleUrl("operations.php")?>?task=edit" enctype="multipart/form-data" method="post" novalidate>
                    <input type="hidden" name="id" value="<?=$id?>" />
                    <div class="row form-row">
                        <label class="col-md-2">Title</label>
                        <div class="col-md-4">
                            <input name="title" type="text" value="<?=$chkData[$moduleConfigs['db_prefix']."title"]?>" class="form-control" required placeholder="Enter Title" />
                            <p class="mb0 form_error"><?=getFormErrorMessage("title")?></p>
                        </div>
                    </div>
                    <div class="row form-row">
                        <label class="col-md-2">Link</label>
                        <div class="col-md-4">
                            <input name="link" type="url" value="<?=$chkData[$moduleConfigs['db_prefix']."link"]?>" class="form-control" placeholder="Link To Open" />
                        </div>
                    </div>
                    <div class="row form-row">
                        <label class="col-md-2">Image</label>
                        <div class="col-md-4">
                            <input name="image" required type="file" accept="image/*" class="form-control" />
                            <p class="mb0 form_error"><?=getFormErrorMessage("image")?></p>
                        </div>
                        <?php
                        $image = false;
                        $filePath = getUploadDir($moduleConfigs['upload_dir']).$chkData[$moduleConfigs['db_prefix']."image"];
                        if(file_exists($filePath)){
                            $image =  getUploadDir($moduleConfigs['upload_dir'],true).$chkData[$moduleConfigs['db_prefix']."image"];
                        }
                        ?>
                        <?php if($image){ ?>
                            <div class="col-md-1">
                                <a href="<?=$image?>" class="image-popup-simple"><i class="fa fa-image"></i></a>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row form-row">
                        <div class="col-md-6 col-md-offset-2">
                            <input type="submit" class="btn btn-success" value="Save" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>