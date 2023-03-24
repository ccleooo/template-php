<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>優惠管理-新增優惠券</title>
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
                        <div class="col-10 mx-auto user">
                            <div class="d-flex justify-content-between">
                                <div class="title">
                                    <h1 class="mb-3">新增優惠券</h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="coupon.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>優惠券</p>
                                    </a>
                                </div>
                            </div>
                            <div class="content shadow">
                                <form action="coupon-doInsert.php" method="post">
                                    <table class="table table-bordered mt-4">
                                        <tbody>
                                            <tr>
                                                <td class="bg_gray">序號</td>
                                                <td class="text-start">
                                                    <input type="text" class="form-control" id="sn" name="sn" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">優惠名稱</td>
                                                <td>
                                                    <input type="text" class="form-control" id="coupon_name" name="coupon_name" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">優惠金額</td>
                                                <td>
                                                    <input type="text" class="form-control" id="discount" name="discount" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">數量</td>
                                                <td>
                                                    <input type="text" class="form-control" id="quota" name="quota" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">開始時間</td>
                                                <td>
                                                    <input type="datetime-local" class="form-control" id="start_time" name="start_time" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">結束時間</td>
                                                <td>
                                                    <input type="datetime-local" class="form-control" id="end_time" name="end_time" required>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                        <button class="btn btn-info my-3" type="submit">送出</button>
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