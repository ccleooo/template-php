<?php
require_once("../../music-db-connect.php");


$id=$_GET["id"];


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
                        <div class="col-11 mx-auto user">
                            <div class="d-flex justify-content-between">
                                <div class="title">
                                    <h1 class="mb-3">訂單資訊</h1>
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
                                    <table class="table table-hover mt-4">
                                        <thead>
                                            <tr>
                                                <th>訂單編號</th>
                                                <th>會員</th>
                                                <th>電話</th>
                                                <th>課程</th>
                                                <th>價錢</th>
                                                <th>下單時間</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                       
                                            <tbody>
                                                    <tr>
                                                        <td><?= $row["id"] ?></td>
                                                        <td><?= $row["user_account"] ?></td>
                                                        <td><?= $row["order_phone"] ?></td>
                                                        <td><?= $row["class_name"] ?></td>
                                                        <td><?= $row["order_price"] ?></td>
                                                        <td><?= $row["create_time"] ?></td>
                                                        <td>
                                                            <a class="btn btn-primary me-3" href="class-order-edit.php?id=<?= $row["id"] ?>">編輯</a>
                                                            <a class="btn btn-danger" href="class-order-delete.php?id=<?= $row["id"] ?>">刪除</a>
                                                        </td>
                                                    </tr>
                                            </tbody>
                                        
                                    </table>
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