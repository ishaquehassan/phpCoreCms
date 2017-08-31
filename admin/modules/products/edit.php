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

    <?php
    $catConfigs = getModuleByPackage("categories");
    $categories = getDb($connection,$catConfigs['db_table'],array(),$catConfigs['db_prefix'].$catConfigs['db_pk']);
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
                        <label class="col-md-2">Category</label>
                        <div class="col-md-4">
                            <select name="catId" class="form-control" required title="">
                                <option value="">Select Category</option>
                                <?php while ($category = mysqli_fetch_array($categories)){ ?>
                                    <option value="<?=$category[$catConfigs['db_prefix'].$catConfigs['db_pk']]?>" <?=($category[$catConfigs['db_prefix'].$catConfigs['db_pk']] == $chkData[$moduleConfigs['db_prefix']."catId"] ? "selected" : "")?>>
                                        <?=$category[$catConfigs['db_prefix'].'title']?>
                                    </option>
                                <?php } ?>
                            </select>
                            <p class="mb0 form_error"><?=getFormErrorMessage("catId")?></p>
                        </div>
                    </div>
                    <div class="row form-row">
                        <label class="col-md-2">Price</label>
                        <div class="col-md-4">
                            <input name="price" type="number" step="any" class="form-control" required placeholder="Enter Price" value="<?=$chkData[$moduleConfigs['db_prefix']."price"]?>" />
                            <p class="mb0 form_error"><?=getFormErrorMessage("price")?></p>
                        </div>
                    </div>
                    <div class="row form-row">
                        <label class="col-md-2">Discount Percent</label>
                        <div class="col-md-4">
                            <input name="discount" type="number" step="any" class="form-control" placeholder="Enter Discount Percentage" value="<?=$chkData[$moduleConfigs['db_prefix']."discount"]?>" />
                        </div>
                    </div>
                    <div class="row form-row">
                        <label class="col-md-2">Description</label>
                        <div class="col-md-4">
                            <textarea style="height: 125px;" name="descp" class="form-control" placeholder="Enter Product Description"><?=$chkData[$moduleConfigs['db_prefix']."descp"]?></textarea>
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