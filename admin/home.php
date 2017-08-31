<?php include "base/session_check.php" ?>
<?php include "configs/configs.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <?php include "template/head.php"; ?>
</head>
<body>
<div class="master-container">
    <?php include "template/header.php"; ?>

    <?php include "template/nav.php"; ?>

    <div class="content-main">
        <div class="panel">
            <header>
                <h3 class="mt0 mb0 pull-left">Dashboard</h3>
                <a href="form.php" class="btn btn-default btn-primary pull-right btn_main_control">Add <i class="fa fa-plus" aria-hidden="true"></i></a>
            </header>
            <div class="panel-content">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th style="width: 45%;">Name</th>
                            <th style="width: 45%;">Email</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php for ($gl = 0; $gl <= 100; $gl++) { ?>
                            <tr>
                                <td><?=$gl+1?></td>
                                <td>Ishaq</td>
                                <td>abc@gmail.com</td>
                                <td><i class="fa fa-edit"></i></td>
                                <td><i class="fa fa-trash"></i></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4">
                                <p>Showing Page 1 of 10</p>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>