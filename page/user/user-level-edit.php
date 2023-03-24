<?php
require_once("../../music-db-connect.php");


// if (!isset($_GET["id"])) {
//     echo "使用者不存在";
//     exit;
// }

$sqlCategory = "SELECT user_level.level_name FROM user_level";
$resultCategory = $conn->query($sqlCategory);
$rowsCategory = $resultCategory->fetch_all(MYSQLI_ASSOC);

$id = $_GET["id"];

$sql = "SELECT * FROM user_level WHERE user_level.id='$id'";
$result = $conn->query($sql);
$userCount = $result->num_rows;

$row = $result->fetch_assoc();

// var_dump($row);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>會員管理-編輯會員等級</title>
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
                                    <h1 class="mb-3">編輯會員等級</h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="user-level-detail.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>會員等級資訊</p>
                                    </a>
                                </div>
                            </div>
                            <div class="detail_content shadow">
                                <form action="user-doUpdateLevel.php" method="post">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                            <tr>
                                                <td class="bg_gray">會員等級名稱</td>
                                                <td><input type="text" class="form-control" value="<?= $row["level_name"] ?>" name="level_name"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-center mx-auto mt-4">
                                        <button class="btn btn-primary" type="submit">送出</button>
                                    </div>
                                </form>
                            </div>
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