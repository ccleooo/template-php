<?php

if (!isset($_GET["id"])) {
    echo "使用者不存在";
    exit;
}

$id = $_GET["id"];

require_once("../../music-db-connect.php");

// comment
$sql = "SELECT comment.*, user.user_account, user.user_name, user.user_img, product.product_name, product.subject_img, product_spec.spec_name, product_spec.spec_description, user_level.level_name FROM comment
JOIN user ON comment.user_id = user.id
JOIN user_level ON user.user_level_id = user_level.id
JOIN product ON comment.product_id = product.id
JOIN product_spec ON product.spec_id = product_spec.id
WHERE comment.id='$id' ";
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
    <title>評論編輯</title>
    <?php include(dirname(__FILE__) . '../../../link/header.php') ?>
    <link href="../../css/comment.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- sidebar -->
        <?php include(dirname(__FILE__) . '../../../link/sidebar.php') ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- nav -->
                <?php include(dirname(__FILE__) . '../../../link/nav.php') ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-11 mx-auto ">
                            <div class="d-flex justify-content-between">
                                <div class="">
                                    <h1 class="mb-4">商品評論</h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="comment-list.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>評論管理</p>
                                    </a>
                                </div>
                            </div>
                            <div class="detail_content shadow">
                                <div class="user_wrap row align-items-center">
                                    <div class="col-3">
                                        <img class="img_width rounded-circle" src="../../upload/user/<?= $row["user_img"] ?>" alt="user_img">
                                    </div>
                                    <div class="col-9 user_info">
                                        <div class="row justify-content-between mb-3">
                                            <div class="col-6">
                                                <p>
                                                    <?= $row["user_name"] ?>
                                                    <span class="ms-1"><?= $row["user_account"] ?></span>
                                                    <span class="ms-2 primary_name"><?= $row["level_name"] ?>會員</span>
                                                </p>
                                            </div>
                                            <div class="col-4 time">
                                                <p class="time_text">
                                                    <?= $row["create_time"] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="comment">
                                            <p>
                                                <?= $row["comment"] ?>
                                            </p>
                                        </div>
                                        <div class="row product_wrap align-items-center mt-4">
                                            <div class="col-2 p-0 text-center">
                                                <img src="../../upload/product-subject/<?= $row["subject_img"] ?>" class="img_size" alt="subject_img">
                                            </div>
                                            <div class="col-8 product_info ps-0">
                                                <p class="single_ellipsis">
                                                    <?= $row["product_name"] ?>
                                                </p>
                                                <p class="font_gray">
                                                    規格：<?= $row["spec_name"] ?>，<?= $row["spec_description"] ?>
                                                </p>
                                            </div>
                                            <div class="col-2 topage">
                                                <a href="../product/product-detail.php?id=<?= $row["product_id"] ?>">
                                                    <i class="fa-solid fa-circle-arrow-right icon"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- content -->
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