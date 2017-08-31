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

    <div class="content-main">
        <div class="panel">
            <header>
                <h3 class="mt0 mb0 pull-left">Add <?=$moduleConfigs['name']?></h3>
                <a href="<?=(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "home.php")?>" class="btn btn-primary pull-right"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</a>
            </header>
            <div class="panel-content form-content">
                <form action="<?=getModuleUrl("operations.php")?>?task=add" enctype="multipart/form-data" method="post" novalidate>
                    <div class="row form-row">
                        <label class="col-md-2">Title</label>
                        <div class="col-md-4">
                            <input name="title" type="text" class="form-control" required placeholder="Enter Title" />
                            <p class="mb0 form_error"><?=getFormErrorMessage("title")?></p>
                        </div>
                    </div>
                    <div class="row form-row">
                        <label class="col-md-2">Value</label>
                        <div class="col-md-4">
                            <input name="value" type="text" class="form-control" required placeholder="Enter Value" />
                            <p class="mb0 form_error"><?=getFormErrorMessage("value")?></p>
                        </div>
                    </div>
                    <div class="row form-row">
                        <label class="col-md-2">Type</label>
                        <div class="col-md-4">
                            <input name="type" type="text" class="form-control" required placeholder="Enter Type" />
                            <p class="mb0 form_error"><?=getFormErrorMessage("type")?></p>
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