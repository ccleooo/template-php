<?php
if(!isset($_GET["id"])){
    echo "使用者不存在";
    exit;
}

$id=$_GET["id"];

require_once("../../music-db-connect.php"); //撈資料

$sql="SELECT * FROM class WHERE id='$id' AND class_valid=1"; //WHERE 是篩選欄位
$result=$conn->query($sql);

$class_nameCount=$result->num_rows;

$row=$result->fetch_assoc(); //多維陣列 (1)


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>課程編輯</title>
    <!-- Bootstrap CSS v5.2.1 -->
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
                        <div class="col-9 mx-auto">
                            <div class="d-flex justify-content-between">
                                <div class="title">
                                    <h1 class="mb-3">課程編輯</h1>
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
                                    <form action="class-doUpdate.php" method="post" enctype="multipart/form-data">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                                    <td>課程編號</td>
                                                    <td class="text-start"><?= $row["id"] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>課程名稱</td>
                                                    <td>
                                                        <input type="text" class="form-control" name="class_name" value="<?= $row["class_name"] ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>課程價格</td>
                                                    <td>
                                                        <input type="text" class="form-control" name="class_price" value="<?= $row["class_price"] ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>課程圖片</td>
                                                    <td>
                                                        <input type="hidden" name="old_img" value="<?= $row["class_img"] ?>">
                                                        <input type="file" class="form-control" name="class_img">
                                                    </td>
                                                </tr>
                                        
                                                <tr>
                                                    <td>開始時間</td>
                                                    <td>
                                                        <input type="date" class="form-control" value="<?= $row["start_date"] ?>" name="start_date">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>結束時間</td>
                                                    <td>
                                                        <input type="date" class="form-control" value="<?= $row["end_date"] ?>" name="end_date">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>老師</td>
                                                    <td>
                                                        <input type="text" class="form-control" value="<?= $row["course_name"] ?>" name="course_name">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>師資</td>
                                                    <td class="top">
                                                        <textarea type="text" class="form-control" cols="30" rows="7" name="course_info" id="course_info"><?= $row["course_info"] ?></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>課程資訊</td>
                                                    <td>
                                                        <input type="text" class="form-control" value="<?= $row["information"] ?>" name="information">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            <button class="btn btn-primary" type="submit">儲存</button>
                                        </div>
                                    </form>
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