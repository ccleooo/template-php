<?php
if (!isset($_GET["id"])) {
    echo "使用者不存在";
    exit;
}

$id = $_GET["id"];

require_once("../../music-db-connect.php"); //撈資料

$sql = "SELECT * FROM class WHERE id='$id' AND class_valid=1"; //WHERE 是篩選欄位
$result = $conn->query($sql);

$class_nameCount = $result->num_rows;

$row = $result->fetch_assoc(); //多維陣列 (1)


//var_dump($rows);
//exit;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>課程資訊</title>
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
                                    <h1 class="mb-3">課程資訊</h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="class.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>課程管理</p>
                                    </a>
                                </div>
                            </div>
                            <div class="content shadow">
                                <table class="table mt-4">
                                    <table class="table table-bordered">
                                        <?php if ($class_nameCount == 0) : ?>
                                            使用者不存在
                                        <?php else : ?>
                                            <tbody>
                                                <tr>
                                                    <td>課程編號</td>
                                                    <td><?= $row["id"] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>課程名稱</td>
                                                    <td><?= $row["class_name"] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>課程價格</td>
                                                    <td><?= $row["class_price"] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>課程圖片</td>
                                                    <td>
                                                        <figure class="ratio-16x9">
                                                            <img class="" width="350px" src="../../upload/class/<?= $row["class_img"] ?>" alt="">
                                                        </figure>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>開始時間</td>
                                                    <td><?= $row["start_date"] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>結束時間</td>
                                                    <td><?= $row["end_date"] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>師資</td>
                                                    <td>
                                                    <p class="text-start"><?= $row["course_info"] ?></p>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>課程資訊</td>
                                                    <td><?= $row["information"] ?></td>
                                                </tr>
                                            </tbody>
                                    </table>
                                    <div class="py-2 text-center">
                                        <a class="btn btn-primary" href="class-edit.php?id=<?= $row["id"] ?>">編輯課程資訊</a>
                                    </div>
                            </div>
                        <?php endif ?>
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