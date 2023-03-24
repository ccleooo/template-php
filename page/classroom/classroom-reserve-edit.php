<?php
if (!isset($_GET["id"])) { //http://localhost/20221024/user.php?name=AAA  直接搜尋名字,如果要搜尋GET 要先確認他存不存在
    echo "使用者不存在";
    exit;
}

$id = $_GET["id"];

require_once("../../music-db-connect.php"); //撈資料        

$sql = "SELECT classroom_reserve.*, classroom.classroom_name, user.user_account  FROM classroom_reserve
JOIN user ON classroom_reserve.user_id = user.id
JOIN classroom ON classroom_reserve.classroom_id = classroom.id
WHERE classroom_reserve.id = '$id' ";
//  $result = $conn->query($sql);

// $sql = "SELECT * FROM classroom_reserve WHERE id='$id' AND Class_order_valid=1"; //WHERE 是篩選欄位
$result = $conn->query($sql);

$classroom_reserveCount = $result->num_rows;

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
                        <div class="col-11 mx-auto user">
                            <div class="d-flex justify-content-between">
                                <div class="title">
                                    <h1 class="mb-3">教室預約編輯</h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="classroom-reserve.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>教室預約</p>
                                    </a>
                                </div>
                            </div>

                            <div class="content shadow">
                                <form action="classroom-reserve-doUpdate.php" method="post" enctype="multipart/form-data">
                                    <table class="table table-bordered mt-4">
                                        <tbody>
                                            <tr>
                                                <td class="bg_gray">教室訂單編號</td>
                                                <td class="text-start">
                                                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                                    <?= $row["id"] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">會員</td>
                                                <td class="text-start">
                                                    <?= $row["user_account"] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">教室</td>
                                                <td>
                                                    <input type="text" class="form-control" id="classroom_id" name="classroom_id" value="<?= $row["classroom_id"] ?>">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="bg_gray">價錢</td>
                                                <td>
                                                    <input type="text" class="form-control" id="order_price" name="order_price" value="<?= $row["order_price"] ?>">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="bg_gray">預約日期</td>
                                                <td>
                                                    <input type="date" class="form-control" id="reserve_date" name="reserve_date" value="<?= $row["reserve_date"] ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">預約時間</td>
                                                <td>
                                                    <input type="time" class="form-control" id="reserve_time" name="reserve_time" value="<?= $row["reserve_time"] ?>">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                        <button class="btn btn-primary me-3" href="classroom-reserve-edit.php?id=<?= $row["id"] ?>" type="submit">儲存</button>
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