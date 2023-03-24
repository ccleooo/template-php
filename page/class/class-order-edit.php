<?php
require_once("../../music-db-connect.php");

$id=$_GET["id"];
//var_dump($id);


$sql = "SELECT class_order.*, class.class_name, user.user_account, user.user_phone FROM class_order
    JOIN user ON class_order.user_id = user.id
    JOIN class ON class_order.class_id = class.id
    -- JOIN語法 SELECT A.*, B.* FROM A JOIN B ON A.a_id = B.id (a是A的副鍵)
    WHERE class_order.id=$id
    ORDER BY class_order.id DESC";

$result=$conn->query($sql);
$row=$result->fetch_assoc(); 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>class-order-detail</title>
    <?php include(dirname(__FILE__) . '../../../link/header.php')?>

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
                                    <h1 class="mb-3">課程訂單</h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="class-order.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>課程訂單</p>
                                    </a>
                                </div>
                            </div>

                            <div class="content shadow">
                                <div class="row d-flex  align-items-center">
                                    <form action="class-order-doUpdate.php" method="post">
                                        <table class="table table-bordered mt-4">
                                            <tbody>                                              
                                                <tr>
                                                    <td class="bg_gray">訂單編號</td>
                                                    <td class="text-start"><input type="hidden" name="id" value="<?= $row["id"] ?>"><?= $row["id"] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="bg_gray">會員</td>
                                                    <td class="text-start">
                                                        <?= $row["user_account"] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="bg_gray">電話</td>
                                                    <td>
                                                        <input type="text" class="form-control" value="<?= $row["order_phone"] ?>" name="order_phone" id="order_phone">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="bg_gray">課程</td>
                                                    <td>
                                                        <input type="text" class="form-control" id="class_id" name="class_id" value="<?= $row["class_id"] ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="bg_gray">價錢</td>
                                                    <td>
                                                        <input type="text" class="form-control" id="order_price" name="order_price" value="<?= $row["order_price"] ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="bg_gray">下單時間</td>
                                                    <td class="text-start">
                                                        <?= $row["create_time"] ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            <button class="btn btn-primary me-3" href="class-order-detail.php?id=<?= $row["id"] ?>" type="submit">儲存</button>
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