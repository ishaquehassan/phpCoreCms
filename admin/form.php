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
                <h3 class="mt0 mb0 pull-left">Add Form</h3>
                <a href="<?=(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "home.php")?>" class="btn btn-primary pull-right"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</a>
            </header>
            <div class="panel-content form-content">
                <form action="#" method="post">
                    <div class="row form-row">
                        <label class="col-md-2">Title</label>
                        <div class="col-md-4">
                            <input name="title" type="text" class="form-control" required placeholder="Enter Title" />
                        </div>
                    </div>
                    <div class="row form-row">
                        <label class="col-md-2">Email</label>
                        <div class="col-md-4">
                            <input name="email" type="email" class="form-control" required placeholder="Enter Email" />
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