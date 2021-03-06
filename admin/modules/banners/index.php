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
    $gridData = getDb($connection,$moduleConfigs['db_table'],array(),$moduleConfigs['db_prefix'].$moduleConfigs['db_pk']);
    ?>

    <div class="content-main">
        <div class="panel">
            <header>
                <h3 class="mt0 mb0 pull-left"><?=$moduleConfigs['name']?></h3>
                <a href="<?=getModuleUrl("add.php")?>" class="btn btn-default btn-primary pull-right btn_main_control">Add <i
                        class="fa fa-plus" aria-hidden="true"></i></a>
            </header>
            <div class="panel-content">
                <?php if(mysqli_num_rows($gridData) > 0){ ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th style="width: 90%;">Title</th>
                            <th>Image</th>
                            <th>Link</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($gridData as $index => $banner) {
                            $image = false;
                            $filePath = getUploadDir($moduleConfigs['upload_dir']).$banner[$moduleConfigs['db_prefix']."image"];
                            if(file_exists($filePath)){
                                $image =  getUploadDir($moduleConfigs['upload_dir'],true).$banner[$moduleConfigs['db_prefix']."image"];
                            }
                            ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?=$banner[$moduleConfigs['db_prefix']."title"]?></td>
                                <td>
                                    <?php if($image !== false){ ?>
                                    <a href="<?=$image?>" class="image-popup">
                                        <img width="25" class="img-responsive" src="<?=$image?>" />
                                    </a>
                                    <?php }else{ ?>
                                    -
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if(strlen($banner[$moduleConfigs['db_prefix']."link"]) > 1){ ?>
                                        <a href="<?=$banner[$moduleConfigs['db_prefix']."link"]?>" target="_blank"><i class="fa fa-chain"></i></a>
                                    <?php }else{ ?>
                                    -
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="<?=getModuleUrl("edit.php?id=".$banner[$moduleConfigs['db_prefix']."id"])?>">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?=getModuleUrl("operations.php")?>?task=delete&id=<?=$banner[$moduleConfigs['db_prefix']."id"]?>">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4">
                                <p>Showing <?=mysqli_num_rows($gridData)?> Record<?=(mysqli_num_rows($gridData) > 1 ? "s" : "")?></p>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <?php }else{ ?>
                    <p class="text-center mb0">No Records Found in <?=$moduleConfigs['name']?></p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php include "../template/notification.php"; ?>
</body>
</html>