<?php
require_once("../../music-db-connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>商品顏色新增</title>
    <?php include(dirname(__FILE__) . '../../../link/header.php') ?>
    <link href="../../css/user.css" rel="stylesheet">
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
                        <div class="col-10 mx-auto user">
                            <div class="d-flex justify-content-between">
                                <div class="title">
                                    <h1 class="mb-3">商品顏色新增</h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="product-color.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>商品顏色</p>
                                    </a>
                                </div>
                            </div>
                            <div class="content shadow">
                                <form action="product-color-doInsert.php" method="post">
                                    <table class="table table-bordered mt-3">
                                        <tbody>
                                            <tr>
                                                <td class="w-20 bg_gray">商品顏色</td>
                                                <td>
                                                    <input type="text" class="form-control" name="name" id="name">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-center mt-4">
                                        <button class="btn btn-primary" type="submit">新增顏色</button>
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