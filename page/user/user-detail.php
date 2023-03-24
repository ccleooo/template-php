<?php
require_once("../../music-db-connect.php");

if (!isset($_GET["id"])) {  //當要$_GET>>需要先判斷GET在不在!!
    echo "使用者不存在";
    exit;
}

$id = $_GET["id"];

//抓user_level.level_name
$sql = "SELECT user.*, user_level.level_name FROM user JOIN user_level ON user.user_level_id = user_level.id WHERE user.id='$id'";
$result = $conn->query($sql);
$userCount = $result->num_rows;
$row = $result->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>會員管理-會員資訊</title>
    <?php include(dirname(__FILE__) . '../../../link/header.php') ?>
    <link href="css/user.css" rel="stylesheet">
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
                                <div class="title">
                                    <h1 class="mb-3">會員資訊</h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="user.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>會員管理</p>
                                    </a>
                                </div>
                            </div>
                            <div class="detail_content shadow">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="img_width">
                                            <img class="img-fluid rounded-circle" src="../../upload/user/<?= $row["user_img"] ?>" alt="user_img" width="80%">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9 mx-auto mt-4 user_bg_gray">
                                                <p class="mb-2">
                                                    會員姓名：<?= $row["user_name"] ?>
                                                </p>
                                                <p>
                                                    會員帳號：<?= $row["user_account"] ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <table class="table table-hover mt-4">
                                            <tbody>
                                                <tr>
                                                    <td class="bg_gray">生日</td>
                                                    <td><?= $row["user_birthday"] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="bg_gray">信箱</td>
                                                    <td><?= $row["user_mail"] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="bg_gray">電話</td>
                                                    <td><?= $row["user_phone"] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="bg_gray">地址</td>
                                                    <td><?= $row["user_address"] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="bg_gray">會員等級</td>
                                                    <td> <?= $row["level_name"] ?> </td>
                                                </tr>
                                                <tr>
                                                    <td class="bg_gray">註冊日期</td>
                                                    <td><?= $row["create_time"] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <a class="btn btn-primary" href="user-edit.php?id=<?= $row["id"] ?>">編輯</a>
                                </div>
                            </div>
                            <!-- content -->
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


    <!-- js -->
    <?php include(dirname(__FILE__) . '../../../link/js.php') ?>
</body>

</html>