<?php
//寫入用 POST，顯示用 GET
if (!isset($_GET["id"])) {
    echo "無該商品";
    exit;
}

$id = $_GET["id"];

require_once("../../music-db-connect.php");

$sql = "SELECT
product.*,
product_category.category_name,
product_spec.spec_name,
product_spec.spec_description,
product_color.color_name
FROM
product
JOIN product_category ON product.category_id = product_category.id
JOIN product_spec ON product.spec_id = product_spec.id
JOIN product_color ON product.color_id = product_color.id
WHERE product.id = '$id'
";

$result = $conn->query($sql);
$userCount = $result->num_rows;
$row = $result->fetch_assoc();

// product_image
if (isset($_GET["id"])) {
    $product_image = $_GET["id"];

    $imagesql = "SELECT
    product_image.*
    FROM product_image
    JOIN product ON product_image.product_id = product.id
    WHERE product_image.product_id = $product_image";
}
$resultImages = $conn->query($imagesql);
$imagesCount = $resultImages->num_rows;
$rowsImages = $resultImages->fetch_all(MYSQLI_ASSOC);


$sqlColor = "SELECT * FROM product_color";
$resultColor = $conn->query($sqlColor);
$rowsColor = $resultColor->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $row["product_name"] ?></title>
    <?php include(dirname(__FILE__) . '../../../link/header.php') ?>
    <!-- style -->
    <link href="../../css/product.css" rel="stylesheet">
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
                        <div class="col-lg-10 mx-auto product product_add product_detail">
                            <div class="d-flex justify-content-between">
                                <div class="title">
                                    <h1 class="mb-3"><?= $row["product_name"] ?></h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="product.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>商品管理</p>
                                    </a>
                                </div>
                            </div>
                            <div class="content shadow">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="mb-2">
                                            <p class="mb-3">商品封面</p>
                                        </div>
                                        <img class="img-fluid" src="../../upload/product-subject/<?= $row["subject_img"] ?>">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="mb-4 row">
                                            <div class="col-md-4">
                                                <p class="mb-3">商品狀態</p>
                                                <h3 class="text-primary">
                                                    <?php if ($row["product_valid"] == "1") {
                                                        echo "上架中";
                                                    } else {
                                                        echo "已下架";
                                                    }
                                                    ?>
                                                </h3>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="mb-3">商品分類</p>
                                                <h3><?= $row["category_name"] ?></h3>
                                            </div>
                                            <div class="col-md-5">
                                                <p class="mb-3">商品規格</p>
                                                <h3>
                                                    <?= $row["spec_name"] ?>
                                                    <span class="tiny_text"><?= $row["spec_description"] ?></span>
                                                </h3>
                                            </div>
                                        </div>
                                        <table class="table table-bordered mt-3">
                                            <tbody>

                                                <tr>
                                                    <td class="w-20">上架時間</td>
                                                    <td>
                                                        <p class="text-start"><?= $row["create_time"] ?></p>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="w-20">商品價格</td>
                                                    <td>
                                                        <p class="text-start"><?= $row["product_price"] ?></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="w-20">商品庫存</td>
                                                    <td>
                                                        <p class="text-start"><?= $row["inventory"] ?></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="w-20">商品顏色</td>
                                                    <td>
                                                        <p class="text-start">
                                                            <?php
                                                            $colors = [];
                                                            foreach ($rowsColor as $product_color) {
                                                                $colors[$product_color['id']] = $product_color['color_name'];
                                                            }
                                                            $product_color_ids = explode(',', $row['color_id']);

                                                            $processec_product_colors = [];

                                                            foreach ($product_color_ids as $product_color_id) {
                                                                $processec_product_colors[] = $colors[$product_color_id];
                                                            }
                                                            $processec_product_colors = implode('、', $processec_product_colors);
                                                            echo $processec_product_colors;
                                                            ?>
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="top w-20">商品資訊</td>
                                                    <td class="top">
                                                        <p class="text-start"><?= $row["information"] ?></p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- product_img_wrap -->
                                <div class="product_img_wrap mt-4">
                                    <p>商品圖片</p>
                                    <div class="row col-md-12 gallery mt-3">
                                        <?php foreach ($rowsImages as $image) : ?>
                                            <div class="col-3">
                                                <img src="../../upload/product/<?= $image["src"] ?>" class="img-fluid" alt="product_img">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <!-- end -->
                                <div class="text-center mt-3">
                                    <a class="btn btn-primary" href="product-edit.php?id=<?= $row["id"] ?>">編輯</a>
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
    <?php include(dirname(__FILE__) . '../../../link/js.php') ?>
</body>

</html>