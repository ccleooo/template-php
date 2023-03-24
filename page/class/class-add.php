<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>課程新增</title>
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
                                    <h1 class="mb-3">課程新增</h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="class.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>課程管理</p>
                                    </a>
                                </div>
                            </div>
                            <div class="content shadow">
                                <form action="class-doInsert.php" method="post" enctype="multipart/form-data">
                                    <table class="table table-bordered mt-4">
                                        <tbody>
                                            <tr>
                                                <td class="bg_gray">課程名稱</td>
                                                <td>
                                                    <input type="text" class="form-control" id="class_name" name="class_name" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">課程價格</td>
                                                <td>
                                                    <input type="text" class="form-control" id="class_price" name="class_price" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="bg_gray">課程圖片</td>
                                                <td>
                                                    <input type="file" class="form-control" id="class_img" name="class_img">
                                                </td>
                                            </tr>
                                        
                                            <tr>
                                                <td class="bg_gray">開始時間</td>
                                                <td>
                                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">結束時間</td>
                                                <td>
                                                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">老師</td>
                                                <td>
                                                    <input type="text" class="form-control" id="course_name" name="course_name" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">師資</td>
                                                <td>
                                                    <input type="text" class="form-control" id="course_info" name="course_info" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">課程資訊</td>
                                                <td>
                                                    <input type="text" class="form-control" id="information" name="information" required>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                        <button class="btn btn-primary" type="submit">送出</button>
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