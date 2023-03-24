<?php
require_once("../../music-db-connect.php");

// --------------------------------//

$sql = "SELECT * FROM administrator ORDER BY id ASC ";
$result = $conn->query($sql);
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
    <title>Music - admin</title>
    <?php include(dirname(__FILE__) . '../../../link/header.php') ?>
    <link href="../../css/admin.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
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
                        <div class="col-lg-10 mx-auto admin">
                            <h1 class="mb-4">管理員設定</h1>
                            <div class="detail_content shadow">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="circle">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 title">
                                        <p class="mb-2">帳號資訊</p>
                                        <h1 class="mb-3"><?= $row["admin_account"] ?></h1>
                                        <form action="user-admin-doUpdate.php" method="post">
                                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                            <div class="d-flex align-items-center">
                                                <input type="password" name="admin_password" class="form-control form-control-sm ps-3" value="<?= $row["admin_password"] ?>">
                                                <button class="btn btn-primary mx-2 " type="submit">儲存</button>
                                           </div>
                                        </form>
                                    </div>
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