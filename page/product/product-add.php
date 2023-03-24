<?php
require_once("../../music-db-connect.php");

$sqlCategory = "SELECT * FROM product_category ORDER BY id ASC";
$sqlColor = "SELECT * FROM product_color ORDER BY id ASC";
$sqlSpec = "SELECT * FROM product_spec ORDER BY id ASC";

$resultCategory = $conn -> query($sqlCategory);
$resultColor = $conn -> query($sqlColor);
$resultSpec = $conn -> query($sqlSpec);

$rowsCategory = $resultCategory -> fetch_all(MYSQLI_ASSOC);
$rowsColor = $resultColor -> fetch_all(MYSQLI_ASSOC);
$rowsSpec = $resultSpec -> fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>商品管理-新增商品</title>
    <?php include(dirname(__FILE__) . '../../../link/header.php')?>
    <!-- style -->
    <link href="../../css/product.css" rel="stylesheet">
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- sidebar -->
        <?php include(dirname(__FILE__) . '../../../link/sidebar.php')?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- nav -->
                <?php include(dirname(__FILE__) . '../../../link/nav.php')?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-10 mx-auto product product_add">
                            <div class="d-flex justify-content-between">
                                <div class="title">
                                    <h1 class="mb-3">新增商品</h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="product.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>商品管理</p>
                                    </a>
                                </div>
                            </div>
                            <div class="content shadow">
                                <form action="product-doInsert.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb-5">
                                                <p class="mb-3">商品封面上傳</p>
                                                <input type="file" accept="img/*" class="form-control" id="subject_img" name="subject_img" onchange="loadFile(event)">
                                            </div>
                                            <img id="output" class="img-fluid">
                                        </div>
                                        <div class="col-md-7">
                                            <div class="mb-4 row">
                                                <div class="col-md-4">
                                                    <p class="mb-3">商品狀態</p>
                                                    <select class="form-select" aria-label="Default select example" name="status" id="status">
                                                        <option value="1">上架中</option>
                                                        <option value="0">已下架</option>
                                                    </select>
                                               </div>
                                                <div class="col-md-4">
                                                    <p class="mb-3">商品分類</p>
                                                    <select class="form-select" aria-label="Default select example" name="category" id="category">
                                                        <option selected>選擇商品分類</option>
                                                        <?php foreach($rowsCategory as $category): ?>
                                                            <option value="<?=$category["id"]?>"><?=$category["category_name"]?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="mb-3">商品規格</p>
                                                    <select class="form-select" aria-label="Default select example" name="spec" id="spec">
                                                        <option selected>選擇商品規格</option>
                                                        <?php foreach($rowsSpec as $spec): ?>
                                                            <option value="<?=$spec["id"]?>"><?=$spec["spec_name"]?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <table class="table table-bordered mt-3">
                                                <tbody>
                                                    <tr>
                                                        <td class="w-20">商品名稱</td>
                                                        <td>
                                                            <input type="text" class="form-control" name="name" id="name">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-20">商品價格</td>
                                                        <td>
                                                            <input type="text" class="form-control" name="price" id="price">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-20">商品庫存</td>
                                                        <td>
                                                            <input type="text" class="form-control" name="inventory" id="inventory">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-20">商品顏色</td>
                                                        <td>
                                                            <select class="form-select" aria-label="Default select example" id="color" name="color[]">
                                                                <?php foreach($rowsColor as $color): ?>
                                                                    <option value="<?=$color["id"]?>"><?=$color["color_name"]?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="top w-20">商品資訊</td>
                                                        <td class="top">
                                                            <textarea class="form-control" cols="30" rows="3" name="information" id="information"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-20">商品圖片</td>
                                                        <td>
                                                            <input type="file" class="form-control" multiple="multiple" id="product_img" name="product_img[]">
                                                            <div class="text-start mt-3 row">
                                                                <div class="col-md-10 gallery">
                                                                    
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="mt-2">
                                                <button class="btn btn-primary" type="submit">新增</button>
                                            </div>
                                        </div>
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
    <script>
        // 單圖預覽
        var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
            }
        };

        // 多圖預覽
        $(function() {
        // Multiple images preview in browser
        var imagesPreview = function(input, placeToInsertImagePreview) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

            $('#product_img').on('change', function() {
                imagesPreview(this, 'div.gallery');
            });
        });

        // select 複選
        $(function() {
        // 這邊的 #字樣對到上面的 ID
            $('#color').select2({
                data: [],
                placeholder: "Open this select menu",
                multiple: true,
            });
        });

    </script>
    <?php include(dirname(__FILE__) . '../../../link/js.php')?>
</body>
</html>