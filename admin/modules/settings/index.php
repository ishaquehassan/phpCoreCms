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
            </header>
            <div class="panel-content">
                <?php if(mysqli_num_rows($gridData) > 0){ ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th style="width: 45%;">Title</th>
                            <th style="width: 45%;">Value</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($gridData as $index => $banner) { ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?=$banner[$moduleConfigs['db_prefix']."title"]?></td>
                                <td><?=$banner[$moduleConfigs['db_prefix']."value"]?></td>
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