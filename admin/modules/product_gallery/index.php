<?php include __DIR__ . "/../configs/module_top_includes.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $moduleConfigs['name'] ?></title>
    <?php include __DIR__ . "/../../template/head.php"; ?>
</head>
<body>
<div class="master-container">
    <?php include __DIR__ . "/../../template/header.php"; ?>

    <?php include __DIR__ . "/../../template/nav.php"; ?>

    <?php
    $gridData = getDb($connection, $moduleConfigs['db_table'], array(
        $moduleConfigs['db_prefix'] . $moduleConfigs['db_fk'] => $_GET[$moduleConfigs['db_fk']]
    ), $moduleConfigs['db_prefix'] . $moduleConfigs['db_pk']);
    ?>

    <div class="content-main">
        <div class="panel">
            <header>
                <h3 class="mt0 mb0 pull-left"><?= $moduleConfigs['name'] ?></h3>


                <a href="http://localhost:81/aurangzaib/sess25/admin/modules/products"
                   class="btn btn-primary pull-right" style="margin-left: 10px;"><i class="fa fa-angle-left"
                                                                                    aria-hidden="true"></i> Back</a>

                <a href="<?= getModuleUrl("add.php") ?>?<?= $moduleConfigs['db_fk'] ?>=<?= $_GET[$moduleConfigs['db_fk']] ?>"
                   class="btn btn-default btn-primary pull-right btn_main_control">Add <i
                        class="fa fa-plus" aria-hidden="true"></i></a>
            </header>
            <div class="panel-content">
                <?php if (mysqli_num_rows($gridData) > 0) { ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th style="width: 90%;">Image</th>
                                <th>Main</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($gridData as $index => $banner) {
                                $image = false;
                                $filePath = getUploadDir($moduleConfigs['upload_dir']) . $banner[$moduleConfigs['db_prefix'] . "image"];
                                if (file_exists($filePath)) {
                                    $image = getUploadDir($moduleConfigs['upload_dir'], true) . $banner[$moduleConfigs['db_prefix'] . "image"];
                                    ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
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
                                            <a href="<?= getModuleUrl("operations.php?id=" . $banner[$moduleConfigs['db_prefix'] . "id"] . "&" . $moduleConfigs['db_fk'] . "=" . $_GET[$moduleConfigs['db_fk']]."&task=main") ?>">
                                                <i class="fa fa-<?= ($banner[$moduleConfigs['db_prefix'] . "main"] > 0 ? "unlock-alt" : "lock") ?>"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?= getModuleUrl("operations.php?id=" . $banner[$moduleConfigs['db_prefix'] . "id"]."&task=status") ?>">
                                                <i class="fa fa-<?= ($banner[$moduleConfigs['db_prefix'] . "status"] > 0 ? "unlock-alt" : "lock") ?>"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?= getModuleUrl("edit.php?id=" . $banner[$moduleConfigs['db_prefix'] . "id"] . "&" . $moduleConfigs['db_fk'] . "=" . $_GET[$moduleConfigs['db_fk']]) ?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?= getModuleUrl("operations.php") ?>?task=delete&id=<?= $banner[$moduleConfigs['db_prefix'] . "id"] . "&" . $moduleConfigs['db_fk'] . "=" . $_GET[$moduleConfigs['db_fk']] ?>">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="4">
                                    <p>Showing <?= mysqli_num_rows($gridData) ?>
                                        Record<?= (mysqli_num_rows($gridData) > 1 ? "s" : "") ?></p>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php } else { ?>
                    <p class="text-center mb0">No Records Found in <?= $moduleConfigs['name'] ?></p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php include "../template/notification.php"; ?>
</body>
</html>