<?php

require_once("../../music-db-connect.php");

$sql = "SELECT * FROM `comment` WHERE 1 ";
$result = $conn->query($sql);
$userCount = $result->num_rows;
$row = $result->fetch_assoc();

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Comment</title>
    <?php include(dirname(__FILE__) . '../../../link/header.php') ?>

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper" class="template_wrapper">
        <!-- sidebar -->
        <?php include(dirname(__FILE__) . '../../../link/sidebar.php') ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- nav -->
                <?php include(dirname(__FILE__) . '../../../link/nav.php') ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-9 mx-auto user">
                            <div class="d-flex justify-content-between">
                                <div class="">
                                    <h1 class="mb-4">評論新增</h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="comment-list.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>評論管理</p>
                                    </a>
                                </div>
                            </div>
                            <div class="detail_content shadow">
                                <form action="comment-Insert.php" method="post">
                                    <div class="mb-2">
                                        <label for="user_id">會員ID</label>
                                        <input type="text" class="form-control" id="user_id" name="user_id">
                                        <!-- <select class="form-select" name="user_id" id="user_id">
                                            <?php foreach ($rows2 as $csql) : ?>
                                                <option value="<?= $csql["id"] ?>"><?= $csql["user_account"] ?></option>
                                            <?php endforeach; ?>
                                        </select> -->
                                    </div>
                                    <div class="mb-2">
                                        <label for="product_id">商品ID</label>
                                        <input type="text" class="form-control" id="product_id" name="product_id">
                                        <!-- <select class="form-select" name="product_id" id="product_id">
                                            <?php foreach ($rows3 as $csql) : ?>
                                                <option value="<?= $csql["id"] ?>"><?= $csql["product_name"] ?></option>
                                            <?php endforeach; ?>
                                        </select> -->
                                    </div>
                                    <div class="mb-4">
                                        <label for="comment">評論</label>
                                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-info" type="submit">送出</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <?php include(dirname(__FILE__) . '../../../link/js.php') ?>
</body>

</html>