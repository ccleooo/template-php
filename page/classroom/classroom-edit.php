<?php
if (!isset($_GET["id"])) {
    echo "使用者不存在";
    exit;
}

$id = $_GET["id"];

require_once("../../music-db-connect.php"); //撈資料

$sql = "SELECT * FROM classroom WHERE id='$id' AND class_order_vaild=1"; //WHERE 是篩選欄位
$result = $conn->query($sql);

$classroomCount = $result->num_rows;

$row = $result->fetch_assoc(); //多維陣列 (1)

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>classroom-edit</title>
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
                                    <h1 class="mb-3">教室編輯</h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="classroom.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>教室資訊</p>
                                    </a>
                                </div>
                            </div>

                            <div class="content shadow">
                                <form action="classroom-doUpdate.php" method="post" enctype="multipart/form-data">
                                    <table class="table table-bordered mt-4">
                                        <tbody>
                                            <tr>
                                                <td class="bg_gray">教室編號</td>
                                                <td class="text-start">
                                                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                                    <?= $row["id"] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">教室名稱</td>
                                                <td>
                                                    <input type="text" class="form-control" id="classroom_name" name="classroom_name" value="<?= $row["classroom_name"] ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">教室價格</td>
                                                <td>
                                                    <input type="text" class="form-control" id="reserve_price" name="reserve_price" value="<?= $row["reserve_price"] ?>">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="bg_gray">課室圖片</td>
                                                <td>
                                                    <input type="hidden" name="old_img" value="<?= $row["classroom_img"] ?>">
                                                    <input type="file" class="form-control" name="classroom_img">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="bg_gray">教室資訊</td>
                                                <td>
                                                    <input type="text" class="form-control" id="classroom_info" name="classroom_info" value="<?= $row["classroom_info"] ?>">
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                        <button class="btn btn-primary" type="submit">儲存</button>
                                    </div>
                                </form>
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