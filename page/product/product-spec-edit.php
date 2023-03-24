<?php
//寫入用 POST，顯示用 GET
if (!isset($_GET["id"])) {
    echo "無該商品";
    exit;
}

$id = $_GET["id"];

require_once("../../music-db-connect.php");

$sql = "SELECT * FROM product_spec WHERE id='$id'";
$result = $conn -> query($sql);
$colorCount = $result -> num_rows;
$row = $result -> fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>商品規格新增</title>
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
                        <div class="col-9 mx-auto user">
                            <div class="d-flex justify-content-between">
                                <div class="title">
                                    <h1 class="mb-3">商品規格編輯</h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="product-spec.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>商品規格</p>
                                    </a>
                                </div>
                            </div>
                            <div class="content shadow">
                                <form action="product-spec-doUpdate.php" method="post">
                                    <input type="hidden" name="id" value="<?=$row["id"]?>">
                                    <table class="table table-bordered mt-3">
                                        <tbody>
                                            <tr>
                                                <td class="w-20">商品規格</td>
                                                <td>
                                                    <input type="text" class="form-control" name="name" id="name" value="<?=$row["spec_name"]?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-20">規格說明</td>
                                                <td>
                                                    <textarea class="form-control" cols="30" rows="3" name="description" id="description"><?=$row["spec_description"]?></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-center mt-4">
                                        <button class="btn btn-primary" type="submit">保存</button>
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