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
        product_image.*, product_image.id AS img_id
        FROM product_image
        JOIN product ON product_image.product_id = product.id
        WHERE product_image.product_id = $product_image";

    $resultImages = $conn->query($imagesql);

    if ($resultImages != false) {
        $product_image = $_GET["id"];
        $imagesCount = $resultImages->num_rows;
        $rowsImages = $resultImages->fetch_all(MYSQLI_ASSOC);
    }
}

// select篩選
$sqlCategory = "SELECT * FROM product_category";
$sqlColor = "SELECT * FROM product_color";
$sqlSpec = "SELECT * FROM product_spec";

$resultCategory = $conn->query($sqlCategory);
$resultColor = $conn->query($sqlColor);
$resultSpec = $conn->query($sqlSpec);

$rowsCategory = $resultCategory->fetch_all(MYSQLI_ASSOC);
$rowsColor = $resultColor->fetch_all(MYSQLI_ASSOC);
$rowsSpec = $resultSpec->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>修改商品-<?= $row["product_name"] ?></title>
    <?php include(dirname(__FILE__) . '../../../link/header.php') ?>
    <!-- style -->
    <link href="../..//css/product.css" rel="stylesheet">
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
                    <div class="row mb-4">
                        <div class="col-lg-10 mx-auto product product_add product_edit">
                            <div class="d-flex justify-content-between">
                                <div class="title">
                                    <h1 class="mb-3">編輯商品</h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="product.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>商品管理</p>
                                    </a>
                                </div>
                            </div>
                            <div class="content shadow">
                                <form action="product-doUpdate.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb-4">
                                                <p class="mb-3">商品封面</p>
                                                <input type="hidden" name="subject_img_old" value="<?= $row["subject_img"] ?>">
                                                <input type="file" accept="img/*" class="form-control" id="subject_img" name="subject_img" onchange="loadFile(event)">
                                            </div>
                                            <div class="col-md-4 img_float">
                                                <img id="output" class="img-fluid">
                                            </div>
                                            <img class="img-fluid show_sub_img" src="../../upload/product-subject/<?= $row["subject_img"] ?>">
                                        </div>
                                        <div class="col-md-7">
                                            <div class="mb-4 row">
                                                <div class="col-md-4">
                                                    <p class="mb-3">商品狀態</p>
                                                    <select class="form-select" aria-label="Default select example" name="status" id="status">
                                                        <option value="1" <?php if ($row["product_valid"] == 1) echo "selected" ?>>上架中</option>
                                                        <option value="0" <?php if ($row["product_valid"] == 0) echo "selected" ?>>已下架</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="mb-3">商品分類</p>
                                                    <select class="form-select" aria-label="Default select example" name="category" id="category">
                                                        <?php
                                                        foreach ($rowsCategory as $category) {
                                                            $category_id = $category['id'];
                                                            $category_name = $category['category_name'];

                                                            if ($row['category_id'] == $category_id) {
                                                                echo "<option value=\"$category_id\" selected>$category_name</option>";
                                                            } else {
                                                                echo "<option value=\"$category_id\">$category_name</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="mb-3">商品規格</p>
                                                    <select class="form-select" aria-label="Default select example" name="spec" id="spec">
                                                        <?php
                                                        foreach ($rowsSpec as $spec) {
                                                            $spec_id = $spec['id'];
                                                            $spec_name = $spec['spec_name'];

                                                            if ($row['spec_id'] == $spec_id) {
                                                                echo "<option value=\"$spec_id\" selected>$spec_name</option>";
                                                            } else {
                                                                echo "<option value=\"$spec_id\">$spec_name</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <table class="table table-bordered mt-3">
                                                <tbody>
                                                    <tr>
                                                        <td class="w-20">商品名稱</td>
                                                        <td>
                                                            <input type="text" class="form-control" value="<?= $row["product_name"] ?>" name="name" id="name">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-20">商品價格</td>
                                                        <td>
                                                            <input type="text" class="form-control" value="<?= $row["product_price"] ?>" name="price" id="price">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-20">商品庫存</td>
                                                        <td>
                                                            <input type="text" class="form-control" value="<?= $row["inventory"] ?>" name="inventory" id="inventory">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-20">商品顏色</td>
                                                        <td>
                                                            <select class="form-select" aria-label="Default select example" id="color" name="color[]">
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="top w-20">商品資訊</td>
                                                        <td class="top">
                                                            <textarea class="form-control" cols="30" rows="3" name="information" id="information"><?= $row["information"] ?></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-20">商品圖片</td>
                                                        <td>
                                                            <input type="file" class="form-control" multiple="multiple" id="product_img" name="product_img[]">
                                                            <div class="text-start mt-3 row">
                                                                <div class="col-md-12">
                                                                    <div class="gallery">
                                                                    </div>
                                                                    <div class="show_image image_box row mx-1 mt-3">
                                                                        <p class="mb-2">已上傳商品圖</p>
                                                                        <?php if ($resultImages != false) : ?>
                                                                            <?php foreach ($rowsImages as $image) : ?>
                                                                                <div class="col-md-3">
                                                                                    <input type="hidden" name="img_id" value="<?= $image["img_id"] ?>">
                                                                                    <?php
                                                                                    ?>
                                                                                    <a href="product-delete-image.php?img_id=<?= $image["img_id"] ?>&product_id=<?= $image["product_id"] ?>">
                                                                                        <i class="fa-solid fa-circle-xmark icon_close"></i>
                                                                                    </a>
                                                                                    <img src="../../upload/product/<?= $image["src"] ?>" class="img-fluid mb-3" alt="product_img">
                                                                                </div>
                                                                            <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3">
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
    <script>
        // 單圖預覽
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.classList.add('img_border')); // free memory
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

        <?php
        $data = [];
        $row_colors = explode(',', $row['color_id']);

        foreach ($rowsColor as $color) {
            $js_color = ['id' => $color['id'], 'text' => $color['color_name']];

            if (in_array($color['id'], $row_colors)) {
                $js_color['selected'] = true;
            }

            $data[] = $js_color;
        }

        echo 'const colorsJson = \'' . json_encode($data) . '\';';
        ?>

        const data = JSON.parse(colorsJson);
        // 這邊的 #字樣對到上面的 ID
        $('#color').select2({
            data: data,
            placeholder: "Open this select menu",
            multiple: true,
        });
    </script>
    <?php include(dirname(__FILE__) . '../../../link/js.php') ?>
</body>

</html>