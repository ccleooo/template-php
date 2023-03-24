<?php
require_once("../../music-db-connect.php");

$id = $_GET["id"];


$sql = "SELECT orders.*, user.user_account FROM orders
JOIN user ON orders.user_id = user.id
WHERE orders.id='$id' AND valid=1 
ORDER BY orders.id DESC";
//JOIN語法 SELECT A.*, B.* FROM A JOIN B ON A.a_id = B.id (a是A的副鍵)

$result = $conn->query($sql); //SELECT需要有物件去接 所以有這條
$row = $result->fetch_assoc();


?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>修改訂單</title>
    <?php include(dirname(__FILE__) . '../../../link/header.php') ?>
    <link href="../../css/orders.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper" class="template_wrapper">
        <!-- sidebar -->
        <?php include(dirname(__FILE__) . '../../../link/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- nav -->
                <?php include(dirname(__FILE__) . '../../../link/nav.php') ?>

                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-9 mx-auto ">
                            <div class="d-flex justify-content-between">
                                <div class="title">
                                    <h1 class="mb-3">訂單編輯</h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="orders.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>訂單管理</p>
                                    </a>
                                </div>
                            </div>

                            <div class="content shadow">
                                <div class="row d-flex justify-content-between mb-2">
                                    <div class="col-md-5 d-flex align-items-center ">
                                        <h5 class=" order_edit">訂單編輯 </h5>
                                    </div>
                                    <div class="table">
                                        <form action="order-doUpdate.php" method="post">
                                            <table class="table mt-4">
                                                <table class="table table-bordered mt-2">
                                                    <tbody>
                                                        <tr>
                                                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                                            <td class="bg_gray">訂單編號</td>
                                                            <td class="text-start"><?= $row["id"] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bg_gray">訂購者</td>
                                                            <td class="text-start">
                                                                <?= $row["user_account"] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bg_gray">下單時間</td>
                                                            <td class="text-start"><?= $row["order_create_time"] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bg_gray">連絡電話</td>
                                                            <td>
                                                                <input type="text" class="form-control" value="<?= $row["order_phone"] ?>" name="order_phone">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bg_gray">寄送地址</td>
                                                            <td>
                                                            <input type="text" class="form-control" 
                                                                value="<?php if ($row["take_method"] == "1") {
                                                                                echo $row["order_address"];
                                                                            } else {
                                                                                echo "桃園市中壢區新生路二段421號";
                                                                            }
                                                                        ?>" name="order_address">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bg_gray">付款方式</td>
                                                            <td>
                                                                <select class="form-select" id="pay_method" name="pay_method">
                                                                    <option value="1" <?php if ($row["pay_method"] == 1) echo "selected" ?>>線上付款</option>
                                                                    <option value="2" <?php if ($row["pay_method"] == 2) echo "selected" ?>>銀行轉帳</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bg_gray">取件方式</td>
                                                            <td>
                                                            <select class="form-select" id="take_method" name="take_method">
                                                                <option value="1" <?php if ($row["take_method"] == 1) echo "selected" ?>>黑貓宅配</option>
                                                                <option value="2" <?php if ($row["take_method"] == 2) echo "selected" ?>>自取</option>
                                                            </select>
                                                        </td>

                                                        <tr>
                                                            <td class="bg_gray">運費</td>
                                                            <td>
                                                                <input type="text" class="form-control" value="<?= $row["freight"] ?>" name="freight">
                                                            </td>
                                                        </tr>

                                                        </tr>
                                                        <tr>
                                                            <td class="bg_gray">付款狀態</td>
                                                            <td>
                                                            <select class="form-select" id="pay_status" name="pay_status">
                                                                <option value="1" <?php if ($row["pay_status"] == 1) echo "selected" ?>>未付款</option>
                                                                <option value="2" <?php if ($row["pay_status"] == 2) echo "selected" ?>>已付款</option>
                                                            </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bg_gray">處理進度</td>
                                                            <td>
                                                            <select class="form-select" id="update_status" name="update_status">
                                                                <option value="1" <?php if ($row["update_status"] == 1) echo "selected" ?>>未出貨</option>
                                                                <option value="2" <?php if ($row["update_status"] == 2) echo "selected" ?>>已出貨</option>
                                                                <option value="3" <?php if ($row["update_status"] == 3) echo "selected" ?>>退/換貨</option>
                                                            </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bg_gray">訂單狀態</td>
                                                            <td>
                                                            <select class="form-select" id="order_status" name="order_status">
                                                                <option value="1" <?php if ($row["order_status"] == 1) echo "selected" ?>>未完成</option>
                                                                <option value="2" <?php if ($row["order_status"] == 2) echo "selected" ?>>已完成</option>
                                                            </select>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                               
                                            <div class="button_class text-center">
                                                <button class="btn btn-primary save" type="submit">儲存</button>
                                                <a href="order-delete.php?id=<?= $row["id"] ?>" class="btn btn-danger delete">刪除</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <?php include(dirname(__FILE__) . '../../../link/js.php') ?>
</body>

</html>