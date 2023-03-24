<!-- 撈取局部資料 -->
<?php
require_once("../../music-db-connect.php");


$sqlCategory = "SELECT * FROM user_level ORDER BY id ASC ";
$resultCategory = $conn->query($sqlCategory);
$rowsCategory = $resultCategory->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>會員管理-會員等級資訊</title>
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
                                    <h1 class="mb-3">會員等級資訊</h1>
                                </div>
                            </div>
                            <div class="detail_content shadow">
                                <div class="row d-flex justify-content-between">
                                    <div class="col-md-5 d-flex align-items-center">
                                        <!-- <h3>會員等級資訊</h3> -->
                                    </div>
                                    <div class="col-md-4 text-end mb-3">
                                        <a class="btn btn-info" href="user-add-level.php">
                                            <i class="fa-solid fa-plus"></i>
                                            會員等級
                                        </a>
                                    </div>
                                </div>
                                <table class="table table-hover mt-3">
                                    <thead>
                                        <tr>
                                            <th class="w-10">編號</th>
                                            <th>會員等級</th>
                                            <th class="w-30 text-center">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rowsCategory as $row) : ?>
                                            <tr>
                                                <td><?= $row["id"] ?></td>
                                                <td><?= $row["level_name"] ?></td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary me-2" href="user-level-edit.php?id=<?= $row["id"] ?>">編輯</a>
                                                    <a class="btn btn-danger me-2" href="user-doDeleteLevel.php?id=<?= $row["id"] ?>">刪除</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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