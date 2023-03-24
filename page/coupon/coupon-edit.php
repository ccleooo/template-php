<?php
if (!isset($_GET["id"])) {
    echo "使用者不存在";
    exit;
}
$sn = $_GET["id"];

require_once("../../music-db-connect.php");

$sql = "SELECT * FROM coupon WHERE sn='$sn' AND valid=1";
$result = $conn->query($sql);
$snCount = $result->num_rows;

$row = $result->fetch_assoc();



// var_dump($rows);
// exit;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>優惠管理-編輯優惠券</title>
    <!-- Bootstrap CSS v5.2.1 -->
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
                                <div class="title">
                                    <h1 class="mb-3">編輯優惠券</h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="coupon.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>優惠券</p>
                                    </a>
                                </div>
                            </div>
                            <div class="content shadow">
                                <table class="table mt-2">
                                    <form action="coupon-doUpdate.php" method="post">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <input type="hidden" name="sn" value="<?= $row["sn"] ?>">
                                                    <td class="bg_gray">序號</td>
                                                    <td class="text-start"><?= $row["sn"] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="bg_gray">優惠名稱</td>
                                                    <td>
                                                        <input type="text" class="form-control" value="<?= $row["coupon_name"] ?>" name="coupon_name">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="bg_gray">折扣金額</td>
                                                    <td>
                                                        <input type="text" class="form-control" value="<?= $row["discount"] ?>" name="discount">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="bg_gray">數量</td>
                                                    <td>
                                                        <input type="text" class="form-control" value="<?= $row["quota"] ?>" name="quota">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="bg_gray">開始時間</td>
                                                    <td>
                                                        <input type="datetime-local" class="form-control" value="<?= $row["start_time"] ?>" name="start_time">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="bg_gray">結束時間</td>
                                                    <td>
                                                        <input type="datetime-local" class="form-control" value="<?= $row["end_time"] ?>" name="end_time">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            <button class="btn btn-primary my-3" type="submit">儲存</button>
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


    <!-- js -->
    <?php include(dirname(__FILE__) . '../../../link/js.php') ?>
</body>

</html>