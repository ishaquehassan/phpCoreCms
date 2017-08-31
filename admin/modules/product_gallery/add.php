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
    $catConfigs = getModuleByPackage("categories");
    $categories = getDb($connection,$catConfigs['db_table'],array(),$catConfigs['db_prefix'].$catConfigs['db_pk']);
    ?>

    <div class="content-main">
        <div class="panel">
            <header>
                <h3 class="mt0 mb0 pull-left">Add <?=$moduleConfigs['name']?></h3>
                <a href="<?=getModuleUrl("index.php?")?><?=$moduleConfigs['db_fk']?>=<?=$_GET[$moduleConfigs['db_fk']]?>" class="btn btn-primary pull-right"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</a>
            </header>
            <div class="panel-content form-content">
                <form action="<?=getModuleUrl("operations.php")?>?task=add" enctype="multipart/form-data" method="post" novalidate>
                    <input type="hidden" value="<?=$_GET[$moduleConfigs['db_fk']]?>" name="<?=$moduleConfigs['db_fk']?>" />
                    <div class="row form-row">
                        <label class="col-md-2">Image(s)</label>
                        <div class="col-md-4">
                            <input name="image[]" accept="image/*" multiple type="file" class="form-control" required />
                            <p class="mb0 form_error"><?=getFormErrorMessage("image")?></p>
                        </div>
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